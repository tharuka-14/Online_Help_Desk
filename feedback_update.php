<?php include("permission.php");?>
<?php
require 'database.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM feedback WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $feedback = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Feedback</title>
    <link rel="stylesheet" href="css/feedback.css">
</head>
<?php include("header.php");?>
<body>
    <br>
    <div class="feedback-form">
    <h1>Update Feedback</h1>
    <form id="feedbackForm" action="feedback.php" method="POST">
    <div class="form">
        <input type="hidden" name="update_id" value="<?php echo $feedback['id']; ?>">
        
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $feedback['name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $feedback['email']; ?>" required>

        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" value="<?php echo $feedback['student_id']; ?>" required>

        <label for="feedback_type">Feedback Type:</label>
        <input type="text" name="feedback_type" value="<?php echo $feedback['feedback_type']; ?>" required>

        <label for="resolved">Resolved:</label>
        <input type="text" name="resolved" value="<?php echo $feedback['resolved']; ?>" required>

        <label for="rating">Rating:</label>
        <input type="text" name="rating" value="<?php echo $feedback['rating']; ?>" required>

        <label for="feedback">Feedback:</label>
        <textarea name="feedback" required><?php echo $feedback['feedback']; ?></textarea>

        <button type="submit">Update Feedback</button>
</div>
</form>
</div>
<br>

</body>

<?php include("footer.php");?>
</html>