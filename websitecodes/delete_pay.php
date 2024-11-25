<?php
require('db.php');

// Check if pay_id is provided in the URL
if (isset($_GET['pay_id'])) {
    $pay_id = $_GET['pay_id'];

    // Delete the payment from the database
    $query = "DELETE FROM payment WHERE pay_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $pay_id); // 's' means string
    $stmt_execute = mysqli_stmt_execute($stmt);

    if ($stmt_execute) {
        // Redirect to manage payments page after deletion
        header("Location: manage_payments.php");
        exit();
    } else {
        echo "Error deleting payment!";
    }
}

mysqli_close($conn);
?>
