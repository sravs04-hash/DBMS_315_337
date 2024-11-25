<?php
require('db.php'); // Database connection

// Check if trainer_id is passed in the URL
if (isset($_GET['trainer_id'])) {
    $trainer_id = $_GET['trainer_id'];

    // Delete the trainer from the database
    $delete_query = "DELETE FROM trainer WHERE trainer_id = '$trainer_id'";

    if (mysqli_query($conn, $delete_query)) {
        // Redirect to the list page after successful deletion
        header("Location: manage_trainers.php?message=deleted");
        exit();
    } else {
        // Error message in case the deletion fails
        echo "Error deleting trainer: " . mysqli_error($conn);
    }
} else {
    echo "No trainer ID provided for deletion.";
}
?>
