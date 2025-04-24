<?php
// Start the session
session_start();

// Check if the user is logged in as admin, otherwise redirect
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: login.php');
    exit;
}

// Include database connection
include 'db.php';

// Fetch products from the database
$query = "SELECT * FROM products";
$result = $conn->query($query);

// Handle add product request
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $insert_query = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
        if ($conn->query($insert_query)) {
            header('Location: manage_products.php');
            exit;
        } else {
            $error = "Error adding product.";
        }
    } else {
        $error = "Error uploading image.";
    }
}

// Handle delete product request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM products WHERE id = $id";
    if ($conn->query($delete_query)) {
        header('Location: manage_products.php');
        exit;
    } else {
        $error = "Error deleting product.";
    }
}

// Handle edit product request
if (isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $update_query = "UPDATE products SET name = '$name', description = '$description', price = '$price' WHERE id = $id";
    if ($conn->query($update_query)) {
        header('Location: manage_products.php');
        exit;
    } else {
        $error = "Error updating product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2 class="mb-4">Manage Products</h2>

  <!-- Error message -->
  <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

  <!-- Add Product Form -->
  <h3>Add New Product</h3>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Description</label>
      <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
      <label>Price</label>
      <input type="number" name="price" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Image</label>
      <input type="file" name="image" class="form-control" required>
    </div>
    <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
  </form>

  <hr>

  <!-- List Products -->
  <h3>All Products</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo htmlspecialchars($row['name']); ?></td>
          <td><?php echo htmlspecialchars($row['description']); ?></td>
          <td>₹<?php echo htmlspecialchars($row['price']); ?></td>
          <td><img src="images/<?php echo htmlspecialchars($row['image']); ?>" width="100" alt="Product Image"></td>
          <td>
            <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="manage_products.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
