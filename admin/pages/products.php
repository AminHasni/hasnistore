<?php
session_start();

// Check if user is logged in as admin, redirect to login page if not
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection file
require_once '../db/db_connect.php';

// Fetch all products from the database
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);

// Initialize an empty array to store products
$products = [];

// Check if there are products
if ($stmt->rowCount() > 0) {
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Close statement
unset($stmt);

// Close connection
unset($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <style>
        .product-image {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h2>Products</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Return to Dashboard</a>
        <a href="add_product.php" class="btn btn-success mb-3">Add New Product</a>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price (TND)</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['description']; ?></td>
                            <td><?php echo number_format($product['price'], 2); ?> TND</td>
                            <td><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image"></td>
                            <td>
                                <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
