<?php
session_start();
include("database.php");  // Database connection

// Check if user is logged in,
if (isset($_SESSION['username'])) {
    echo "<script>
    alert('You alredy Logged in'); 
    window.location.href='home.php';
    </script>";
  // Redirect to home if logged in
    exit;
}

// Handle login validation after form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Query to check if the username and password match in the database
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Check if the user exists
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // copy username into the session
        $_SESSION["username"] = $user["username"];


        // Redirect to homepage after successful login
        header("Location: home.php");
        exit;
    } else {
        // If login credentials are incorrect, show an error
        echo "<script>alert('Invalid username or password');</script>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User login</title>
    <link rel="stylesheet" href="css/login_styles.css">
</head>
<body> 
    
    <fieldset>
        
        <strong>
        <h1>Login</h1><br>
            <form action="#" method="post">
                Enter Username: <br> <input type="text" name="username" required> <br> 
                Enter password: <br> <input type="password" name="password" required> <br>
                <center>
                    <button type="reset" id="btn_rset">Reset</button>
                    <button type="submit" id="btn_nxt">Login</button>
                    <br><p>Don't have an account? </p><a href="login_registration_1.php">Sign up here</a>
                    <hr>
                    <p id="text">Is this your first time here?</p>
                <p id="text">If you don't have an retford.help.desk.lk account<br>create an account by simply signing up from here.</p>
                   
                </center>
                
            </form>
        </strong>
    </fieldset>
</body>
</html>