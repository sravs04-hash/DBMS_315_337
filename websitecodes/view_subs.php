<?php
include("db.php"); // Include your database connection file

// Fetch subscriptions from the database
$query = "SELECT * FROM subscriptions"; // Adjust table name as necessary
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <h2>View Subscriptions</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th> <!-- Changed from Subscription ID to ID -->
                    <th>Exercise</th>
                    <th>Duration (Months)</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td> <!-- Using sub_id for ID -->
                        <td><?php echo htmlspecialchars($row['exercise']); ?></td>
                        <td><?php echo htmlspecialchars($row['duration']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            No subscriptions found.
        </div>
    <?php endif; ?>
</div>
