<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$server = "localhost";
$username = "root";
$password = "Sravani@2004";
$database = "gym";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully to the database.";
}

// Check if a specific table exists (replace 'your_table_name' with an actual table name)
$result = mysqli_query($conn, "SHOW TABLES LIKE 'trainer'");
if (mysqli_num_rows($result) > 0) {
    echo " Table exists.";
} else {
    echo " Table does not exist or cannot be accessed.";
}
?>
