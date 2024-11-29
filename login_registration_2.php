<?php
session_start();
include("database.php");  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $_SESSION["fname"] = $_POST["fname"] ?? $_SESSION["fname"];
    $_SESSION["lname"] = $_POST["lname"] ?? $_SESSION["lname"];
    $_SESSION["gender"] = $_POST["gender"] ?? $_SESSION["gender"];
    $_SESSION["bday"] = $_POST["bday"] ?? $_SESSION["bday"];
    $_SESSION["address"] = $_POST["address"] ?? $_SESSION["address"];
    $_SESSION["email"] = $_POST["email"] ?? $_SESSION["email"];
    $_SESSION["pnum"] = $_POST["pnum"] ?? $_SESSION["pnum"];
    $_SESSION["nicnum"] = $_POST["nicnum"] ?? $_SESSION["nicnum"];

   
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        
        if ($password === $password2) {
            // If passwords match, insert into the database
            $fname = $_SESSION["fname"];
            $lname = $_SESSION["lname"];
            $gender = $_SESSION["gender"];
            $bday = $_SESSION["bday"];
            $address = $_SESSION["address"];
            $email = $_SESSION["email"];
            $pnum = $_SESSION["pnum"];
            $nicnum = $_SESSION["nicnum"];
            
            // SQL query to insert data
            $sql = "INSERT INTO user (fname, lname, gender, bday, address, email, pnum, nicnum, username, password) 
                    VALUES ('$fname','$lname','$gender','$bday','$address','$email','$pnum','$nicnum','$username','$password')";
            
            if (mysqli_query($conn, $sql)) {
                // Store the username in the session
                $_SESSION['username'] = $username;
                
                // Notify the user and redirect
                echo "<script>alert('Registration successful!'); window.location.href='home.php';</script>";
                
                // Clear other sessions
                unset($_SESSION['fname'], $_SESSION['lname'], $_SESSION['gender'], $_SESSION['bday'], $_SESSION['address'], $_SESSION['email'], $_SESSION['pnum'], $_SESSION['nicnum']);

                // Close the database connection
                mysqli_close($conn);

                exit; // It's important to exit to stop further execution
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Passwords don't match
            echo "<script>alert('Passwords do not match! Please try again.'); window.history.back();</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Last-step</title>
    <link rel="stylesheet" href="css/login_styles.css">
</head>
<body> 
    <h1>For Sign in</h1>
    <fieldset>
        <strong>
            <form action="login_registration_2.php" method="post">
                Enter Username: <br> <input type="text" name="username" required> <br> 
                Enter Strong password: <br> <input type="password" name="password" required> <br>
                Enter that password again: <br> <input type="password" name="password2" required> <br>
                <center>
                    <button type="reset" id="btn_rset">Reset</button>
                    <button type="submit" id="btn_nxt">Sign in</button>
                </center>
            </form>
        </strong>
    </fieldset>
</body>
</html>
