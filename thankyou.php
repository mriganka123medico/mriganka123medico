<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $phone = htmlspecialchars($_POST['phone']);
    $cart = $_SESSION['cart'] ?? [];

    // Clear the cart
    unset($_SESSION['cart']);
} else {
    // Redirect if page accessed directly
    header("Location: products.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Order Placed</title>
</head>
<body>
  <h2>Thank you, <?= $name ?>! 🎉</h2>
  <p>Your order has been placed successfully.</p>
  <p><strong>Delivery Address:</strong> <?= $address ?> | <?= $phone ?> | <?= $email ?></p>
  <p><a href="products.php">Continue Shopping</a></p>
</body>
</html>
