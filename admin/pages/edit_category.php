<?php
// Start session
session_start();

// Check if user is logged in as admin, redirect to login page if not
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection file
require_once '../db/db_connect.php';

// Initialize variables
$category_id = $_GET['id'] ?? null;
$error_message = '';
$success_message = '';

// Fetch category details from database
if (!empty($category_id)) {
    $sql = "SELECT * FROM categories WHERE category_id = :category_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        $error_message = "Category not found.";
    }
}

// Handle form submission to update category
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = trim($_POST['category_name']);

    // Validate category name (basic validation)
    if (!empty($category_name)) {
        // Update category in the database
        $sql_update = "UPDATE categories SET category_name = :category_name WHERE category_id = :category_id";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->bindParam(':category_name', $category_name, PDO::PARAM_STR);
        $stmt_update->bindParam(':category_id', $category_id, PDO::PARAM_INT);

        if ($stmt_update->execute()) {
            $success_message = "Category updated successfully.";
            $category['category_name'] = $category_name; // Update displayed category name
        } else {
            $error_message = "Failed to update category. Please try again.";
        }
    } else {
        $error_message = "Category name cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <style>
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Category</h2>

        <?php if ($error_message): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($success_message): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if ($category): ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $category['category_id']); ?>">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo htmlspecialchars($category['category_name']); ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </form>
        <?php else: ?>
            <p>No category found.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>