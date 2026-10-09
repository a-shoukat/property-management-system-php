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

// Fetch data for Agents and Users
$agentsQuery = "SELECT * FROM user WHERE utype = 'agent'";
$agentsResult = $conn->query($agentsQuery);

$usersQuery = "SELECT * FROM user WHERE utype = 'user'";
$usersResult = $conn->query($usersQuery);

// Send mail logic
if (isset($_POST['send_mail'])) {
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Email sending logic for selected users
    if (isset($_POST['selected_users'])) {
        $selectedUsers = $_POST['selected_users'];
        
        foreach ($selectedUsers as $userId) {
            // Fetch user email by user ID
            $userQuery = "SELECT uemail FROM user WHERE uid = $userId";
            $userResult = $conn->query($userQuery);
            $user = $userResult->fetch_assoc();

            $recipient = $user['uemail'];
            $headers = "From: admin@yourdomain.com";

            // Send email to selected users
            mail($recipient, $subject, $message, $headers);
        }
        echo "<script>alert('Email sent successfully!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent & User Details</title>
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
        .send-mail-section {
            margin-top: 30px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .send-mail-section input, .send-mail-section textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .send-mail-section button {
            background-color: #1c7430;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        .send-mail-section button:hover {
            background-color: #145a23;
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
        <li><a href="?page=properties">Properties</a></li>
        <li><a href="registered_property.php">Registered Properties</a></li>
        <li><a href="register_property.php">Registration Form</a></li>
    </ul>
</div>

<div class="main-content">
    <h2>Agent and User Details</h2>

    <!-- Agent Table -->
    <h3>Agent Details</h3>
    <form method="POST">
        <table>
            <thead>
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($agentsResult->num_rows > 0) {
                    while ($agent = $agentsResult->fetch_assoc()) {
                        echo "<tr>
                                <td><input type='checkbox' name='selected_users[]' value='{$agent['uid']}'></td>
                                <td>{$agent['uid']}</td>
                                <td>{$agent['uname']}</td>
                                <td>{$agent['uemail']}</td>
                                <td>{$agent['uphone']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No agents found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- User Table -->
        <h3>User Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($usersResult->num_rows > 0) {
                    while ($user = $usersResult->fetch_assoc()) {
                        echo "<tr>
                                <td><input type='checkbox' name='selected_users[]' value='{$user['uid']}'></td>
                                <td>{$user['uid']}</td>
                                <td>{$user['uname']}</td>
                                <td>{$user['uemail']}</td>
                                <td>{$user['uphone']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Send Mail Section -->
        <div class="send-mail-section">
            <h4>Send an Email</h4>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" placeholder="Message" rows="4" required></textarea>
            <button type="submit" name="send_mail">Send Email</button>
        </div>
    </form>
</div>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
