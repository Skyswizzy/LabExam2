<?php

include "db.php";

if (!isset($_GET['id'])) {
    header("Location: orders.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");

$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    header("Location: orders.php?message=Order deleted successfully");
    exit;

} else {

    echo "Failed to delete order.";

}

?>