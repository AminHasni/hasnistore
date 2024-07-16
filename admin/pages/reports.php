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

// Retrieve data for reports
// Example: Total number of users
$sql_total_users = "SELECT COUNT(*) AS total_users FROM users";
$stmt_total_users = $pdo->query($sql_total_users);
$total_users = $stmt_total_users->fetch(PDO::FETCH_ASSOC)['total_users'];

// Example: Total sales in the last month
$sql_total_sales = "SELECT SUM(total_amount) AS total_sales FROM orders WHERE DATE_FORMAT(order_date, '%Y-%m') = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y-%m')";
$stmt_total_sales = $pdo->query($sql_total_sales);
$total_sales = $stmt_total_sales->fetch(PDO::FETCH_ASSOC)['total_sales'];

// Example: Most popular products
$sql_popular_products = "SELECT product_id, COUNT(*) AS sold_count FROM order_items GROUP BY product_id ORDER BY sold_count DESC LIMIT 5";
$stmt_popular_products = $pdo->query($sql_popular_products);
$popular_products = $stmt_popular_products->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
</head>
<body>
    <div class="container-fluid">
        <h2>Reports</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Return to Dashboard</a>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?php echo $total_users; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales (Last Month)</h5>
                        <p class="card-text"><?php echo $total_sales !== null ? number_format($total_sales, 2) : '0.00'; ?> TND</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Most Popular Products</h5>
                        <ul class="list-group">
                            <?php foreach ($popular_products as $product): ?>
                                <li class="list-group-item"><?php echo htmlspecialchars($product['product_name']); ?> - <?php echo $product['sold_count']; ?> sold</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Sales Overview</h5>
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">User Growth</h5>
                        <canvas id="usersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Chart.js scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Sales Chart
        var ctxSales = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctxSales, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Sales (TND)',
                    data: [1000, 1500, 2000, 1800, 2500, 2200, 2700, 3000, 3500, 4000, 4500, 5000],
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: '#007bff',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Users Chart
        var ctxUsers = document.getElementById('usersChart').getContext('2d');
        var usersChart = new Chart(ctxUsers, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'New Users',
                    data: [30, 50, 80, 60, 90, 120, 150, 170, 190, 220, 240, 300],
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: '#28a745',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>
