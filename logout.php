<?php
session_start(); // Start the session

// Clear session variables
unset($_SESSION['decoded']);
unset($_SESSION['JWT']);
unset($_SESSION['phoneNo']);
unset($_SESSION['name']);

// Destroy the session
session_destroy();

// Redirect the user to the login page or home page
header("Location: login.php"); // Redirect to the login page
exit;
?>
