<?php include("permission.php");?>
<?php include("header.php");?>

<?php
include("database.php");


$tickets = [];
$result = $conn->query("SELECT * FROM ticket");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $tickets[] = $row;
    }
} else {
    echo "Error: " . $conn->error;
}



echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Status</title>
    <style>
        body { font-family: Verdana, sans-serif; margin: 0px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .action-btn { padding: 5px 10px; margin: 2px; cursor: pointer; border: none; }
        .update-btn { background-color: #4CAF50; color: white; }
        .delete-btn { background-color: #f44336; color: white; }
    </style>
</head>
<body>
    <h2>Ticket Status</h2>
    <table>
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Reply Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>';

if (empty($tickets)) {
    echo '<tr>
            <td colspan="6">No tickets found.</td>
          </tr>';
} else {
    foreach ($tickets as $ticket) {
        echo '<tr>
                <td>' . htmlspecialchars($ticket['id']) . '</td>
                <td>' . htmlspecialchars($ticket['name']) . '</td>
                <td>' . htmlspecialchars($ticket['email']) . '</td>
                <td>' . htmlspecialchars($ticket['status']) . '</td>
                <td>' . htmlspecialchars($ticket['reply_status']) . '</td>
                <td>
                    <form method="POST" action="ticket_update.php" style="display:inline;">
                        <input type="hidden" name="ticket_id" value="' . htmlspecialchars($ticket['id']) . '">
                        <button type="submit" class="action-btn update-btn">Update</button>
                    </form>
                    <form method="POST" action="ticket_delete.php" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this ticket?\');">
                        <input type="hidden" name="ticket_id" value="' . htmlspecialchars($ticket['id']) . '">
                        <button type="submit" class="action-btn delete-btn">Delete</button>
                    </form>
                </td>
              </tr>';
              
    }
}

echo '      </tbody>
    </table>
</body>
</html><br>';
?>
<?php include("footer.php");?>

