<?php
require('db.php');

if (isset($_GET['id'])) {
    $mem_id = $_GET['id'];
    $query = "SELECT * FROM member WHERE mem_id = '$mem_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $package = $_POST['package'];
    $mobileno = $_POST['mobileno'];
    $pay_id = $_POST['pay_id'];
    $trainer_id = $_POST['trainer_id'];

    $update_query = "UPDATE member SET name='$name', age='$age', dob='$dob', package='$package', mobileno='$mobileno', pay_id='$pay_id', trainer_id='$trainer_id' WHERE mem_id = '$mem_id'";
    
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Member updated successfully.');</script>";
        echo "<script>window.location.href='your_table_page.php';</script>";
    } else {
        echo "<script>alert('Error updating member.');</script>";
    }
}
?>

<form method="POST" action="">
    <label>Member Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>

    <label>Age:</label>
    <input type="text" name="age" value="<?php echo $row['age']; ?>" required><br>

    <label>DOB:</label>
    <input type="date" name="dob" value="<?php echo $row['dob']; ?>" required><br>

    <label>Package:</label>
    <input type="text" name="package" value="<?php echo $row['package']; ?>" required><br>

    <label>Mobile No:</label>
    <input type="text" name="mobileno" value="<?php echo $row['mobileno']; ?>" required><br>

    <label>Payment Area ID:</label>
    <input type="text" name="pay_id" value="<?php echo $row['pay_id']; ?>" required><br>

    <label>Trainer ID:</label>
    <input type="text" name="trainer_id" value="<?php echo $row['trainer_id']; ?>" required><br>

    <input type="submit" name="update" value="Update Member">
</form>
