<?php
session_start();
include("database.php");  // Database connection

// Check if user is logged in,
if (!isset($_SESSION['username'])) {
    echo "<script> alert('You should Login frist'); </script>";
    header("Location: login.php");  // Redirect to login if not logged in
    // without login user can't do anything
    exit;
}//copy this to begining of every pages

//get logged-in user's data from the database
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);  // Fetch user data
} else {
    echo "Error fetching user details";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/login_styles.css">
</head>
<?php include("header.php"); ?> 
<body>
    <br><br>
    <strong><fieldset id="profile_box">
    <h1>Profile</h1><br>
    <p>Name : <?php echo $user['fname'] . " " . $user['lname'];?></p>
    <p>Birthday : <?php echo $user['bday']; ?></p>
    <p>Gender : <?php echo $user['gender']; ?></p>
    <p>Email : <?php echo $user['email']; ?></p>
    <p>Address : <?php echo $user['address']; ?></p>
    <p>Phone : <?php echo $user['pnum']; ?></p>
    <p>NIC : <?php echo $user['nicnum']; ?></p>
   
    <br><br><center>
        
    <!-- update  -->
    <form action="login_update.php" method="post">
        <button type="submit" name="update" id="btn_update">Change Details</button>
    </form>

    <!-- Logout  -->
    <form action="login_logout.php" method="post">
    <button type="submit" name="logout" id="btn_logout">Logout</button>
    </form>


    <!-- Delete Ac -->
    <form action="login_delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete your account?');">
        <button type="submit" name="delete_account" id="btn_delete">Delete Account</button>
    </form>
</center>
</fieldset>
</strong>
<br><br>
</body>
<?php include("footer.php");?>
</html>