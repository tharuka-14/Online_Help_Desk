<?php include("permission.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Mental Wellness Appointment</title> 
    <link rel="stylesheet" href="css/ap1_appointment.css">
</head>
<?php
    include ("header.php");
    ?>

<body>
    <br>
    <div class="form-background">
            <form action="ap1_appointment.php" method="post">
                <div id="headline">
                    <h1>Book a Counseling Session</h1>
                </div>

                <div id="info">
                    <label for="name" >Name</label> <br> <br>
                    <input type="text" name="first-name" placeholder="First Name" required >
                    <input type="text" name="last-name" placeholder="Last Name" required>
                    <br> <br>

                    <label for="st-id" >Student ID</label> <br> <br>
                    <input type="text" name="st-id"  required>
                    <br> <br>

                    <label for="st-email" >Student email</label> <br> <br>
                    <input type="email" name="st-email" required>
                    <br> <br>

                    <label for="contactNo" >Contact number</label> <br> <br>
                    <input type="text" name="contactNo" placeholder="07xxxxxxxx" required>
                    <br> <br>

                    <label for="gender" >Gender</label> <br> <br>
                    <input type="radio" name="gender" value="male">
                    <label for="gender" >Male</label>
                    <input type="radio" name="gender" value="female">
                    <label for="gender" >Female</label>
                    <br> <br>

                </div>



                <div id="appointment-info">
                    <fieldset>
                        <legend>
                            Appointment Details
                        </legend>
                        <br> <br>
                        <label for="Date">Select a date</label>
                        <input type="date" name="appointment-date" required>
                        <br> <br>

                        <label for="appt">Select a time </label>
                        <input type="time" name="appointment-time" required>
                        <br> <br>

                        <label for="appt-des">Description : </label><br> <br>
                        <textarea name="description" required></textarea>


                    </fieldset>
                    
                </div>

                <br> <br>
                <input type="submit" value="Submit" class="submit" >
                <input type="reset" value="Reset" class="reset">

            </form>
            

        </div>
        <br>
</body>
<?php
    include ("footer.php");
    ?>

</html>



<?php
    $db_sever="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="iwt_project";

    $conn=new mysqli($db_sever,$db_user,$db_pass,$db_name);
    
    if($conn -> connect_error)
    {
        die ("Connection failed".$conn -> connect_error);
    }
    
    //handle form submission

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $fName=$_POST["first-name"];
        $lName=$_POST["last-name"];
        $stID=$_POST["st-id"]; 
        $email=$_POST["st-email"];
        $contact=$_POST["contactNo"];
        $gender=$_POST["gender"];
        $appDate=$_POST["appointment-date"];
        $time=$_POST["appointment-time"];
        $description=$_POST["description"];
        

        //prepare and execute the database insertion
        $sql="INSERT INTO`counseling_appointment`(`fName`,`lName`,`stID`,`email`,`contact`,`gender`,`appDate`,`time`,`description`)
        VALUES ('$fName','$lName','$stID','$email','$contact','$gender','$appDate','$time','$description')";

        

        if ($conn->query($sql) === TRUE) 
        {

         // Redirect to table.php on successful insertion
        echo "<script>alert('Appointment booked successfully!');
                window.location.href='ap1_display.php'; </script>";
         exit();
        }
        else
        {
            echo"Error". $sql."<br>". $conn->error;
        }
    }

    $conn->close();

    
?>
