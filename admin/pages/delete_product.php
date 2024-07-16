<?php
session_start();

// Check if user is logged in as admin, redirect to login page if not
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection file
require_once '../db/db_connect.php';

// Process deletion when product ID is provided via GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Sanitize and validate product ID
    $product_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if ($product_id === false) {
        // Invalid product ID
        header("Location: products.php");
        exit();
    }

    // Prepare a DELETE statement
    $sql = "DELETE FROM products WHERE id = :id";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind product ID parameter
        $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);

        // Set parameter
        $param_id = $product_id;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Product deleted successfully, redirect to products list
            header("Location: products.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
} else {
    // Redirect to products list if product ID is not provided or method is not GET
    header("Location: products.php");
    exit();
}
?>
