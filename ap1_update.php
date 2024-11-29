<?php
session_start();
require 'database.php';

// Check if 'edit_apID' is set (passed from table.php)
if (isset($_SESSION['edit_apID'])) 
{
    $apID = $_SESSION['edit_apID'];

    // Fetch the current appointment details based on apID
    $sql = "SELECT * FROM counseling_appointment WHERE apID='$apID'";
    $result = mysqli_query($conn, $sql);

    // Check if the record is found and assign the data to variables
    if ($row = mysqli_fetch_assoc($result)) 
    {
        $fName = $row['fName'];
        $lName = $row['lName'];
        $stID = $row['stID'];
        $email = $row['email'];
        $contact = $row['contact'];
        $gender = $row['gender'];
        $appDate = $row['appDate'];
        $time = $row['time'];
        $description = $row['description']; 
    } 

    else 
    {
        echo "No record found!";
        exit();
    }
} 

else 
{
    echo "No appointment selected for editing!";
    exit();
}

// Update the data after the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $fName = $_POST["first-name"];
    $lName = $_POST["last-name"];
    $stID = $_POST["st-id"];
    $email = $_POST["st-email"];
    $contact = $_POST["contactNo"];
    $gender = $_POST["gender"];
    $appDate = $_POST["appointment-date"];
    $time = $_POST["appointment-time"];
    $description = $_POST["appt-des"]; 


    // SQL update query
    $update_sql = "UPDATE `counseling_appointment` 
                   SET `fName`='$fName', `lName`='$lName', `stID`='$stID', `email`='$email', `contact`='$contact', `gender`='$gender', `appDate`='$appDate', `time`='$time', `description`='$description'
                   WHERE `apID`='$apID'";

    if ($conn->query($update_sql) === TRUE) 
    {
        echo "<script>alert('Appointment updated successfully!');
        window.location.href='ap1_display.php'; </script>";
    } 
    else 
    {
        echo "Error updating record: " . $conn->error;
    }

    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Counseling Appointment</title>
    <link rel="stylesheet" href="css/ap1_appointment.css">
</head>
<body>

    <div class="form-background">
        <form action="ap1_update.php" method="post">
            <div id="headline">
                <h1>Edit Counseling Session</h1>
            </div>

            <div id="info">
                <label for="name">Name</label><br><br>
                <input type="text" name="first-name" placeholder="First Name" value="<?php echo $fName; ?>" required>
                <input type="text" name="last-name" placeholder="Last Name" value="<?php echo $lName; ?>" required><br><br>

                <label for="st-id">Student ID</label><br><br>
                <input type="text" name="st-id" value="<?php echo $stID; ?>" required><br><br>

                <label for="st-email">Student email</label><br><br>
                <input type="email" name="st-email" value="<?php echo $email; ?>" required><br><br>

                <label for="contactNo">Contact number</label><br><br>
                <input type="text" name="contactNo" placeholder="07xxxxxxxx" value="<?php echo $contact; ?>" required><br><br>

                <label for="gender">Gender</label><br><br>
                <input type="radio" name="gender" value="male" <?php echo ($gender == 'male') ? 'checked' : ''; ?>> Male
                <input type="radio" name="gender" value="female" <?php echo ($gender == 'female') ? 'checked' : ''; ?>> Female<br><br>
            </div>

            <div id="appointment-info">
                <fieldset>
                    <legend>Appointment Details</legend><br><br>
                    <label for="Date">Select a date</label>
                    <input type="date" name="appointment-date" value="<?php echo $appDate; ?>" required><br><br>

                    <label for="appt">Select a time</label>
                    <input type="time" name="appointment-time" value="<?php echo $time; ?>" required><br><br>

                    <label for="appt-des">Description:</label><br><br>
                    <textarea name="appt-des" required><?php echo $description; ?></textarea> 
                </fieldset>
            </div>

            <br><br>
            <input type="submit" value="Update" class="submit">
            <input type="reset" value="Reset" class="reset">
        </form>
            </div>

</body>

</html>

