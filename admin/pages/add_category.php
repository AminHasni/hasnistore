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
$error_message = '';
$success_message = '';

// Handle form submission to add category
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];

    if (!empty($category_name)) {
        // Insert new category into the database
        $sql_insert = "INSERT INTO categories (category_name) VALUES (:category_name)";
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->bindParam(':category_name', $category_name, PDO::PARAM_STR);

        if ($stmt_insert->execute()) {
            $success_message = "Category added successfully.";
            $category_name = ''; // Clear input field
        } else {
            $error_message = "Failed to add category. Please try again.";
        }
    } else {
        $error_message = "Category name is required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - Admin Panel</title>
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
</head>
<body>
    <div class="container">
        <h2>Add New Category</h2>

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

        <!-- Add Category Form -->
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo isset($category_name) ? $category_name : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="add_category">Add Category</button>
            <a href="categories.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
