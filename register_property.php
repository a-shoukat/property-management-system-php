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

// Fetch available properties
$propertiesQuery = "SELECT pid, title, location FROM property";
$propertiesResult = $conn->query($propertiesQuery);

// Initialize message type
$messageType = "";
$messageContent = "";

// Handle property registration
if (isset($_POST['register_property'])) {
    $userName = $_POST['name'];
    $userEmail = $_POST['email'];
    $userCnic = $_POST['cnic'];
    $propertyId = $_POST['property'];

    // Insert into property_registrations table
    $registerQuery = "INSERT INTO property_registrations (name, email, cnic, property_id) VALUES ('$userName', '$userEmail', '$userCnic', '$propertyId')";

    if ($conn->query($registerQuery) === TRUE) {
        $messageType = "success";
        $messageContent = "Property registered successfully!";
    } else {
        $messageType = "error";
        $messageContent = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Registration</title>
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
        .main-content .registration-form {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .registration-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1c7430;
        }
        .registration-form label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        .registration-form input, .registration-form select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .registration-form button {
            width: 100%;
            padding: 10px;
            background-color: #1c7430;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .registration-form button:hover {
            background-color: #145a23;
        }
        /* Toast Notification */
        #toast {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 4px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }
        #toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }
        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
        #toast.success { background-color: #4caf50; }
        #toast.error { background-color: #f44336; }
    </style>
</head>
<body>

<div class="sidebar">
    <img src="images/logo/file-removebg-preview.png" alt="EAMARKETS Logo">
    <h2>EAMARKETS</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard Home</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="?page=properties">Properties</a></li>
        <li><a href="registered_property.php">Registered Properties</a></li>
        <li><a href="?page=registration">Registration Form</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="registration-form">
        <h2>Property Registration</h2>
        <form method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="cnic">CNIC:</label>
            <input type="text" id="cnic" name="cnic" placeholder="Enter your CNIC" required>

            <label for="property">Select Property:</label>
            <select id="property" name="property" required>
                <option value="">-- Select a Property --</option>
                <?php
                if ($propertiesResult->num_rows > 0) {
                    while ($property = $propertiesResult->fetch_assoc()) {
                        echo "<option value='{$property['pid']}'>{$property['title']} - {$property['location']}</option>";
                    }
                } else {
                    echo "<option value=''>No properties available</option>";
                }
                ?>
            </select>

            <button type="submit" name="register_property">Register Property</button>
        </form>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="<?= $messageType; ?>"><?= $messageContent; ?></div>
</div>

<script>
    // Show toast notification if there's a message
    const messageType = "<?= $messageType; ?>";
    if (messageType) {
        const toast = document.getElementById("toast");
        toast.className = "show " + messageType;
        setTimeout(() => { toast.className = toast.className.replace("show", ""); }, 3000);
    }
</script>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
