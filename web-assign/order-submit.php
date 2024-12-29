<?php
if (!isset($_POST['food']) || !isset($_POST['quantity'])) {
    http_response_code(400);
    exit("Invalid request.");
}

$food = $_POST['food'];
$quantity = (int)$_POST['quantity'];

$conn = new mysqli("localhost", "root", "", "inventory");
$result = $conn->query("SELECT quantity, price FROM items WHERE name='$food'");
if ($result->num_rows == 0) {
    echo "Sorry, we don't have any '$food' in stock.";
    exit;
}

$row = $result->fetch_assoc();
if ($row['quantity'] < $quantity) {
    echo "Sorry, we don't have $quantity of '$food' in stock.";
    exit;
}

$total = $quantity * $row['price'];
echo "Order successful! Total cost: $" . number_format($total, 2);
?>
