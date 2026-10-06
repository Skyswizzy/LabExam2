<?php

include "db.php";

$totalOrders = 0;
$totalCustomers = 0;
$totalSales = 0;
$pendingOrders = 0;

$result = $conn->query("SELECT COUNT(*) AS total FROM orders");
if ($result) {
    $row = $result->fetch_assoc();
    $totalOrders = $row['total'];
}

$result = $conn->query("SELECT COUNT(DISTINCT customer_name) AS total FROM orders");
if ($result) {
    $row = $result->fetch_assoc();
    $totalCustomers = $row['total'];
}

$result = $conn->query("SELECT SUM(total_amount) AS total FROM orders WHERE status = 'Completed'");
if ($result) {
    $row = $result->fetch_assoc();
    $totalSales = $row['total'] ?? 0;
}

$result = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE status = 'Pending'");
if ($result) {
    $row = $result->fetch_assoc();
    $pendingOrders = $row['total'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Water Refilling System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="style.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-custom">

    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="dashboard.php">
            💧 Water Refilling System
        </a>

    </div>

</nav>


<div class="container-fluid">

    <div class="row">

        <!-- Sidebar -->

        <div class="col-md-2 sidebar">

            <a href="dashboard.php" class="active">
                Dashboard
            </a>

            <a href="orders.php">
                Orders
            </a>

        </div>


        <!-- Main Content -->

        <div class="col-md-10 main-content">

            <h1 class="page-title">
                Dashboard
            </h1>

            <p class="page-subtitle">
                Welcome to the Water Refilling System
            </p>


            <div class="row g-4 mt-3">

                <div class="col-md-3">

                    <div class="dashboard-card">

                        <p>Total Orders</p>

                        <h2>
                            <?= $totalOrders ?>
                        </h2>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="dashboard-card">

                        <p>Total Customers</p>

                        <h2>
                            <?= $totalCustomers ?>
                        </h2>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="dashboard-card">

                        <p>Completed Sales</p>

                        <h2>
                            ₱<?= number_format($totalSales, 2) ?>
                        </h2>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="dashboard-card">

                        <p>Pending Orders</p>

                        <h2>
                            <?= $pendingOrders ?>
                        </h2>

                    </div>

                </div>

            </div>


            <div class="card card-custom mt-5">

                <div class="card-body">

                    <h4 class="page-title">
                        Water Refilling Station
                    </h4>

                    <p>
                        Manage customers, water orders, containers,
                        prices, and order status using the system.
                    </p>

                    <a href="add.php" class="btn btn-primary-custom">
                        + Add New Order
                    </a>

                    <a href="orders.php" class="btn btn-cream">
                        View Orders
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>