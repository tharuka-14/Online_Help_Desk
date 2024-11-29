<?php include("permission.php");?>
<?php
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $student_id = $_POST['student_id'];
    $feedback_type = $_POST['feedback_type'];
    $resolved = $_POST['resolved'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

   
    $stmt = $conn->prepare("INSERT INTO feedback (id, name, email, student_id, feedback_type, resolved, rating, feedback) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $id, $name, $email, $student_id, $feedback_type, $resolved, $rating, $feedback);

    if ($stmt->execute()) {
        echo "<script>
                  alert('Feedback Submitted Successfully!');
                  window.location.href = 'feedback_display.php'; 
              </script>";
        exit(); 
    } else {
        echo "Submission failed: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Feedback & Complaints</title>
    <link rel="stylesheet" href="css/feedback.css">
    <style>
      
        .radio-group {
            display: flex;                      
            align-items: center;             
            margin-bottom: 15px;               
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;                 
        }

        
        .radio-group label {
            margin-right: 15px;               
        }
    </style>
</head>
<?php include("header.php");?>
<body>
    <br>

    <div class="feedback-form">
        <h1>Feedback & Complaints</h1>
        <form id="feedbackForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                
            <div class="form">
                
                <label for="name_field"></label>
                <input type="text" id="name_field" name="name" placeholder="Enter Your Name" required>

                <label for="email_field"></label>
                <input type="email" id="email_field" name="email" placeholder="Enter Your Email" required>

                <label for="student_id_field"></label>
                <input type="text" id="student_id_field" name="student_id" placeholder="Enter Your Student ID" required>

                <label for="feedback_type">Feedback Type</label>
                <select id="feedback_type" name="feedback_type" required>
                    <option value="academic">Academic</option>
                    <option value="administrative">Administrative</option>
                    <option value="technical">Technical</option>
                    <option value="other">Other</option>
                </select>

                <label>Was your issue resolved?</label>
                <div class="radio-group">
                    <input type="radio" id="resolved_yes" name="resolved" value="Yes" required>
                    <label for="resolved_yes">Yes</label>

                    <input type="radio" id="resolved_no" name="resolved" value="No" required>
                    <label for="resolved_no">No</label>

                    <input type="radio" id="resolved_partial" name="resolved" value="partial" required>
                    <label for="resolved_partial">Partially</label>
                </div>

                <label>How would you rate the help desk support?</label>
                <div class="radio-group">
                    <label for="excellent">
                        <input type="radio" id="excellent" name="rating" value="Excellent" required>
                        Excellent
                    </label>

                    <label for="good">
                        <input type="radio" id="good" name="rating" value="Good" required>
                        Good
                    </label>

                    <label for="average">
                        <input type="radio" id="average" name="rating" value="Average" required>
                        Average
                    </label>

                    <label for="poor">
                        <input type="radio" id="poor" name="rating" value="Poor" required>
                        Poor
                    </label>
                </div>

                <label for="feedback">Suggest anything we can improve</label>
                <textarea id="feedback" name="feedback" rows="4" placeholder="Write your suggestions here..."></textarea>
                
                <button type="submit">Send Feedback</button>
            </div>

        </form>
    </div>

    <script src="feedback.js"></script>
    <br>
    </body>
<?php include("footer.php");?>
</html>
