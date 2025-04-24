<?php
session_start();
$total = 0;
foreach ($_SESSION['cart'] ?? [] as $item) {
    $total += $item['price'] * $item['quantity'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $mobile = htmlspecialchars($_POST['mobile']);
    
    // Simulate saving order (can later save to DB)
    $success = true;

    // Clear cart
    $_SESSION['cart'] = [];

    echo "<script>alert('Thank you $name! Your order has been placed.'); window.location.href='index.html';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4">Checkout</h2>

  <?php if ($total > 0): ?>
  <p><strong>Total Amount: ₹<?= number_format($total) ?></strong></p>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Full Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Delivery Address</label>
      <textarea name="address" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Mobile Number</label>
      <input type="tel" name="mobile" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Place Order</button>
  </form>

  <?php else: ?>
    <p>Your cart is empty. <a href="index.html">Shop now</a>.</p>
  <?php endif; ?>
</div>
</body>
</html>
