<?php
// Display PHP and MySQL errors during development
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Include the database connection file
require('db.php');

// Initialize arrays for errors and messages
$errors = array();
$msg = "";

// Check if the form has been submitted
if (isset($_POST['gym'])) {
    // Escape and retrieve form data
    $gym_id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);

    // Check if the gym ID already exists
    $user_check_query = "SELECT * FROM gym WHERE gym_id = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $user_check_query);
    mysqli_stmt_bind_param($stmt, "s", $gym_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt); // Close statement after fetching result

    // If gym ID exists, add an error message
    if ($user) {
        array_push($errors, "<div class='alert alert-warning'><b>Gym ID already exists</b></div>");
    }

    // If no errors, proceed to insert the new gym record
    if (count($errors) == 0) {
        $query = "INSERT INTO gym (gym_id, gym_name, address, type) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $gym_id, $name, $address, $type);

        // Execute the insertion and display success or error message
        if (mysqli_stmt_execute($stmt)) {
            $msg = "<div class='alert alert-success'><b>Gym added successfully</b></div>";
        } else {
            $msg = "<div class='alert alert-danger'><b>Error: " . mysqli_error($conn) . "</b></div>";
        }
        mysqli_stmt_close($stmt); // Close statement after execution
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Gym</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1 class="mt-5">Gym Management System</h1>
    <div class="w3-container mt-4">
        <form class="form-group mt-3" method="post" action="">
            <div><h3>ADD GYM</h3></div>
            <?php 
            // Display error messages and success message
            foreach ($errors as $error) {
                echo $error;
            }
            echo $msg; 
            ?>

            <label class="mt-3">GYM ID</label>
            <input type="text" name="id" class="form-control" required>
            
            <label class="mt-3">GYM NAME</label>
            <input type="text" name="name" class="form-control" required>
            
            <label class="mt-3">GYM ADDRESS</label>
            <input type="text" name="address" class="form-control" required>
            
            <label class="mt-3">GYM TYPE</label>
            <select name="type" class="form-control mt-3">
                <option value="unisex">UNISEX</option>
                <option value="women">WOMEN</option>
                <option value="men">MEN</option>  
            </select>
            
            <button class="btn btn-dark mt-3" type="submit" name="gym">ADD</button>
        </form>
    </div>
</div>

</body>
</html>

<?php
// Close the database connection at the end of the script
mysqli_close($conn);
?>
