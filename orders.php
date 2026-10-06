<?php

include "db.php";

$sql = "SELECT * FROM orders ORDER BY id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Orders - Water Refilling System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        <!-- Sidebar -->

        <div class="col-md-2 sidebar">

            <a href="dashboard.php">
                Dashboard
            </a>

            <a href="orders.php" class="active">
                Orders
            </a>

        </div>


        <!-- Main Content -->

        <div class="col-md-10 main-content">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h1 class="page-title">
                        Water Orders
                    </h1>

                    <p class="page-subtitle">
                        Manage customer water orders
                    </p>

                </div>

                <a href="add.php" class="btn btn-primary-custom">
                    + Add Order
                </a>

            </div>


            <?php if (isset($_GET['message'])): ?>

                <div class="alert alert-success">
                    <?= htmlspecialchars($_GET['message']) ?>
                </div>

            <?php endif; ?>


            <div class="card card-custom">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover align-middle">

                            <thead>

                                <tr>

                                    <th>ID</th>

                                    <th>Customer</th>

                                    <th>Contact</th>

                                    <th>Container</th>

                                    <th>Quantity</th>

                                    <th>Total</th>

                                    <th>Date</th>

                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if ($result->num_rows > 0): ?>

                                    <?php while ($row = $result->fetch_assoc()): ?>

                                        <tr>

                                            <td>
                                                <?= $row['id'] ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['customer_name']) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['contact']) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars($row['container_type']) ?>
                                            </td>

                                            <td>
                                                <?= $row['quantity'] ?>
                                            </td>

                                            <td>
                                                ₱<?= number_format($row['total_amount'], 2) ?>
                                            </td>

                                            <td>
                                                <?= $row['order_date'] ?>
                                            </td>

                                            <td>

                                                <?php if ($row['status'] == 'Completed'): ?>

                                                    <span class="badge bg-success">
                                                        Completed
                                                    </span>

                                                <?php elseif ($row['status'] == 'Cancelled'): ?>

                                                    <span class="badge bg-danger">
                                                        Cancelled
                                                    </span>

                                                <?php else: ?>

                                                    <span class="badge bg-warning text-dark">
                                                        Pending
                                                    </span>

                                                <?php endif; ?>

                                            </td>

                                            <td>

                                                <div class="action-icons">

    <a
        href="edit.php?id=<?= $row['id'] ?>"
        class="action-edit"
        title="Edit Order">
        <i class="bi bi-pencil-square"></i>
    </a>

    <a
        href="delete.php?id=<?= $row['id'] ?>"
        class="action-delete"
        title="Delete Order"
        onclick="return confirm('Are you sure you want to delete this order?');">
        <i class="bi bi-trash"></i>
    </a>

</div>

                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <tr>

                                        <td colspan="9" class="text-center">
                                            No orders found.
                                        </td>

                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>