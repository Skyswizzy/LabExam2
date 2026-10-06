<?php

include "db.php";

if (!isset($_GET['id'])) {
    header("Location: orders.php");
    exit;
}

$id = intval($_GET['id']);


/* Update */

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
        "UPDATE orders SET
        customer_name = ?,
        contact = ?,
        address = ?,
        container_type = ?,
        quantity = ?,
        price = ?,
        total_amount = ?,
        order_date = ?,
        status = ?
        WHERE id = ?"
    );

    $stmt->bind_param(
        "ssssiddssi",
        $customer_name,
        $contact,
        $address,
        $container_type,
        $quantity,
        $price,
        $total_amount,
        $order_date,
        $status,
        $id
    );

    if ($stmt->execute()) {

        header("Location: orders.php?message=Order updated successfully");
        exit;

    }

}


/* Get existing record */

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

    <title>Edit Order</title>

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
                Edit Order
            </h1>

            <p class="page-subtitle">
                Update customer and order information
            </p>


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
                                    value="<?= htmlspecialchars($order['customer_name']) ?>"
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
                                    value="<?= htmlspecialchars($order['contact']) ?>"
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
                                    required><?= htmlspecialchars($order['address']) ?></textarea>

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Container Type
                                </label>

                                <select
                                    name="container_type"
                                    class="form-select"
                                    required>

                                    <option
                                        value="5 Gallon"
                                        <?= $order['container_type'] == '5 Gallon' ? 'selected' : '' ?>>
                                        5 Gallon
                                    </option>

                                    <option
                                        value="3 Gallon"
                                        <?= $order['container_type'] == '3 Gallon' ? 'selected' : '' ?>>
                                        3 Gallon
                                    </option>

                                    <option
                                        value="1 Gallon"
                                        <?= $order['container_type'] == '1 Gallon' ? 'selected' : '' ?>>
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
                                    value="<?= $order['quantity'] ?>"
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
                                    value="<?= $order['price'] ?>"
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
                                    value="<?= $order['order_date'] ?>"
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

                                    <option
                                        value="Pending"
                                        <?= $order['status'] == 'Pending' ? 'selected' : '' ?>>
                                        Pending
                                    </option>

                                    <option
                                        value="Completed"
                                        <?= $order['status'] == 'Completed' ? 'selected' : '' ?>>
                                        Completed
                                    </option>

                                    <option
                                        value="Cancelled"
                                        <?= $order['status'] == 'Cancelled' ? 'selected' : '' ?>>
                                        Cancelled
                                    </option>

                                </select>

                            </div>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary-custom">
                            Update Order
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