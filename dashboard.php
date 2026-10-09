<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "realestatephp";

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Counts for Dashboard Cards
$totalProperties = $conn->query("SELECT COUNT(*) as count FROM property")->fetch_assoc()['count'];
$totalAgents = $conn->query("SELECT COUNT(*) as count FROM user WHERE utype = 'agent'")->fetch_assoc()['count'];
$totalInstallments = $conn->query("SELECT COUNT(*) as count FROM installments")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EAMARKETS Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4; /* Light gray background */
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333; /* Blackish sidebar */
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar img {
            display: block;
            margin: 0 auto;
            width: 120px;
        }
        .sidebar h2 {
            text-align: center;
            font-size: 20px;
            margin-top: 10px;
            color: #ccc; /* Lighter gray for logo text */
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        .sidebar ul li {
            padding: 15px 20px;
            text-align: left;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #ccc;
            display: block;
            font-size: 16px;
            transition: color 0.3s;
        }
        .sidebar ul li a:hover {
            color: #fff; /* Highlighted white text */
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            height: 100vh;
            background-color: #f4f4f4; /* Light gray */
        }
        .main-content h2 {
            color: #1c7430; /* Green headings */
            margin-bottom: 20px;
        }
        .cards-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .card {
            background-color: #fff; /* White card background */
            color: #333; /* Black text */
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            flex: 1 1 calc(33.333% - 20px);
            min-width: 300px;
            text-align: center;
            position: relative;
        }
        .card h3 {
            margin: 0;
            font-size: 36px;
        }
        .card p {
            font-size: 20px;
            margin: 10px 0 20px;
        }
        .card a {
            text-decoration: none;
            background-color: #1c7430; /* Green buttons */
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background-color 0.3s;
        }
        .card a:hover {
            background-color: #145a23; /* Darker green on hover */
        }
    </style>
</head>
<body>

<div class="sidebar">
    <img src="images\logo\file-removebg-preview.png" alt="EAMARKETS Logo">
    <h2>EAMARKETS</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard Home</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="properties.php">Properties</a></li>
        <li><a href="registered_property.php">Registered properties</a></li>
        <li><a href="register_property.php">Registration Form</a></li>
    </ul>
</div>

<div class="main-content">
    <h2>Dashboard Home</h2>
    <div class="cards-container">
        <!-- Card 1: Total Properties -->
        <div class="card">
            <h3><?php echo $totalProperties; ?></h3>
            <p>Total Properties</p>
            <a href="?page=properties">View List</a>
        </div>
        <!-- Card 2: Total Agents -->
        <div class="card">
            <h3><?php echo $totalAgents; ?></h3>
            <p>Agents Submitted</p>
            <a href="?page=agents">View Agents</a>
        </div>
        <!-- Card 3: Total Installments -->
        <div class="card">
            <h3><?php echo $totalInstallments; ?></h3>
            <p>Total Installments</p>
            <a href="?page=installments">View Installments</a>
        </div>
    </div>
</div>

</body>
</html>
