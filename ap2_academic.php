<?php include("permission.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>University Help Desk Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/ap2_style.css">
    
    
</head>
 <!-- Header -->
 <?php
    include ("header.php");
    ?>
<body>
    
    <div class="form-container">
        <h2>Academic Consultants Form</h2>
        <form id="helpDeskForm" action="ap2_academic.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="studentId">Student ID:</label>
            <input type="text" id="studentId" maxlength="10" name="studentId" required><br><br>

            <label for="contactNumber">Contact Number:</label>
            <input type="tel" id="contactNumber" maxlength="10" name="contactNumber" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea><br><br>

            <button type="submit">Submit</button>
            <br>
            <button type="reset">Reset</button>
        </form>
    </div>
    
</body>
<?php include("footer.php");?>

</html>


<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_POST["name"];
    $sID = $_POST["studentId"];
    $cNumber = $_POST["contactNumber"];
    $email = $_POST["email"];
    $date = $_POST["date"];
    $description = $_POST["description"];

    $sql = "INSERT INTO academic_appointment (Name, Student_ID, Contact_Number, Email, Date, Description) 
            VALUES ('$Name', '$sID', '$cNumber', '$email', '$date', '$description')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Appointment booked successfully!');
        window.location.href = 'ap2_display.php';
        </script>";
    } else {
        echo "<script>alert('Error: Could not register.');</script>";
    }

    mysqli_close($conn);
}
?>
