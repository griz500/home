<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $date = $_POST["date"];
    $time = $_POST["time"];

    $sql = "INSERT INTO bookings (name, email, booking_date, booking_time) 
            VALUES ('$name', '$email', '$date', '$time')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "<div class='success'>✅ Thank you, your consultation has been booked for <strong>$date</strong> at <strong>$time</strong>.</div>";
    } else {
        $message = "<div class='error'>❌ Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book a Consultation</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #388e3c;
        }

        .success {
            margin-top: 20px;
            background-color: #e8f5e9;
            color: #2e7d32;
            border-left: 5px solid #4CAF50;
            padding: 15px;
            border-radius: 8px;
        }

        .error {
            margin-top: 20px;
            background-color: #ffebee;
            color: #c62828;
            border-left: 5px solid #f44336;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Book a Consultation</h2>
    <form method="post">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required>

        <label for="date">Select Date:</label>
        <input type="date" name="date" id="date" required>

        <label for="time">Select Time:</label>
        <input type="time" name="time" id="time" required>

        <button type="submit">Book Now</button>
    </form>

    <?php echo $message; ?>
</div>

</body>
</html>
