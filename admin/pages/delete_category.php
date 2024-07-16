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
$category_id = $_POST['category_id'] ?? $_GET['id'] ?? null;
$error_message = '';
$success_message = '';

// Handle form submission to delete category
if (!empty($category_id)) {
    // Delete category from the database
    $sql_delete = "DELETE FROM categories WHERE category_id = :category_id";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':category_id', $category_id, PDO::PARAM_INT);

    if ($stmt_delete->execute()) {
        $success_message = "Category deleted successfully.";
    } else {
        $error_message = "Failed to delete category. Please try again.";
    }
} else {
    $error_message = "Category ID is required.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Category - Admin Panel</title>
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
        <h2>Delete Category</h2>

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

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="category_id">Category ID</label>
                <input type="text" class="form-control" id="category_id" name="category_id">
            </div>
            <button type="submit" class="btn btn-danger">Delete Category</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
