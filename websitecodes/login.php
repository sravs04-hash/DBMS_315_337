<?php
session_start();
require('db.php');
$errors = array();

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    // Prepared statement for login query
    $query = "SELECT * FROM login WHERE uname=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($results) == 1) {
        $user = mysqli_fetch_assoc($results);
        // Verifying hashed password
        if (password_verify($pwd, $user['pwd'])) {
            $_SESSION['uname'] = $username;
            header("location:home.php?info=add_gym");
        } else {
            array_push($errors, "<div class='alert alert-warning'><b>Wrong username/password combination</b></div>");
        }
    } else {
        array_push($errors, "<div class='alert alert-warning'><b>Wrong username/password combination</b></div>");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="index.php">GYM MANAGEMENT SYSTEM</a>
    </nav>
    <div class="container">
        <h2 class="text-center mt-5">Login</h2>
        <form class="form" action="" method="post">
            <input type="text" class="form-control mb-2" name="username" placeholder="USERNAME" required><br/>
            <input type="password" class="form-control mb-2" name="pwd" placeholder="PASSWORD" required><br/>
            <button type="submit" class="btn btn-outline-light mb-2" name="login_user">Login</button>
        </form>
        <?php 
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo $error;
            }
        }
        ?>
    </div>
</body>
</html>
