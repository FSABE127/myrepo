<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable Web App</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --light: #f8f9fa;
            --dark: #333;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: var(--dark);
        }

        /* Header */
        header {
            background: var(--primary);
            color: white;
            padding: 1rem 2rem;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: url('security-icon.png') no-repeat center;
            background-size: contain;
        }

        .header-text {
            text-align: center;
            flex: 1;
            margin-left: 20px;
        }

        /* Navigation */
        nav {
            background: var(--primary);
            padding: 1rem;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        nav li {
            margin: 0.5rem 0;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
        }

        nav a:hover {
            background: rgba(255,255,255,0.1);
        }

        /* Hero Section */
        .hero {
            background: var(--light);
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Footer */
        footer {
            background: var(--primary);
            color: white;
            padding: 2rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .footer-section {
            text-align: center;
        }

        .copyright {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        /* Responsive Styles */
        @media (min-width: 768px) {
            nav ul {
                flex-direction: row;
                justify-content: center;
            }
            
            nav li {
                margin: 0 1rem;
            }
            
            .footer-container {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .footer-section {
                text-align: left;
            }
        }

        @media (min-width: 1024px) {
            header {
                padding: 1.5rem 2rem;
            }
            
            .hero {
                padding: 6rem 2rem;
            }
        }

        /* Common Styles */
        .cta-button {
            background: var(--secondary);
            color: white;
            padding: 1rem 2rem;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
        }
        
        .social-icons a {
            color: white;
            margin: 0 0.5rem;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo"></div>
            <div class="header-text">
                <h1>Vulnerable Web App</h1>
                <p class="slogan">Learn security through controlled vulnerability testing</p>
            </div>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="upload.php">Upload</a></li>
            <li><a href="login.php">Login</a></li>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <!--Xss payload here-->
            <div class="xss-test">
                <h3>Search something</h3>
                <form action="xss.php" method="GET" class="vulnerable-form">
                    <input type="text" name="xss" placeholder="Search...">
                    <button type="submit">Search</button>
                </form>
            </div>
            <h2>Welcome to the Security Playground</h2>
            <p>This application is intentionally vulnerable to help you learn and practice common web security vulnerabilities in a safe environment.</p>
            
            <a href="#" class="cta-button">Get Started</a>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@vulnerableapp.com<br>Phone: (555) 123-4567</p>
            </div>
            <div class="footer-section social-icons">
                <h3>Follow Us</h3>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 Vulnerable Web App. All rights reserved.</p>
        </div>
    </footer>
    
</body>
</html>