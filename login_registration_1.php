<?php
   session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I W T - WebSitE</title>
    <link rel="stylesheet" href="css/login_styles.css">
</head>
<?php include("header.php"); ?>
<body> 
    <br>    
    <fieldset>
        <strong>
        <h1>Registration Form</h1><br>
            <form action="login_registration_2.php" method="post">
                First Name: <br> <input type="text" name="fname" required> <br>  
                Last Name: <br> <input type="text" name="lname" required> <br>
                Gender: <br>
                <select id="gender" name="gender" required>
                    <option value="" disabled selected>Select one</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select> <br>
                Birthday: <br> <input type="date" name="bday" required> <br>
                Address: <br> <input name="address" required> <br>
                Email: <br> <input type="email" name="email" required> <br>
                Phone Number: <br> <input type="tel" maxlength="10" pattern="[0-9]{10}" name="pnum" required> <br>
                NIC Number: <br> <input type="tel" maxlength="12" pattern="[0-9]{12}" name="nicnum" required> <br>
                <center>
                    <p><input type="checkbox" style="width:15px;" required> Accept Terms & Conditions </p>
                    <button type="reset" id="btn_rset">Reset</button>
                    <button type="submit" id="btn_nxt">Next</button>
                </center>
            </form>
        </strong>
    </fieldset>
    <br>
</body>
<?php include("footer.php"); ?>
</html>
