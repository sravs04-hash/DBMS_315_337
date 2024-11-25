<?php
// Enable error reporting for debugging purposes
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database connection details
$server = "localhost";
$username = "root";
$password = "Sravani2004";
$database = "gym";

// Create a connection to MySQL
$conn = mysqli_connect($server, $username, $password, $database);

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
