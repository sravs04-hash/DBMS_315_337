<?php
include("auth.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gym Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="style.css"> 
    <style>
        body {
            background: url(gym_bg.jpg) no-repeat center center fixed;
            background-size: cover;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .col-10 {
            padding: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">GYM MANAGEMENT SYSTEM</a>
            <div class="dropdown ml-auto">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="roleDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Role
                </button>
                <div class="dropdown-menu" aria-labelledby="roleDropdown">
                    <a class="dropdown-item" href="home.php?role=admin">Admin</a>
                    <a class="dropdown-item" href="home.php?role=trainer">Trainer</a>
                    <a class="dropdown-item" href="home.php?role=user">User</a>
                </div>
            </div>
            <a href="logout.php" class="nav nav-link">Log Out</a>
        </div>
    </nav>

    <div class="row mt-3">
        <div class="col-2">
            <div id="accordion">
                <div class="list-group">
                    <?php
                    $role = $_GET['role'] ?? 'user'; // Default to 'user' if no role is selected

                    // Function to generate list items
                    function generateMenuItem($title, $link, $icon = '') {
                        return "<div class='list-group-item' style='background-color: #303030;'><a href='$link' class='text-light'>$icon $title</a></div>";
                    }

                    // Admin Section: Gym Management
                    if ($role == 'admin') {
                        echo '
                        <div class="list-group-item bg-dark">
                            <a class="collapsed nav-link text-light" data-toggle="collapse" href="#collapseAdmin">
                                <i class="fas fa-user-alt"></i> GYM MANAGEMENT
                            </a>
                        </div>
                        <div id="collapseAdmin" class="collapse" data-parent="#accordion">';
                        echo generateMenuItem('ADD GYM', 'home.php?info=add_gym&role=admin');
                        echo generateMenuItem('MANAGE GYMS', 'home.php?info=manage_gym&role=admin');
                        echo generateMenuItem('ADD MEMBER', 'home.php?info=add_member&role=admin');
                        echo generateMenuItem('MANAGE MEMBERS', 'home.php?info=manage_member&role=admin');
                        echo generateMenuItem('ADD TRAINER', 'home.php?info=add_trainer&role=admin');
                        echo generateMenuItem('MANAGE TRAINERS', 'home.php?info=manage_trainer&role=admin');
                        echo '</div>';

                        echo '
                        <div class="list-group-item bg-dark">
                            <a class="collapsed nav-link text-light" data-toggle="collapse" href="#collapsePayments">
                                <i class="fas fa-money-bill-wave"></i> PAYMENTS
                            </a>
                        </div>
                        <div id="collapsePayments" class="collapse" data-parent="#accordion">';
                        echo generateMenuItem('ADD PAYMENT', 'home.php?info=add_payment&role=admin');
                        echo generateMenuItem('MANAGE PAYMENTS', 'home.php?info=manage_payment&role=admin');
                        echo '</div>';

                        echo '
                        <div class="list-group-item bg-dark">
                            <a href="home.php?info=manage_subs&role=admin" class="nav-link text-light">
                                <i class="fas fa-clipboard-list"></i> SUBSCRIPTIONS
                            </a>
                        </div>';
                    }

                    // User Section: Subscriptions
                    if ($role == 'user') {
                        echo '
                        <div class="list-group-item bg-dark">
                            <a class="collapsed nav-link text-light" data-toggle="collapse" href="#collapseUser">
                                <i class="fas fa-file-invoice-dollar"></i> SUBSCRIPTIONS
                            </a>
                        </div>
                        <div id="collapseUser" class="collapse" data-parent="#accordion">';
                        echo generateMenuItem('BOOK SUBSCRIPTION', 'home.php?info=add_subs&role=user');
                        echo '</div>';
                    }

                    // Trainer Section: View Bookings and Classes
                    if ($role == 'trainer') {
                        echo '
                        <div class="list-group-item bg-dark">
                            <a class="collapsed nav-link text-light" data-toggle="collapse" href="#collapseTrainer">
                                <i class="fas fa-users"></i> BOOKINGS & CLASSES
                            </a>
                        </div>
                        <div id="collapseTrainer" class="collapse" data-parent="#accordion">';
                        echo generateMenuItem('UPCOMING CLASSES', 'home.php?info=upcoming_classes&role=trainer');
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-10">
            <?php
            $info = $_GET['info'] ?? ''; // Default to empty if no info is passed
            if ($info !== "") {
                // Load pages based on selected role and 'info' parameter
                if ($role == "admin") {
                    switch ($info) {
                        case 'add_gym': include('add_gym.php'); break;
                        case 'manage_gym': include('manage_gym.php'); break;
                        case 'add_member': include('add_member.php'); break;
                        case 'manage_member': include('manage_member.php'); break;
                        case 'add_trainer': include('add_trainer.php'); break;
                        case 'manage_trainer': include('manage_trainer.php'); break;
                        case 'add_payment': include('add_payment.php'); break;
                        case 'manage_payment': include('manage_payment.php'); break;
                        case 'manage_subs': include('manage_subs.php'); break;
                    }
                }

                if ($role == "user" && $info == "add_subs") {
                    include('add_subs.php');
                }

                if ($role == "trainer" && $info == "upcoming_classes") {
                    include('upcoming_classes.php');
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
