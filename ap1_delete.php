<?php include("database.php");?>
<?php include("permission.php");?>

<?php

if (isset($_SESSION['delete_apID']))
 {
    $apID = $_SESSION['delete_apID'];

    
    $delete_sql = "DELETE FROM counseling_appointment WHERE apID='$apID'";

    if ($conn->query($delete_sql) === TRUE) 
    {
        // Clear the session variable after deletion
        unset($_SESSION['delete_apID']);
        
        // Redirect back to table.php after deletion
        header('Location: ap1_display.php?msg=deleted');
        exit();
    } 
    else 
    {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} 
else
{
    echo "No appointment selected for deletion!";
}
?>

