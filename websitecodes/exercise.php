<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        @font-face {
            font-family: customFont;
            src: url('font3.otf');
        }

        body {
            background-image: url('gym_bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: white;
        }

        #heading {
            font-family: customFont;
            font-size: 70px;
            margin-top: 50px;
            color: white;
        }

        #defn {
            font-size: 25px;
            color: white;
        }

        .row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            padding: 50px;
        }

        .column {
            flex: 1;
            max-width: 300px;
            margin: 20px;
            text-align: center;
        }

        .column img {
            width: 100%;
            border: 2px solid black;
            padding: 10px;
            background-color: #fff;
            border-radius: 8px;
        }

        .text {
            font-size: 20px;
            margin-top: 10px;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Exercises Content -->
    <center>
        <p id="heading">Exercise Programs</p>
        <p id="defn">Challenge Yourself with These Intense Workouts!</p>
    </center>

    <div class="row">
        <!-- Zumba -->
        <div class="column">
            <img src="zumba.jpeg" alt="Zumba">
            <div class="text">
                <p>Exercise: Zumba</p>
                <p>Focus: Cardio, Full-body workout, Dance-based</p>
            </div>
        </div>

        <!-- HRX -->
        <div class="column">
            <img src="hrx.jpg" alt="HRX">
            <div class="text">
                <p>Exercise: HRX Workout</p>
                <p>Focus: Functional Strength, Endurance, Mobility</p>
            </div>
        </div>

        <!-- Boxing -->
        <div class="column">
            <img src="boxing.jpeg" alt="Boxing">
            <div class="text">
                <p>Exercise: Boxing</p>
                <p>Focus: Cardiovascular Endurance, Strength, Agility</p>
            </div>
        </div>

        <!-- Weightlifting -->
        <div class="column">
            <img src="weightlifting.jpeg" alt="Weightlifting">
            <div class="text">
                <p>Exercise: Weightlifting</p>
                <p>Focus: Strength, Muscle Building, Power</p>
            </div>
        </div>
    </div>

</body>
</html>
