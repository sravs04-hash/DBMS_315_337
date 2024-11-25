<?php
include("db.php");  // Include database connection

// Check if the 'mem_id' is passed in the URL
if (isset($_GET['mem_id'])) {
    $mem_id = $_GET['mem_id'];

    // Fetch the current subscription details from the database
    $query = "SELECT * FROM subscriptions WHERE mem_id = '$mem_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Fetch data from the row for pre-filling the form
        $exercise = $row['exercise'];
        $duration = $row['duration'];
        $price = $row['price'];
    } else {
        echo "Subscription not found.";
        exit();
    }
}

// Handle form submission for editing subscription
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exercise = $_POST['exercise'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    // Update the subscription in the database
    $update_query = "UPDATE subscriptions SET exercise = '$exercise', duration = '$duration', price = '$price' WHERE mem_id = '$mem_id'";

    if (mysqli_query($conn, $update_query)) {
        header("Location: home.php?message=success");
        exit(); // Redirect after update
    } else {
        echo "<div class='alert alert-danger'>Failed to update the subscription.</div>";
    }
}
?>

<h2>Edit Subscription</h2>
<form method="POST">
    <div class="form-group">
        <label for="exercise">Exercise:</label>
        <input type="text" name="exercise" id="exercise" class="form-control" value="<?php echo $exercise; ?>" required>
    </div>
    <div class="form-group">
        <label for="duration">Duration (in months):</label>
        <input type="number" name="duration" id="duration" class="form-control" value="<?php echo $duration; ?>" required>
    </div>
    <div class="form-group">
        <label for="price">Price ($):</label>
        <input type="number" name="price" id="price" class="form-control" value="<?php echo $price; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Subscription</button>
</form>
