<?php
    include ("permission.php");
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ticket_page.css">
    <title>Help Desk - Submit a Ticket</title>
</head>
  <!-- Header -->
  <?php
    include ("header.php");
    ?>

<body>
  
   
    <br><br>
        <section class="form-section">
            <h2>Submit a Support Ticket</h2>
            <form id="ticketForm" action="ticket_page.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="id">Registration number:</label>
                <input type="text" id="id" name="registration_number" required>

                <label for="Faculty">Faculty/ School:</label>
                <select id="Faculty" name="Faculty" required>
                <option value="" disabled selected>Select one</option>
                    <option value="Faculty of Computing">Faculty of Computing</option>
                    <option value="School of Business">School of Business</option>
                    <option value="Faculty of Engineering">Faculty of Engineering</option>
                    <option value="Faculty of Humanities & Sciences">Faculty of Humanities & Sciences</option>
                    <option value="School of Architecture">School of Architecture</option>
                </select>

                <label for="issue-type">Issue Type:</label>
                <select id="issue-type" name="issue-type" required>
                    <option value="" disabled selected>Select one</option>
                    <option value="technical">Technical</option>
                    <option value="academic">Academic</option>
                    <option value="administrative">Administrative</option>
                    <option value="other">Other</option>
                </select>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>

                <label for="attachment">Attach File (optional):</label>
                <input type="file" id="attachment" name="attachment">

                <button type="submit">Submit Ticket</button>
            </form>
            <div id="successMessage" style="display:none; text-align:center; color: green; font-size: 18px; margin-top: 20px;"></div>
        </section>
        <br><br>
    

</body>

<?php
    include ("footer.php");
    ?>
</html>

<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $registration_number = $_POST["registration_number"];
    $faculty = $_POST["Faculty"];
    $issue_type = $_POST["issue-type"];
    $description = $_POST["description"];

    
    $stmt = $conn->prepare("INSERT INTO ticket (name, email, registration_number, faculty, issue_type, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $registration_number, $faculty, $issue_type, $description);

    if ($stmt->execute()) {
       
        echo "<script>
                alert('Ticket Submitted Successfully!');
                window.location.href = 'ticket_status.php'; 
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }


    $stmt->close();
    mysqli_close($conn);
}
?>
