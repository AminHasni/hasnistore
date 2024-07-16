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

// Retrieve admin details from session
$admin_id = $_SESSION['admin_id'];
$username = $_SESSION['username'];
$full_name = $_SESSION['full_name'];

// Total number of users
$sql_total_users = "SELECT COUNT(*) AS total_users FROM users";
$stmt_total_users = $pdo->query($sql_total_users);
$total_users = $stmt_total_users->fetch(PDO::FETCH_ASSOC)['total_users'] ?? 0;

// Total sales in the last month
$sql_total_sales = "SELECT SUM(total_amount) AS total_sales FROM orders WHERE DATE_FORMAT(order_date, '%Y-%m') = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y-%m')";
$stmt_total_sales = $pdo->query($sql_total_sales);
$total_sales = $stmt_total_sales->fetch(PDO::FETCH_ASSOC)['total_sales'] ?? 0;

// Recent orders
$sql_recent_orders = "SELECT * FROM orders ORDER BY order_date DESC LIMIT 5";
$stmt_recent_orders = $pdo->query($sql_recent_orders);
$recent_orders = $stmt_recent_orders->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <style>
        body {
            display: flex;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #ddd;
            display: block;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="users.php">Users</a>
        <a href="orders.php">Orders</a>
        <a href="products.php">Products</a>
        <a href="categories.php">Categories</a>
        <a href="reports.php">Reports</a>
        <a href="settings.php">Settings</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h2>Welcome, <?php echo htmlspecialchars($full_name); ?></h2>
        <p class="lead">This is your admin dashboard.</p>

        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?php echo htmlspecialchars($total_users); ?></p>
                        <a href="users.php" class="btn btn-outline-primary btn-sm">View Users</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales (Last Month)</h5>
                        <p class="card-text">$<?php echo number_format($total_sales, 2); ?></p>
                        <a href="orders.php" class="btn btn-outline-success btn-sm">View Orders</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Recent Orders</h5>
                        <div class="list-group">
                            <?php foreach ($recent_orders as $order): ?>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Order #<?php echo htmlspecialchars($order['order_id']); ?> - $<?php echo number_format($order['total_amount'], 2); ?>
                                    <span class="badge badge-info float-right"><?php echo htmlspecialchars(date('M d, Y', strtotime($order['order_date']))); ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <a href="orders.php" class="btn btn-outline-info btn-sm mt-2">View All Orders</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-8 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Sales Overview</h5>
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Top Products</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Product 1</li>
                            <li class="list-group-item">Product 2</li>
                            <li class="list-group-item">Product 3</li>
                            <li class="list-group-item">Product 4</li>
                            <li class="list-group-item">Product 5</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">User Activity</h5>
                        <p>Details about user activity...</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">System Notifications</h5>
                        <p>Details about system notifications...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Chart.js scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Chart.js script to initialize a bar chart
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Sales ($)',
                    data: [1000, 1500, 2000, 1800, 2500, 2200],
                    backgroundColor: '#007bff', // Bootstrap primary color
                    borderColor: '#007bff',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
