<?php 
include("db.php");  // Include the database connection
?>

<h2>Manage Subscriptions</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Member ID</th> <!-- Add header for Member ID -->
            <th>Exercise</th>
            <th>Duration</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Use the correct variable $conn from db.php
        $result = mysqli_query($conn, "SELECT * FROM subscriptions");

        // Check if query was successful
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Sanitize output to prevent XSS
                $mem_id = htmlspecialchars($row['mem_id']);
                $exercise = htmlspecialchars($row['exercise']);
                $duration = htmlspecialchars($row['duration']);
                $price = htmlspecialchars($row['price']);
                
                echo "<tr>";
                echo "<td>" . $mem_id . "</td>";  // Display the mem_id
                echo "<td>" . $exercise . "</td>";  // Display the exercise
                echo "<td>" . $duration . " months</td>";  // Display duration
                echo "<td>" . $price . "</td>";  // Display price (no currency symbol)
                echo "<td>
                    <a href='edit_subs.php?mem_id=" . urlencode($mem_id) . "' class='btn btn-warning'>Edit</a>
                    <a href='delete_subs.php?mem_id=" . urlencode($mem_id) . "' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this subscription?');\">Delete</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No subscriptions found</td></tr>";  // Updated colspan for the new column
        }
        ?>
    </tbody>
</table>
