<?php
session_start();

// Check if user is logged in as admin, redirect to login page if not
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection file
require_once '../db/db_connect.php';

// Initialize variables
$id = $_GET['id'] ?? null;

// Fetch product details from the database based on ID
$sql = "SELECT * FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Check if a new image file is uploaded
    if ($_FILES['image']['name']) {
        // Upload image file to a directory and store the path in the database
        $target_dir = "../uploads/"; // Specify the directory where you want to save the images
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
                // Update product details including the image path
                $sql = "UPDATE products SET name = :name, description = :description, price = :price, image = :image WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['name' => $name, 'description' => $description, 'price' => $price, 'image' => $image_path, 'id' => $id]);

                // Redirect to products.php after successful update
                header("Location: products.php");
                exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Update product details without updating the image path
        $sql = "UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name, 'description' => $description, 'price' => $price, 'id' => $id]);

        // Redirect to products.php after successful update
        header("Location: products.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
</head>
<body>
    <div class="container-fluid">
        <h2>Edit Product</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price (TND):</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="mt-2" style="max-width: 200px;">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a> <!-- Added button to return to dashboard -->
        </form>
    </div>

    <!-- Bootstrap and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
