<div class="container">
    <div class="container">
        <table class="table table-bordered table-hover">
            <tr>
                <th>TRAINER ID</th>
                <th>NAME</th>
                <th>MOBILE NO</th>
                <th>ACTIONS</th>  <!-- New column for Edit and Delete -->
            </tr>
            <?php
            require('db.php');

            $all = "SELECT * FROM trainer";
            $all_query = mysqli_query($conn, $all);

            if (mysqli_num_rows($all_query) > 0) {
                while($row = mysqli_fetch_assoc($all_query)) {
                    echo "<tr>";
                    echo "<td>" . $row['trainer_id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['mobileno'] . "</td>";
                    echo "<td>
                        <a href='edit_trainer.php?trainer_id=" . $row['trainer_id'] . "' class='btn btn-warning'>Edit</a>
                        <a href='delete_trainer.php?trainer_id=" . $row['trainer_id'] . "' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this trainer?');\">Delete</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No results found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
