<?php
// Start the session at the beginning of the script
session_start();

// Include the database connection file
include('dbconn.php');

// Check if the database connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST requests for login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password (no hashing in this example, but it should be implemented)
        if ($user['password'] === $password) {
            // Log the successful login attempt
            file_put_contents("log.txt", "Login success: $username\n", FILE_APPEND);

            // Set session variables to indicate the user is logged in
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;

            // Redirect to the admin dashboard or another secure page
            header('Location: admin.php');
            exit();
        } else {
            // Log the failed login attempt
            file_put_contents("log.txt", "Failed login: $username\n", FILE_APPEND);
        }
    } else {
        // Log the failed login attempt
        file_put_contents("log.txt", "Failed login: $username\n", FILE_APPEND);

        // Redirect back to the login page with an error message
        header('Location: adminlogin.php?error=1');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #1c1c1c;
            color: #d3d3a4;
            font-family: 'Courier New', monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #2b2b2b;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 350px;
        }

        h2 {
            font-size: 24px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-size: 16px;
        }

        input {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            background-color: #1c1c1c;
            color: #d3d3a4;
            border: 1px solid #d3d3a4;
            border-radius: 5px;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #b5b560;
            border: none;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }

        .error-message {
            color: #ff6b6b;
            font-size: 14px;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="adminlogin.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <p class="error-message">
            <?php if(isset($_GET['error'])) echo "Invalid credentials"; ?>
        </p>
    </div>
</body>
</html>
