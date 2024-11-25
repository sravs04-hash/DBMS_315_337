<?php
require('db.php'); // Database connection

// Check if trainer_id is passed in the URL
if (isset($_GET['trainer_id'])) {
    $trainer_id = $_GET['trainer_id'];

    // Fetch the trainer's details from the database
    $query = "SELECT * FROM trainer WHERE trainer_id = '$trainer_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $trainer = mysqli_fetch_assoc($result);
    } else {
        echo "Trainer not found.";
        exit();
    }
}

// Handle the form submission for updating the trainer's details
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $mobileno = $_POST['mobileno'];
    // Update the trainer's details
    $update_query = "UPDATE trainer SET name = '$name', mobileno = '$mobileno' WHERE trainer_id = '$trainer_id'";

    if (mysqli_query($conn, $update_query)) {
        // Redirect back to the trainer list page after update
        header("Location: manage_trainers.php?message=updated");
        exit();
    } else {
        echo "Error updating trainer: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Trainer</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Edit Trainer</h2>

    <form method="POST" action="edit_trainer.php?trainer_id=<?php echo $trainer_id; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $trainer['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="mobileno">Mobile No:</label>
            <input type="text" class="form-control" id="mobileno" name="mobileno" value="<?php echo $trainer['mobileno']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="manage_trainers.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
