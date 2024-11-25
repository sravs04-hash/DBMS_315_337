<?php
// Include database connection
include('db.php'); // Ensure this path is correct

// SQL query to select trainers
$query = "SELECT trainer_id, name, time, mobileno, pay_id FROM trainer"; // Ensure this queries the correct table
$result = mysqli_query($conn, $query);

// Check for errors in the SQL query
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

// Display the upcoming classes
echo '<h2>Upcoming Classes</h2>';
echo '<table class="table table-bordered">';
echo '<thead><tr><th>Trainer ID</th><th>Name</th><th>Time</th><th>Mobile No</th><th>Payment ID</th><th>Actions</th></tr></thead>'; // Updated header
echo '<tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['trainer_id'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['time'] . '</td>';
    echo '<td>' . $row['mobileno'] . '</td>';
    echo '<td>' . $row['pay_id'] . '</td>';
    echo '<td>
        <button class="btn btn-success" onclick="showAlert(\'You accepted the class\')">Accept</button>
        <button class="btn btn-danger" onclick="showAlert(\'You declined the class\')">Decline</button>
        </td>'; // Actions combined in one cell
    echo '</tr>';
}

echo '</tbody></table>';

// Close the database connection
mysqli_close($conn);
?>

<script>
function showAlert(message) {
    alert(message); // Display an alert with the given message
}
</script>
