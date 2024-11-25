<div class="container">
    <h2>Payment Details</h2>
    <div class="container">
        <table class="table table-bordered table-hover">
            <tr>
                <th>PAYMENT AREA ID</th>
                <th>AMOUNT</th>
                <th>GYM ID</th>
                <th>ACTIONS</th> <!-- New column for Edit/Delete buttons -->
            </tr>
            <?php
            require('db.php');

            // Query to get all payment details
            $all = "SELECT * FROM payment";
            $all_query = mysqli_query($conn, $all);

            // Check if there are results
            if (mysqli_num_rows($all_query) > 0) {
                while ($row = mysqli_fetch_assoc($all_query)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['pay_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['gym_id']) . "</td>";
                    
                    // Edit and Delete buttons with updated links
                    echo "<td>
                            <a href='edit_pay.php?pay_id=" . urlencode($row['pay_id']) . "' class='btn btn-primary btn-sm'>Edit</a> |
                            <a href='delete_pay.php?pay_id=" . urlencode($row['pay_id']) . "' onclick='return confirm(\"Are you sure you want to delete this payment?\")' class='btn btn-danger btn-sm'>Delete</a>
                          </td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>0 results</td></tr>"; // Handle no results
            }

            mysqli_close($conn);
            ?>
        </table>
    </div>
</div>
