<div class="container">
    <h2>Manage Gyms</h2>
    <div class="container">
        <table class="table table-bordered table-hover">
            <tr>
                <th>GYM ID</th>
                <th>GYM NAME</th>
                <th>GYM ADDRESS</th>
                <th>GYM TYPE</th>
                <th>ACTIONS</th> <!-- New column for Edit and Delete buttons -->
            </tr>
            <?php
            require('db.php');

            // Fetch all gyms from the database
            $all = "SELECT * FROM gym";
            $all_query = mysqli_query($conn, $all);
            if (mysqli_num_rows($all_query) > 0) {
                while ($row = mysqli_fetch_assoc($all_query)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['gym_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['gym_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                    // Edit and Delete buttons
                    echo "<td>";
                    echo "<a href='edit_gym.php?gym_id=" . urlencode($row['gym_id']) . "' class='btn btn-primary'>Edit</a> ";
                    echo "<a href='delete_gym.php?gym_id=" . urlencode($row['gym_id']) . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this gym?\");'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>0 results</td></tr>"; // Handle case with no gyms
            }

            mysqli_close($conn);
            ?>
        </table>
    </div>
</div>
