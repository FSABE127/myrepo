<?php
    if (isset($_GET['xss'])) {
        $input = $_GET['xss'];
        
        // Check if input contains basic XSS patterns
        if (preg_match('/<script|onerror|javascript:/i', $input)) {
            // Show flag when XSS payload detected
            echo "<div class='flag'>VulnWeb{XSS_R3FL3CT1V3}</div>";
        } else {
            // Otherwise show normal output (still vulnerable)
            echo "<p>You entered: " . $input . "</p>";
        }
    }
?>