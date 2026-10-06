<?php

include "db.php";

if (!isset($_GET['id'])) {
    header("Location: orders.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: orders.php");
    exit;
}

$order = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Order</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="style.css">

</head>

<body>

<nav class="navbar navbar-custom">

    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="dashboard.php">
            💧 Water Refilling System
        </a>

    </div>

</nav>


<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 sidebar">

            <a href="dashboard.php">
                Dashboard
            </a>

            <a href="orders.php" class="active">
                Orders
            </a>

        </div>


        <div class="col-md-10 main-content">

            <h1 class="page-title">
                Order Details
            </h1>

            <div class="card card-custom mt-4">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <strong>Order ID:</strong>

                            <p>
                                <?= $order['id'] ?>
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Customer Name:</strong>

                            <p>
                                <?= htmlspecialchars($order['customer_name']) ?>
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Contact:</strong>

                            <p>
                                <?= htmlspecialchars($order['contact']) ?>
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Address:</strong>

                            <p>
                                <?= htmlspecialchars($order['address']) ?>
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Container:</strong>

                            <p>
                                <?= htmlspecialchars($order['container_type']) ?>
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Quantity:</strong>

                            <p>
                                <?= $order['quantity'] ?>
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Price:</strong>

                            <p>
                                ₱<?= number_format($order['price'], 2) ?>
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Total Amount:</strong>

                            <p>
                                ₱<?= number_format($order['total_amount'], 2) ?>
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Order Date:</strong>

                            <p>
                                <?= $order['order_date'] ?>
                            </p>

                        </div>


                        <div class="col-md-6 mb-3">

                            <strong>Status:</strong>

                            <p>
                                <?= htmlspecialchars($order['status']) ?>
                            </p>

                        </div>

                    </div>


                    <a
                        href="edit.php?id=<?= $order['id'] ?>"
                        class="btn btn-warning">
                        Edit
                    </a>

                    <a
                        href="orders.php"
                        class="btn btn-secondary">
                        Back
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>