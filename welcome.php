<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2>Welcome, <?php echo $_SESSION["name"]; ?>!</h2>
  <p>You have successfully logged in.</p>
  <a href="index.html" class="btn btn-primary">Go to Home</a>
</div>
</body>
</html>
