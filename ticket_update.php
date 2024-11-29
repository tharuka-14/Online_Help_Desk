<?php
    include("permission.php");
?>
<?php
include("database.php");


if (isset($_POST['ticket_id']) || isset($_GET['ticket_id'])) {
    $ticket_id = isset($_POST['ticket_id']) ? $_POST['ticket_id'] : $_GET['ticket_id'];

 
    $stmt = $conn->prepare("SELECT * FROM ticket WHERE id = ?");
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    

    if ($result->num_rows > 0) {
        $ticket = $result->fetch_assoc();
    } else {
        echo "No ticket found with this ID.";
        exit;
    }
} else {
    echo "No ticket ID provided.";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_ticket'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $registration_number = $_POST["registration_number"];
    $faculty = $_POST["Faculty"];
    $issue_type = $_POST["issue-type"];
    $description = $_POST["description"];

  
    $update_stmt = $conn->prepare("UPDATE ticket SET name = ?, email = ?, registration_number = ?, faculty = ?, issue_type = ?, description = ? WHERE id = ?");
    $update_stmt->bind_param("ssssssi", $name, $email, $registration_number, $faculty, $issue_type, $description, $ticket_id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Ticket Updated Successfully!');</script>";
        header("Location: ticket_status.php");
        exit;
    } else {
        echo "Error: " . $update_stmt->error;
    }
    
    $update_stmt->close();
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ticket_page.css">
    <title>Update Ticket</title>
</head>
<body>
    <?php include("header.php"); ?>
    
    <main>
        <section class="form-section">
            <h2>Update Ticket</h2>
            <form id="ticketForm" action="ticket_update.php" method="post">
                <input type="hidden" name="ticket_id" value="<?php echo htmlspecialchars($ticket['id']); ?>">
                
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($ticket['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($ticket['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="id">Registration Number:</label>
                    <input type="text" id="id" name="registration_number" value="<?php echo htmlspecialchars($ticket['registration_number']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="Faculty">Faculty/ School:</label>
                    <select id="Faculty" name="Faculty" required>
                        <option value="Faculty of Computing" <?php if ($ticket['faculty'] == "Faculty of Computing") echo "selected"; ?>>Faculty of Computing</option>
                        <option value="School of Business" <?php if ($ticket['faculty'] == "School of Business") echo "selected"; ?>>School of Business</option>
                        <option value="Faculty of Engineering" <?php if ($ticket['faculty'] == "Faculty of Engineering") echo "selected"; ?>>Faculty of Engineering</option>
                        <option value="Faculty of Humanities & Sciences" <?php if ($ticket['faculty'] == "Faculty of Humanities & Sciences") echo "selected"; ?>>Faculty of Humanities & Sciences</option>
                        <option value="School of Architecture" <?php if ($ticket['faculty'] == "School of Architecture") echo "selected"; ?>>School of Architecture</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="issue-type">Issue Type:</label>
                    <select id="issue-type" name="issue-type" required>
                        <option value="technical" <?php if ($ticket['issue_type'] == "technical") echo "selected"; ?>>Technical</option>
                        <option value="academic" <?php if ($ticket['issue_type'] == "academic") echo "selected"; ?>>Academic</option>
                        <option value="administrative" <?php if ($ticket['issue_type'] == "administrative") echo "selected"; ?>>Administrative</option>
                        <option value="other" <?php if ($ticket['issue_type'] == "other") echo "selected"; ?>>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($ticket['description']); ?></textarea>
                </div>
                <div class="form-group">
                    <button type="reset" name="rst_ticket">Reset</button>
                    <br><br>
                    <button type="submit" name="update_ticket">Update Ticket</button>
                </div>
            </form>
        </section>
    </main>
    
    <!--footer-->
    <?php include("footer.php"); ?>
</body>
</html>
