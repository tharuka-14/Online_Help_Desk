<?php
session_start();

// connection file
include("database.php");


// Get the current logged-in username from the session
$username = $_SESSION['username'];

// SQL query to fetch the user data from the 'user' table
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the user data and store it in an associative array
    $user = mysqli_fetch_assoc($result);

    // Store the data in individual PHP variables
    $id = $user['id'];
    $fname = $user['fname'];
    $lname = $user['lname'];
    $gender = $user['gender'];
    $bday = $user['bday'];
    $address = $user['address'];
    $email = $user['email'];
    $pnum = $user['pnum'];
    $nicnum = $user['nicnum'];
    $username = $user['username'];
    
} else {
    // If no user is found, display an error
    echo "No user found with username '$username'.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Details</title>
    <link rel="stylesheet" href="css/login_styles.css">
</head>
<?php include("header.php");?>
<body> 
    <br>
    <fieldset>
    <h1>Update User Details</h1>
        <strong>
            <form action="login_update.php" method="post">
                First Name: <br> 
                <input type="text" name="fname" value="<?php echo $fname ?>" required> <br>
                
                Last Name: <br> 
                <input type="text" name="lname" value="<?php echo $lname ?>" required> <br>
                
                Gender: <br>
                <select id="gender" name="gender" required>
                    <option value="" disabled>Select one</option>
                    <option value="male" <?php if($gender == 'male') echo 'selected'; ?>>Male</option>
                    <option value="female" <?php if($gender == 'female') echo 'selected'; ?>>Female</option>
                </select> <br>

                Birthday: <br> 
                <input type="date" name="bday" value="<?php echo $bday ?>" required> <br>
                
                Address: <br> 
                <input name="address" value="<?php echo $address ?>" required> <br>
                
                Email: <br> 
                <input type="email" name="email" value="<?php echo $email ?>" required> <br>
                
                Phone Number: <br> 
                <input type="tel" maxlength="10" pattern="[0-9]{10}" name="pnum" value="<?php echo $pnum ?>" required> <br>
                
                NIC Number: <br> 
                <input type="tel" maxlength="12" pattern="[0-9]{12}" name="nicnum" value="<?php echo $nicnum ?>" required> <br>
                
                <center>
                    <button type="submit" id="btn_nxt">Update</button>
                </center>
            </form>
        </strong>
    </fieldset>
    <br>
</body>
<?php include("footer.php");?>
</html>



<?php

$username = $_SESSION['username'];


$fname2 = isset($_POST["fname"]) ? $_POST["fname"] : '';
$lname2 = isset($_POST["lname"]) ? $_POST["lname"] : '';
$gender2 = isset($_POST["gender"]) ? $_POST["gender"] : '';
$bday2 = isset($_POST["bday"]) ? $_POST["bday"] : '';
$address2 = isset($_POST["address"]) ? $_POST["address"] : '';
$email2 = isset($_POST["email"]) ? $_POST["email"] : '';
$pnum2 = isset($_POST["pnum"]) ? $_POST["pnum"] : '';
$nicnum2 =isset( $_POST["nicnum"]) ?  $_POST["nicnum"] : '';


if(!empty($pnum2)){
$sql_update = "UPDATE user 
                   SET fname = '$fname2', lname = '$lname2', gender = '$gender2', 
                       bday = '$bday2', address = '$address2', email = '$email2', 
                       pnum = $pnum2, nicnum = $nicnum2 
                   WHERE username = '$username'";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Profile updated successfully!');
        window.location.href='login_userprofile.php';</script>";
        
        exit;
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>