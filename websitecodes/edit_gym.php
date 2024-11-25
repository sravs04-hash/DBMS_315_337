<?php
require('db.php');

// Check if gym_id is set in the URL
if (isset($_GET['gym_id'])) {
    $gym_id = $_GET['gym_id'];

    // Fetch the gym details from the database
    $query = "SELECT * FROM gym WHERE gym_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $gym_id); // Use 's' for gym_id since it is a VARCHAR
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $gym = mysqli_fetch_assoc($result);

    if (!$gym) {
        echo "Gym not found!";
        exit;
    }
    
    // Update gym details if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $gym_name = $_POST['gym_name'];
        $address = $_POST['address'];
        $type = $_POST['type'];

        $update_query = "UPDATE gym SET gym_name = ?, address = ?, type = ? WHERE gym_id = ?";
        $update_stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($update_stmt, 'ssss', $gym_name, $address, $type, $gym_id); // All parameters as strings

        if (mysqli_stmt_execute($update_stmt)) {
            echo "Gym details updated successfully!";
            header("Location: manage_gyms.php"); // Redirect back to the main page
            exit;
        } else {
            echo "Error updating gym details.";
        }
    }
} else {
    echo "No gym ID provided.";
    exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Gym</title>
</head>
<body>
    <h2>Edit Gym</h2>
    <form method="post">
        <label>Gym Name:</label>
        <input type="text" name="gym_name" value="<?php echo htmlspecialchars($gym['gym_name']); ?>" required><br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($gym['address']); ?>" required><br>

        <label>Type:</label>
        <input type="text" name="type" value="<?php echo htmlspecialchars($gym['type']); ?>" required><br>

        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
