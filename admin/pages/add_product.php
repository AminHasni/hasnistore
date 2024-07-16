<?php
session_start();

// Check if user is logged in as admin, redirect to login page if not
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection file
require_once '../db/db_connect.php';

// Initialize variables for form inputs
$name = $description = $price = '';
$image = 'assets/images/default_product.jpg'; // Default image path

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs (add more validation as needed)
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $price = floatval($_POST['price']);

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_dir = '../assets/images/';
        $image_name = basename($_FILES['image']['name']);
        $image_path = $image_dir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image = 'assets/images/' . $image_name;
        } else {
            // Handle upload error
            $error_message = "Failed to upload image.";
        }
    }

    // Insert product into database
    $sql = "INSERT INTO products (name, description, price, image) VALUES (:name, :description, :price, :image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'image' => $image
    ]);

    // Redirect after insertion (adjust URL as needed)
    header("Location: products.php");
    exit();
}

// Close connection
unset($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
</head>
<body>
    <div class="container-fluid">
        <h2>Add Product</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price (TND)</label>
                <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
            <a href="products.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Bootstrap and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
