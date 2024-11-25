<?php
require('db.php');

// Check if gym_id is set in the URL
if (isset($_GET['gym_id'])) {
    $gym_id = $_GET['gym_id'];

    // Delete the gym from the database
    $delete_query = "DELETE FROM gym WHERE gym_id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, 's', $gym_id); // Use 's' for string

    if (mysqli_stmt_execute($stmt)) {
        echo "Gym deleted successfully!";
        header("Location: manage_gyms.php"); // Redirect back to the main page
        exit;
    } else {
        echo "Error deleting gym.";
    }
} else {
    echo "No gym ID provided.";
    exit;
}

mysqli_close($conn);
?>
