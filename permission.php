<?php
session_start();
include("database.php");  // Database connection

// Check if user is logged in,
if (!isset($_SESSION['username'])) {
    echo "<script> 
    alert('You should Login frist'); 
    window.location.href='login.php';
    </script>";
    // Redirect to login if not logged in
    exit;
}
?>
