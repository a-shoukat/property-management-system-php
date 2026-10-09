<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "realestatephp";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch property registration data
$registrationsQuery = "SELECT pr.registration_id, pr.name, pr.email, pr.cnic, p.title AS property_title, pr.registration_date
                      FROM property_registrations pr
                      JOIN property p ON pr.property_id = p.pid
                      ORDER BY pr.registration_date DESC";
$registrationsResult = $conn->query($registrationsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Registration Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
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
            color: #ccc;
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
            color: #fff;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .main-content h2 {
            color: #1c7430;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #1c7430;
            color: #fff;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <img src="images/logo/file-removebg-preview.png" alt="EAMARKETS Logo">
    <h2>EAMARKETS</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard Home</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="properties.php">Properties</a></li>
        <li><a href="registered_property.php">Registered Properties</a></li>
        <li><a href="registration.php">Registration Form</a></li>
    </ul>
</div>

<div class="main-content">
    <h2>Property Registration Requests</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>CNIC</th>
                <th>Property</th>
                <th>Registration Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($registrationsResult->num_rows > 0) {
                while ($registration = $registrationsResult->fetch_assoc()) {
                    echo "<tr>
                            <td>{$registration['registration_id']}</td>
                            <td>{$registration['name']}</td>
                            <td>{$registration['email']}</td>
                            <td>{$registration['cnic']}</td>
                            <td>{$registration['property_title']}</td>
                            <td>{$registration['registration_date']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No registration requests found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
