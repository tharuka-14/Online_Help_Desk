<?php include("permission.php");?>
<?php
require 'database.php';

$result = $conn->query("SELECT * FROM feedback");
$feedbacks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}


if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM feedback WHERE id=?");
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
       
        echo "<script>window.location.href = 'feedback_display.php';</script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Management</title>
   
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Poppins', sans-serif;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-family: 'Poppins', sans-serif;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        a {
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            color: blue;
        }
        a:hover {
            font-family: 'Poppins', sans-serif;
            
        }
    </style>
</head>
<?php include("header.php");?>
<body>
    <h1>Feedback List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Student ID</th>
                <th>Feedback Type</th>
                <th>Resolved</th>
                <th>Rating</th>
                <th>Feedback</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($feedbacks) > 0): ?>
                <?php foreach ($feedbacks as $feedback): ?>
                <tr>
                    <td><?php echo htmlspecialchars($feedback['id']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['name']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['email']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['feedback_type']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['resolved']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['rating']); ?></td>
                    <td><?php echo htmlspecialchars($feedback['feedback']); ?></td>
                    <td>
                      
                        <a href="feedback_display.php?delete_id=<?php echo $feedback['id']; ?>" 
                           onclick="return confirm('Are you sure you want to delete this feedback?');">
                           Delete
                        </a> |
                        
                        <a href="feedback_update.php?id=<?php echo $feedback['id']; ?>">Update</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" style="text-align: center;">No feedback available</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
</body>
<?php include("footer.php");?>
</html>
