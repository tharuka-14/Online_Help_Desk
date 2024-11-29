<?php
// Include the database connection file
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ticket_id"])) {
   
    $ticket_id = $_POST["ticket_id"];

   
    $stmt = $conn->prepare("DELETE FROM ticket WHERE id = ?");
    $stmt->bind_param("i", $ticket_id);


    if ($stmt->execute()) {
       
        echo "success";
        header("Location:ticket_status.php");
    } else {
      
        echo "Error deleting ticket: " . $conn->error;
        
        
    }

    $stmt->close();
    $conn->close();
    exit;
} else {
   
    echo "Invalid request.";
    exit;
}
?>
<script>
fetch("delete_ticket.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "ticket_id=" + ticketId
})
</script>
