<?php
// Include the database connection
include("database.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // get the current data for this record
    $sql = "SELECT * FROM academic_appointment WHERE ac_a_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record</title>
    <link rel="stylesheet" href="css/ap2_style.css">
    
</head>
<?php include("header.php");?>
<body>

<div class="form-container">
<h2>Update Record</h2>

<form action="ap2_update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['ac_a_id']; ?>">
    
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $row['Name']; ?>" required><br><br>

    <label for="studentId">Student ID:</label>
    <input type="text" id="studentId"  maxlength="10" name="studentId" value="<?php echo $row['Student_ID']; ?>" required><br><br>

    <label for="contactNumber">Contact Number:</label>
    <input type="text" id="contactNumber"  maxlength="10" name="contactNumber" value="<?php echo $row['Contact_Number']; ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>" required><br><br>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" value="<?php echo $row['Date']; ?>" required><br><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required><?php echo $row['Description']; ?></textarea><br><br>

    <button type="submit">Update</button>
</form>
</div>
</body>
</html>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // get the current data for this record
    $sql = "SELECT * FROM academic_appointment WHERE ac_a_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $studentId = $_POST['studentId'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    //  update SQL statement
    $sql = "UPDATE academic_appointment SET 
                Name = ?, 
                Student_ID = ?, 
                Contact_Number = ?, 
                Email = ?, 
                Date = ?, 
                Description = ? 
            WHERE ac_a_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $studentId, $contactNumber, $email, $date, $description, $id);

    //  update and check for success
    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href = 'ap2_display.php';</script>"; 
    } else {
        echo "<script>alert('Error updating record: " . $stmt->error . "');</script>";
    }


    $stmt->close();
}


mysqli_close($conn);
?>
