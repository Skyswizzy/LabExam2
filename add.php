<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customer_name = $_POST['customer_name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $container_type = $_POST['container_type'];
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);
    $order_date = $_POST['order_date'];
    $status = $_POST['status'];

    $total_amount = $quantity * $price;

    $stmt = $conn->prepare(
        "INSERT INTO orders
        (customer_name, contact, address, container_type,
        quantity, price, total_amount, order_date, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssssiddss",
        $customer_name,
        $contact,
        $address,
        $container_type,
        $quantity,
        $price,
        $total_amount,
        $order_date,
        $status
    );

    if ($stmt->execute()) {

        header("Location: orders.php?message=Order added successfully");
        exit;

    } else {

        $error = "Failed to add order.";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Order</title>

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
                Add New Order
            </h1>

            <p class="page-subtitle">
                Enter customer and order information
            </p>


            <?php if (isset($error)): ?>

                <div class="alert alert-danger">
                    <?= $error ?>
                </div>

            <?php endif; ?>


            <div class="card card-custom">

                <div class="card-body">

                    <form method="POST">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Customer Name
                                </label>

                                <input
                                    type="text"
                                    name="customer_name"
                                    class="form-control"
                                    required>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Contact Number
                                </label>

                                <input
                                    type="text"
                                    name="contact"
                                    class="form-control"
                                    required>

                            </div>


                            <div class="col-md-12 mb-3">

                                <label class="form-label">
                                    Address
                                </label>

                                <textarea
                                    name="address"
                                    class="form-control"
                                    rows="3"
                                    required></textarea>

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Container Type
                                </label>

                                <select
                                    name="container_type"
                                    class="form-select"
                                    required>

                                    <option value="5 Gallon">
                                        5 Gallon
                                    </option>

                                    <option value="3 Gallon">
                                        3 Gallon
                                    </option>

                                    <option value="1 Gallon">
                                        1 Gallon
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Quantity
                                </label>

                                <input
                                    type="number"
                                    name="quantity"
                                    class="form-control"
                                    min="1"
                                    value="1"
                                    required>

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Price Per Container
                                </label>

                                <input
                                    type="number"
                                    name="price"
                                    class="form-control"
                                    step="0.01"
                                    min="0"
                                    required>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Order Date
                                </label>

                                <input
                                    type="date"
                                    name="order_date"
                                    class="form-control"
                                    value="<?= date('Y-m-d') ?>"
                                    required>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Status
                                </label>

                                <select
                                    name="status"
                                    class="form-select"
                                    required>

                                    <option value="Pending">
                                        Pending
                                    </option>

                                    <option value="Completed">
                                        Completed
                                    </option>

                                    <option value="Cancelled">
                                        Cancelled
                                    </option>

                                </select>

                            </div>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary-custom">
                            Save Order
                        </button>

                        <a
                            href="orders.php"
                            class="btn btn-secondary">
                            Cancel
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>