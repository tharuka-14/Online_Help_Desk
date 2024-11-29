<?php

include("database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the record from the table
    $sql = "DELETE FROM academic_appointment WHERE ac_a_id = $id";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Record deleted successfully');</script>";
        echo "<script>window.location.href = 'ap2_display.php';</script>"; // Redirect back to the display page
    } else {
        echo "<script>alert('Error deleting record');</script>";
    }
}


mysqli_close($conn);
?>
