<?php
    include('dbconn.php');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $comment = trim($_POST["comment"]);

        if (!empty($comment)) {
            // Prepare SQL statement
            $stmt = $conn->prepare("INSERT INTO feedback (comment) VALUES (?)");
            $stmt->bind_param("s", $comment);

            if ($stmt->execute()) {
                echo "Feedback submitted successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Comment cannot be empty.";
        }
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <style>
        /* Styling for the feedback page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .comments-section {
            margin-top: 20px;
        }
        .comment {
            background: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .search-box {
            margin-top: 20px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .search-results {
            margin-top: 10px;
            padding: 10px;
            background: #e9ecef;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Feedback Page</h1>

        <!-- Feedback Form -->
        <form id="feedbackForm" action="feedback.php" method="POST">
            <label for="comment">Leave a comment:</label>
            <textarea id="comment" name="comment" placeholder="Write your feedback here..."></textarea>
            <button type="submit">Submit</button>
        </form>

        <!-- Display Feedback Comments -->
        <div class="comments-section">
            <h2>Comments:</h2>
            <div id="comments">
                <!-- Example comments (sanitized to prevent Stored XSS) -->
                <div class="comment">This is a legitimate comment.</div>
            </div>
        </div>

        <!-- Search Feature (Vulnerable to DOM-based XSS) -->
        <div class="search-box">
            <h3>Search Comments:</h3>
            <input type="text" id="searchBox" placeholder="Search...">
            <div class="search-results" id="searchResults"></div>
        </div>
    </div>

    <script>
        // DOM-based XSS vulnerability
        document.getElementById('searchBox').addEventListener('input', function () {
            const query = this.value;

            // Vulnerable code: Directly inserting user input into the DOM
            document.getElementById('searchResults').innerHTML = `You searched for: ${query}`;

            // Check if the exploit is triggered (e.g., via <img src=x onerror=alert(1)>)
            if (query.includes('exploit')) {
                // Send a request to the backend to retrieve the flag
                fetch('/get_flag.php?exploit=true')
                    .then(response => response.text())
                    .then(data => {
                        alert(`Flag Retrieved: ${data}`);
                    })
                    .catch(error => console.error('Error fetching flag:', error));
            }
        });

        // Simulate feedback submission (for demonstration purposes)
        document.getElementById('feedbackForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const comment = document.getElementById('comment').value;

            // Sanitize user input to prevent Stored XSS
            const sanitizedComment = document.createElement('div');
            sanitizedComment.className = 'comment';
            sanitizedComment.textContent = comment; // Use textContent to prevent script execution

            document.getElementById('comments').appendChild(sanitizedComment);
            document.getElementById('comment').value = '';
        });
    </script>
</body>
</html>