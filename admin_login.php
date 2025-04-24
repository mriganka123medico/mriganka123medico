<?php
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: admin_dashboard.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_email = $_POST["email"];
    $admin_pass = $_POST["password"];

    // Hardcoded admin credentials (you can later store in DB)
    if ($admin_email === "admin@saree.com" && $admin_pass === "admin123") {
        $_SESSION["admin"] = true;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>
