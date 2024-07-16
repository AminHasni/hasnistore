<?php
session_start();

// Example of mock products in the shopping cart (replace with actual product data from database)
$products = [
    ['id' => 1, 'name' => 'Product 1', 'price' => 10.99, 'quantity' => 2],
    ['id' => 2, 'name' => 'Product 2', 'price' => 19.99, 'quantity' => 1],
    ['id' => 3, 'name' => 'Product 3', 'price' => 5.99, 'quantity' => 3]
];

// Function to calculate total price
function calculateTotal($products) {
    $total = 0;
    foreach ($products as $product) {
        $total += $product['price'] * $product['quantity'];
    }
    return $total;
}

// Handle form submission (mock for demonstration)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process payment and complete order (replace with actual payment processing logic)
    $payment_success = true; // Mock payment success

    if ($payment_success) {
        // Clear the shopping cart after successful payment
        $_SESSION['cart'] = [];
        $success_message = "Thank you for your order! Your payment was successful.";
    } else {
        $error_message = "Payment failed. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Custom styles -->
    <style>
        /* Additional styles for checkout page */
        .card-body {
            padding: 20px;
        }
        .form-control {
            width: 100%;
        }
        .total-price {
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Checkout</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($success_message)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    <h4>Order Summary</h4>
                    <
