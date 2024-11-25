<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gym Members</title>
    <!-- Add Bootstrap for general styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles for white font and table borders */
        body {
            background-color: #333;
            color: white;
        }
        .table {
            color: white;
            border-color: white;
        }
        .table th, .table td {
            border: 1px solid white;
        }
        .table-hover tbody tr:hover {
            background-color: #555;
        }
        .btn {
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Gym Member Management</h2>
        
        <!-- Success message alert -->
        <?php
        if (isset($_GET['message']) && $_GET['message'] == 'success') {
            echo "<div class='alert alert-success'>Operation completed successfully!</div>";
        }
        ?>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>MEMBER ID</th>
                    <th>MEMBER NAME</th>
                    <th>AGE</th>
                    <th>DOB</th>
                    <th>PACKAGE</th>
                    <th>MOBILE NO</th>
                    <th>PAYMENT AREA ID</th>
                    <th>TRAINER ID</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('db.php');

                // Fetch members
                $all = "SELECT * FROM member";
                $all_query = mysqli_query($conn, $all);

                if (mysqli_num_rows($all_query) > 0) {
                    while ($row = mysqli_fetch_assoc($all_query)) {
                        echo "<tr>";
                        echo "<td>" . $row['mem_id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['dob'] . "</td>";
                        echo "<td>" . $row['package'] . "</td>";
                        echo "<td>" . $row['mobileno'] . "</td>";
                        echo "<td>" . $row['pay_id'] . "</td>";
                        echo "<td>" . $row['trainer_id'] . "</td>";
                        echo "<td>
                                <a href='edit_member.php?id=" . $row['mem_id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                                <a href='delete_member.php?id=" . $row['mem_id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this member?');\">Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No members found.</td></tr>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript for Bootstrap (requires jQuery) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
