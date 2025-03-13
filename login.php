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

        // Verify the password (plaintext comparison for now, but hashing should be implemented)
        if ($user['password'] === $password) {
            // Set session variables to indicate the user is logged in
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;

            // Redirect to the home page with a success message
            echo "<script>
                alert('Login successful! Flag: VulnWeb{SQLi_Success}');
                window.location.href = 'index.php';
            </script>";
            exit();
        } else {
            // Invalid credentials
            echo "<script>alert('Invalid credentials!')</script>";
        }
    } else {
        // User not found
        echo "<script>alert('Invalid credentials!')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Vulnerable Web App</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a2a6c 0%, #b21f1f 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 60px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease-in-out;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: #1a2a6c;
            font-weight: 600;
            margin: 0;
            padding-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .login-header h2::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background: #b21f1f;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-group input {
            width: 85%;
            padding: 12px 20px 12px 40px; /* Reduced right padding */
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        

        .input-group input:focus {
            border-color: #b21f1f;
            outline: none;
            box-shadow: 0 0 0 2px rgba(178, 31, 31, 0.2);
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .login-button {
            background: linear-gradient(135deg, #1a2a6c 0%, #b21f1f 100%);
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .login-button:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .forgot-password {
            text-align: center;
            margin-top: 20px;
            color: #555;
            font-size: 14px;
        }

        .forgot-password a {
            color: #b21f1f;
            text-decoration: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Styles */
        @media (max-width: 480px) {
            .login-container {
                padding: 30px;
            }
            
            .input-group input {
                padding: 10px 15px 10px 35px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Login</h2>
        </div>
        
        <form method="POST" action="login.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
    </div>
</body>
</html>