<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $student_id = $_POST['student_id'];
    $feedback_type = $_POST['feedback_type'];
    $resolved = $_POST['resolved'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    if (isset($_POST['update_id']) && !empty($_POST['update_id'])) {
        // Update process
        $update_id = $_POST['update_id'];
        $stmt = $conn->prepare("UPDATE feedback SET name=?, email=?, student_id=?, feedback_type=?, resolved=?, rating=?, feedback=? WHERE id=?");
        $stmt->bind_param("sssssssi", $name, $email, $student_id, $feedback_type, $resolved, $rating, $feedback, $update_id);
        if ($stmt->execute()) {
            echo "<script>alert('Feedback updated successfully!'); window.location.href = 'feedback_display.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Insert process
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, student_id, feedback_type, resolved, rating, feedback) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $student_id, $feedback_type, $resolved, $rating, $feedback);
        if ($stmt->execute()) {
            echo "Feedback submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>