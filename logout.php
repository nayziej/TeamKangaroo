<?php
session_start(); // Start the session

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or a public page
header("Location: login.php");
exit;
?>
