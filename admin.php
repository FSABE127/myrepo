<?php
  // Start the session at the beginning of the script
  session_start();

  // Check if the user is logged in by verifying the session variables
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
      // Redirect to the login page if the user is not authenticated
      header('Location: adminlogin.php');
      exit();
  }

  // If the user is authenticated, display the admin panel
  echo "<h1>Welcome to Admin Panel</h1>";
  echo "<br>Flag: VulnWeb{Admin_Access_Granted}";
?>