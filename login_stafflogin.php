<?php
session_start();
include("database.php");  // Database connection

// Handle login validation after form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Query to check if the username and password match in the 'admin' table
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Check if the admin exists
    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);

        // Store admin username into the session
        $_SESSION["admin_username"] = $admin["username"];

        // Redirect to admin homepage after successful login
        header("Location: staff_home.php");
        exit;
    } else {
        // If login credentials are incorrect, show an error
        echo "<script>alert('Invalid admin username or password');</script>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/login_styles.css">
</head>
<body> 
    <fieldset>
        <strong>
        <h1>Admin Login</h1><br>
            <form action="login_stafflogin.php" method="post">
                Enter Admin Username: <br> <input type="text" name="username" required> <br> 
                Enter Admin Password: <br> <input type="password" name="password" required> <br>
                <center>
                    <button type="reset" id="btn_rset">Reset</button>
                    <button type="submit" id="btn_nxt">Login</button>
                    <hr>
                    <p id="text">Admin access only.</p><br>
                </center>
            </form>
        </strong>
    </fieldset>
</body>
</html>