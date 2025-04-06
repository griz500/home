<?php
$carbon_output = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $electricity = floatval($_POST["electricity"]);
    $car_miles = floatval($_POST["car_miles"]);
    $public_miles = floatval($_POST["public_miles"]);

    // Emission factors
    $electricity_emission = 0.233; // kg CO2 per kWh
    $car_emission = 0.404; // kg CO2 per mile
    $public_emission = 0.105; // kg CO2 per mile

    // Total calculation
    $total_emissions = ($electricity * $electricity_emission) +
                       ($car_miles * $car_emission) +
                       ($public_miles * $public_emission);

    $carbon_output = "<div class='success'>🌍 Your estimated carbon footprint is <strong>" . round($total_emissions, 2) . " kg of CO₂</strong> this month.</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carbon Footprint Calculator</title>
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
            max-width: 450px;
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
    <h2>Household Carbon Footprint Calculator</h2>
    <form method="post">
        <label for="electricity">Electricity Used (kWh):</label>
        <input type="number" name="electricity" id="electricity" min="0" step="0.01" required>

        <label for="car_miles">Miles Travelled by Car:</label>
        <input type="number" name="car_miles" id="car_miles" min="0" step="0.01" required>

        <label for="public_miles">Miles Travelled by Public Transport:</label>
        <input type="number" name="public_miles" id="public_miles" min="0" step="0.01" required>

        <button type="submit">Calculate Footprint</button>
    </form>

    <?php echo $carbon_output; ?>
</div>

</body>
</html>
