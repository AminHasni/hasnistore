<?php
session_start();

// Mock user's orders data (replace with actual database query)
$orders = [
    [
        'order_id' => 'ORD001',
        'date' => '2024-07-10',
        'total' => 120.50,
        'status' => 'Delivered',
        'items' => [
            ['product_name' => 'Product A', 'quantity' => 2, 'price' => 50.25],
            ['product_name' => 'Product B', 'quantity' => 1, 'price' => 20.00]
        ]
    ],
    [
        'order_id' => 'ORD002',
        'date' => '2024-07-08',
        'total' => 80.00,
        'status' => 'Processing',
        'items' => [
            ['product_name' => 'Product C', 'quantity' => 1, 'price' => 80.00]
        ]
    ]
    // Add more orders as needed
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Custom styles -->
    <style>
        /* Additional styles for orders page */
        .order-item {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .order-item .order-details {
            margin-bottom: 10px;
        }
        .order-item .order-details h5 {
            margin-bottom: 0;
        }
        .order-item .order-items-list {
            margin-top: 10px;
        }
        .order-item .order-items-list ul {
            list-style-type: none;
            padding: 0;
        }
        .order-item .order-items-list ul li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>My Orders</h2>
            <?php foreach ($orders as $order): ?>
                <div class="order-item">
                    <div class="order-details">
                        <h5>Order ID: <?php echo $order['order_id']; ?></h5>
                        <p>Date: <?php echo $order['date']; ?></p>
                        <p>Total: $<?php echo number_format($order['total'], 2); ?></p>
                        <p>Status: <?php echo $order['status']; ?></p>
                    </div>
                    <div class="order-items-list">
                        <h6>Items:</h6>
                        <ul>
                            <?php foreach ($order['items'] as $item): ?>
                                <li><?php echo $item['product_name']; ?> (Quantity: <?php echo $item['quantity']; ?>, Price: $<?php echo number_format($item['price'], 2); ?> each)</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Add additional JavaScript if needed -->
</body>
</html>
