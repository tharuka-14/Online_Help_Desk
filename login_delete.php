<?php
session_start();
include("database.php"); 


    $username = $_SESSION['username'];

    
    $sql = "DELETE FROM user WHERE username = '$username'";

    if (mysqli_query($conn, $sql)) {
        
        session_destroy();
        echo "<script> alert('Your account has been deleted successfully.'); </script>";
        header("Location: home.php");
    } else {
        echo "Error deleting account: " . mysqli_error($conn);
    }

?>