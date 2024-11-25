<?php
require('db.php');

// Check if pay_id is provided in the URL
if (isset($_GET['pay_id'])) {
    $pay_id = $_GET['pay_id'];

    // Fetch the payment details from the database
    $query = "SELECT * FROM payment WHERE pay_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $pay_id); // 's' means string
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if payment exists
    if (mysqli_num_rows($result) > 0) {
        $payment = mysqli_fetch_assoc($result);
    } else {
        echo "Payment not found!";
        exit;
    }
}

// Handle form submission to update payment
if (isset($_POST['submit'])) {
    $amount = $_POST['amount'];
    $gym_id = $_POST['gym_id'];

    // Update the payment details in the database
    $update_query = "UPDATE payment SET amount = ?, gym_id = ? WHERE pay_id = ?";
    $update_stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($update_stmt, 'dss', $amount, $gym_id, $pay_id); // 'd' for decimal, 's' for string
    mysqli_stmt_execute($update_stmt);  // Corrected execution line

    // Redirect after updating
    header("Location: manage_payments.php"); // You can change this to the page you want to redirect to
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment</title>
</head>
<body>
    <div class="container">
        <h2>Edit Payment Details</h2>
        <form action="edit_pay.php?pay_id=<?php echo urlencode($pay_id); ?>" method="post">
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" class="form-control" value="<?php echo htmlspecialchars($payment['amount']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gym_id">Gym ID:</label>
                <input type="text" name="gym_id" class="form-control" value="<?php echo htmlspecialchars($payment['gym_id']); ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update Payment</button>
        </form>
    </div>
</body>
</html>
