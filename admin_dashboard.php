<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <a href="admin_logout.php" class="btn btn-danger">Logout</a>
  </div>
</nav>
<div class="container mt-5">
    <h1>Welcome, Admin</h1>
    <a href="manage_products.php" class="btn btn-primary">Manage Products</a>
    <!-- You can add links for Users and Orders here later -->
</div>
</body>
</html>
