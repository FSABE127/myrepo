<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Web App</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar {
            background: #2c3e50;
            color: white;
            padding: 1rem 0;
        }

        .navbar .logo {
            font-weight: bold;
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: flex-end;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 300;
        }

        .hero {
            background: #3498db;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .upload-section {
            padding: 50px 0;
            background: #f8f9fa;
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .upload-form {
            display: flex;
            flex-direction: column;
        }

        .upload-form input[type="file"] {
            margin-bottom: 1rem;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            background: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #2980b9;
        }

        .features {
            display: grid;
            margin: 0 auto;
            gap: 2rem;
            padding: 50px 0;
        }

        .feature-box {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="logo">Vulnerable Web App</a>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="#">Check for Template</a></li>
                <li><a href="#">A</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Secure Document Processing</h1>
            <p>Upload your XML documents for processing</p>
        </div>
    </section>

    <!-- Upload Section (Vulnerable Component) -->
    <section class="upload-section">
        <div class="container">
            <div class="card">
                <h2>XML Document Upload</h2>
                <form action="process.php" method="post" enctype="multipart/form-data" class="upload-form">
                    <input type="file" name="xmlFile" id="xmlFile" accept=".xml" required>
                    <button type="submit" class="btn">Upload Document</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="feature-box">
                <h3>Fast Processing</h3>
                <p>Process documents in seconds</p>
            </div>
            <div class="feature-box">
                <h3>Secure Storage</h3>
                <p>Encrypted document storage</p>
            </div>
            <div class="feature-box">
                <h3>24/7 Support</h3>
                <p>We're always here to help</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 Vulnerable Web App. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>