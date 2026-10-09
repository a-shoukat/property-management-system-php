<?php
session_start();
include("config.php");

// Pre-fill the amount if passed from the property page
$amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : 0;

// Calculate Installments
if ($amount > 0) {
    $plans = [
        6 => $amount / 6,
        12 => $amount / 12,
        18 => $amount / 18,
        24 => $amount / 24,
        36 => $amount / 36
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Installment Plan Calculator</title>
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style>
        /* Your CSS styling here */
        body {
            font-family: 'Muli', sans-serif;
            background-color: #f4f9f4;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 20px;
        }
        .plan-btn {
            margin: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .plan-btn:hover {
            background-color: #0056b3;
        }
        .registration-form {
            margin-top: 30px;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Installment Plan Calculator</h2>
    </div>

    <div class="container">
        <!-- Display Amount -->
        <form method="get">
            <div class="form-group text-center">
                <label for="amount">Enter Amount (PKR):</label>
                <input type="number" name="amount" id="amount" class="form-control" style="max-width: 300px; display: inline;" value="<?= htmlspecialchars($amount) ?>" required>
            </div>
            <button type="submit" name="calc" class="btn btn-primary">Calculate Installments</button>
        </form>

        <hr>

        <!-- Display Plans -->
        <?php if (!empty($plans)): ?>
            <div class="text-center">
                <?php foreach ($plans as $months => $installment): ?>
                    <button class="plan-btn" onclick="showPlan(<?= $months ?>, <?= $installment ?>)">View <?= $months ?>-Month Plan</button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <div class="registration-form">
            <h3>Register to Buy a House on Rent</h3>
            <form action="submit_registration.php" method="post">
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit Registration</button>
            </form>
        </div>
    </div>

    <script>
        function showPlan(months, installment) {
            const planDetails = `
                <h3>${months}-Month Installment Plan</h3>
                <table border="1" cellpadding="5" style="width: 100%; text-align: left;">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Installment</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${[...Array(months).keys()].map(i => `
                            <tr>
                                <td>Month ${i + 1}</td>
                                <td>Rs ${installment.toFixed(0)}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;
            const newWindow = window.open('', '', 'width=600,height=400');
            newWindow.document.write(`<html><head><title>Plan Details</title></head><body>${planDetails}</body></html>`);
            newWindow.document.close();
        }
    </script>
</body>
</html>
