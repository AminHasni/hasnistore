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

// Fetching customers for dropdown (assuming customers are stored in `customers` table)
$sql_customers = "SELECT customer_id, full_name FROM customers";
$stmt_customers = $pdo->query($sql_customers);
$customers = $stmt_customers->fetchAll(PDO::FETCH_ASSOC);

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $order_date = $_POST['order_date'];
    $total_amount = $_POST['total_amount'];
    $status = $_POST['status'];

    // Inserting new order into database
    $sql_insert_order = "INSERT INTO orders (customer_id, order_date, total_amount, status) VALUES (:customer_id, :order_date, :total_amount, :status)";
    $stmt_insert_order = $pdo->prepare($sql_insert_order);
    $stmt_insert_order->execute([
        ':customer_id' => $customer_id,
        ':order_date' => $order_date,
        ':total_amount' => $total_amount,
        ':status' => $status,
    ]);

    // Redirect to orders.php after adding order
    header("Location: orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Order</title>
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
</head>
<body>
    <div class="container">
        <h2>Add New Order</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="customer_id">Customer</label>
                <select class="form-control" id="customer_id" name="customer_id" required>
                    <option value="">Select Customer</option>
                    <?php foreach ($customers as $customer): ?>
                        <option value="<?php echo $customer['customer_id']; ?>"><?php echo htmlspecialchars($customer['full_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="order_date">Order Date</label>
                <input type="datetime-local" class="form-control" id="order_date" name="order_date" required>
            </div>
            <div class="form-group">
                <label for="total_amount">Total Amount ($)</label>
                <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Order</button>
            <a href="orders.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
