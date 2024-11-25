<?php
require('db.php');  // Include the database connection

// Check if 'mem_id' is passed in the URL
$mem_id = $_GET['mem_id'];

// Sanitize the 'mem_id' to avoid SQL injection
$mem_id = mysqli_real_escape_string($conn, $mem_id);

// Prepare the DELETE SQL query
$sql_query = "DELETE FROM subscriptions WHERE mem_id='$mem_id'";

// Execute the query
$delete = mysqli_query($conn, $sql_query);

// Check if the query executed successfully
if ($delete) {
    // Redirect to the home page with the manage_member info
    header("Location: home.php?info=manage_subscriptions");
    exit(); // Always call exit() after header redirection to stop further script execution
} else {
    // Display an error message if the query failed
    echo "Error: " . mysqli_error($conn);
}
?>
