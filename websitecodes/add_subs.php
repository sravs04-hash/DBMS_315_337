<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subscription</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function updatePrice() {
            var exerciseSelect = document.getElementById("exercise");
            var durationSelect = document.getElementById("duration");
            var selectedExercise = exerciseSelect.value;
            var selectedDuration = durationSelect.value;
            var priceField = document.getElementById("price");

            var basePrices = {
                "Zumba": 10000,
                "HRX Workout": 12000,
                "Boxing": 10500,
                "Weightlifting": 20000
            };

            var durationFactors = {
                "1": 1,
                "3": 2.7,
                "6": 5,
                "12": 10
            };

            var basePrice = basePrices[selectedExercise];
            var totalPrice = basePrice * durationFactors[selectedDuration];
            priceField.value = totalPrice;
        }

        function submitForm(event) {
            event.preventDefault(); // Prevent the default form submission
            var durationSelect = document.getElementById("duration");
            if (durationSelect.value === "") {
                alert("Please choose a duration package.");
                return;
            }

            var formData = new FormData(document.getElementById("subscriptionForm"));

            fetch("save_subs.php", {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error("Network response was not ok.");
                }
            })
            .then(data => {
                var successMessage = document.getElementById("successMessage");
                successMessage.style.display = "block";
                successMessage.className = "alert alert-success"; // Success alert
                successMessage.innerHTML = data; // Display the generated bill
                document.getElementById("subscriptionForm").reset(); // Reset the form
                updatePrice(); // Update the price field
            })
            .catch(error => {
                console.error("Error:", error);
                var successMessage = document.getElementById("successMessage");
                successMessage.style.display = "block";
                successMessage.className = "alert alert-danger"; // Danger alert for errors
                successMessage.innerHTML = "There was an error submitting the form.";
            });
        }

        // Initialize price when the page loads
        document.addEventListener("DOMContentLoaded", function() {
            updatePrice(); // Initialize the price when the page loads
        });
    </script>
</head>
<body>

<div class="container">
    <h2>Add Subscription</h2>
    <div id="successMessage" class="alert" role="alert" style="display: none;"></div>

    <form id="subscriptionForm" onsubmit="submitForm(event)">
        <input type="hidden" name="mem_id" value="<?php echo $mem_id; ?>"> <!-- Dynamic mem_id -->

        <div class="form-group">
            <label for="exercise">Exercise:</label>
            <select class="form-control" id="exercise" name="exercise" required onchange="updatePrice()">
                <option value="Zumba">Zumba</option>
                <option value="HRX Workout">HRX Workout</option>
                <option value="Boxing">Boxing</option>
                <option value="Weightlifting">Weightlifting</option>
            </select>
        </div>

        <div class="form-group">
            <label for="duration">Choose your package (Duration in months):</label>
            <select class="form-control" id="duration" name="duration" required onchange="updatePrice()">
                <option value="">Select Duration</option>
                <option value="1">1 Month</option>
                <option value="3">3 Months</option>
                <option value="6">6 Months</option>
                <option value="12">12 Months</option>
            </select>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" value="10000" required readonly>
        </div>

        <button type="submit" class="btn btn-primary">Add Subscription</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
