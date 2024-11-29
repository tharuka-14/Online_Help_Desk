<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retford University</title>
    <link rel="stylesheet" href="css/header.css"> 
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
<header class="header">
    <div class="header-left">
        <img src="Images/uni_logo.png" alt="University Logo" class="uni-logo">
        <div class="uni-details">
            <span class="uni-name">Retford University</span>
            <span class="uni-help-desk">Help Desk</span>
        </div>
    </div>
    
    <nav class="navigation">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="home.php#services">Support Services</a></li>
            <li><a href="home.php#resources">Information & Resources</a></li>
            <li><a href="home.php#facilities">Facilities</a></li>
            <li><a href="home.php#feedback">Feedback & Complaints</a></li>
        </ul>
    </nav>

    <div class="header-right">
        
   
        
<?php
if (isset($_SESSION['username'])) {
  
    echo '<button class="register" onclick="window.location.href=\'ticket_page.php\'">Contact Retford Student Support</button>';
   
    echo '
    <div class="profile">
        <a href="login_userprofile.php"><img src="Images/p_icon.png" alt="Profile" class="icon"></a>
        <div class="dropdown-content">
            <a href="login_userprofile.php">View Profile</a>
            <a href="login_logout.php">Logout</a>
        </div>
    </div>
    ';
    
   
} else {
   
    echo '<button class="register" onclick="window.location.href=\'login.php\'">Contact Retford Student Support</button>';
   
    echo '
    <div class="dropdown">
        <button class="sign-in">Login</button>
        <div class="dropdown-content">
            <a href="login.php">Student</a>
            <a href="login_stafflogin.php">Staff</a>
        </div>
    </div>
    ';
    
}
?>

    </div>
</header>

</body>
</html>
