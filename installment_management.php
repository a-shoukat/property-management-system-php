<?php
include("config.php");

// Fetch Installment Data
$users = [
    ['name' => 'Ali', 'amount' => 10000, 'paid' => false, 'due_date' => '2024-11-15'],
    ['name' => 'Sara', 'amount' => 20000, 'paid' => true, 'due_date' => '2024-11-10'],
    ['name' => 'Ahmed', 'amount' => 15000, 'paid' => false, 'due_date' => '2024-11-12']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Installment Management</title>
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Muli', sans-serif;
        }
        .table th, .table td {
            text-align: center;
        }
        .table-danger {
            background-color: #f8d7da;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center">Installment Management</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Amount (PKR)</th>
                <th>Paid</th>
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr class="<?= !$user['paid'] && strtotime($user['due_date']) < time() ? 'table-danger' : '' ?>">
                    <td><?= $user['name'] ?></td>
                    <td>Rs <?= number_format($user['amount']) ?></td>
                    <td><?= $user['paid'] ? 'Yes' : 'No' ?></td>
                    <td><?= $user['due_date'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const overdue = document.querySelector('.table-danger');
        if (overdue) {
            alert('Some users have overdue payments!');
        }
    });
</script>
</body>
</html>
