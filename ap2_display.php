<?php include("permission.php");?>
<?php
include("database.php");
include("header.php"); 

// get the academic appointments from the database
$appointments = [];
$result = $conn->query("SELECT ac_a_id, Name, Student_ID, Contact_Number, Email, Date, Description FROM academic_appointment");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
} else {
    echo "Error: " . $conn->error;
}

echo '<!DOCTYPE html>
<html>
<head>
    <title>Academic Appointments</title>
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
    <h2>Academic Appointments</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Student ID</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>';

if (empty($appointments)) {
    echo '<tr>
            <td colspan="8">No appointments found.</td>
          </tr>';
} else {
    foreach ($appointments as $appointment) {
        echo '<tr>
                <td>' . ($appointment['ac_a_id']) . '</td>
                <td>' . ($appointment['Name']) . '</td>
                <td>' . ($appointment['Student_ID']) . '</td>
                <td>' . ($appointment['Contact_Number']) . '</td>
                <td>' . ($appointment['Email']) . '</td>
                <td>' . ($appointment['Date']) . '</td>
                <td>' . ($appointment['Description']) . '</td>
                <td>
                    <form method="GET" action="ap2_update.php" style="display:inline; onsubmit="return confirm(\'Are you sure you want to delete this record?\');">
                        <input type="hidden" name="id" value="' . ($appointment['ac_a_id']) . '">
                        <button type="submit" class="action-btn update-btn">Update</button>
                    </form>
                    <form method="GET" action="ap2_delete.php" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this record?\');">
                        <input type="hidden" name="id" value="' . ($appointment['ac_a_id']) . '">
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
<?php include("footer.php"); ?>
