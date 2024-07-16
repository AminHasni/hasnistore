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

// Retrieve orders from database
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$stmt = $pdo->query($sql);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
</head>
<body>
    <div class="container-fluid">
        <h2>Orders</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Return to Dashboard</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Order Date</th>
                    <th>Total Amount (TND)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['customer_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td><?php echo number_format($order['total_amount'], 2); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td>
                            <a href="edit_order.php?id=<?php echo $order['order_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete_order.php?id=<?php echo $order['order_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap and JQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
