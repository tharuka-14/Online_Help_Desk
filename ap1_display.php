<?php
    include("permission.php");
?>

<?php
    include("database.php");
?>

<?php
// Handle the edit action
if (isset($_GET['edit_id'])) 
{
    $_SESSION['edit_apID'] = $_GET['edit_id']; // Store appointment ID in session
    header('Location: ap1_update.php'); // Redirect to the edit page
    exit();
}

// Handle the delete action
if (isset($_GET['delete_id'])) 
{
    $_SESSION['delete_apID'] = $_GET['delete_id']; // Store appointment ID in session
    header('Location: ap1_delete.php'); // Redirect to the delete page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments List</title>
    <link rel="stylesheet" href="css/ap1_update.css">
</head>
<?php include("header.php");?>
<body>

<div class="container" id="table-container">
    <h2>List of Appointments</h2>
    <br>

   
    <table class="table">
        <thead>
            <tr>
                <th>App ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Student ID</th>
                <th>Email</th>
                <th>Contact No.</th>
                <th>Gender</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Submitted Date</th>
                <th>Description</th>
                <th>Actions</th> 
            </tr>
        </thead>
        
        <tbody>

        <?php
            $query= "SELECT * FROM counseling_appointment";
            $query_run = mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) 
            {
                while ($row = mysqli_fetch_assoc($query_run)) 
                {
                    ?>
                    <tr>
                        <td><?php echo $row['apID']; ?></td>
                        <td><?php echo $row['fName']; ?></td>
                        <td><?php echo $row['lName']; ?></td>
                        <td><?php echo $row['stID']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['appDate']; ?></td>
                        <td><?php echo $row['time']; ?></td>
                        <td><?php echo $row['submittedDate']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
                            <a class="button" href="ap1_display.php?edit_id=<?php echo $row['apID']; ?>">Edit</a><br>
                            <a class="button" href="ap1_display.php?delete_id=<?php echo $row['apID']; ?>" onclick="return confirm('Are you sure you want to delete this appointment?');">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            }
             else 
            {
                echo "<tr><td colspan='12'>No record found</td></tr>";
            }
        ?>

        </tbody>
    </table>
</div>

</body>
<?php include("footer.php");?>
</html>

