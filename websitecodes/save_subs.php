<?php
include("db.php"); // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input fields (make sure they're not empty)
    if (isset($_POST['exercise'], $_POST['duration'], $_POST['price'])) {
        $exercise = $_POST['exercise'];
        $duration = $_POST['duration'];
        $price = $_POST['price'];

        // Check if the inputs are valid
        if (!empty($exercise) && !empty($duration) && !empty($price)) {
            // Get the max mem_id and increment it for the new entry
            $result = mysqli_query($conn, "SELECT MAX(mem_id) AS max_mem_id FROM subscriptions");
            $row = mysqli_fetch_assoc($result);
            $mem_id = $row['max_mem_id'] + 1;  // Increment the max mem_id

            // Prepare the SQL statement with mem_id
            $stmt = $conn->prepare("INSERT INTO subscriptions (mem_id, exercise, duration, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("issi", $mem_id, $exercise, $duration, $price);

            if ($stmt->execute()) {
                // Generate a response for the user
                echo "Gym Management System<br>";
                echo "Bill Details<br>";
                echo "Package Name: " . htmlspecialchars($exercise) . "<br>";
                echo "Cost: " . htmlspecialchars($price) . "<br>";
                echo "Thank you for subscribing!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "All fields are required.";
        }
    } else {
        echo "Invalid form submission.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
