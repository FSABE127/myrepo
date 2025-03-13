<?php
// Securely store the flag on the server-side
$flag = "VulnWeb{DOM_XSS_Exploited_Successfully}";

// Check if the 'exploit' query parameter is set
if (isset($_GET['exploit']) && $_GET['exploit'] === 'true') {
    // Return the flag securely
    header('Content-Type: text/plain');
    echo $flag;
} else {
    // Deny access if the parameter is not set or invalid
    http_response_code(403); // Forbidden
    echo "Access Denied";
}
?>