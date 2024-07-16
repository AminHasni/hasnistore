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

// Handle quantity updates and item removals
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantity'] as $product_id => $quantity) {
            // Update quantity for the product in the session cart
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }
    } elseif (isset($_POST['remove_item'])) {
        $product_id = $_POST['remove_item'];
        // Remove item from the session cart
        unset($_SESSION['cart'][$product_id]);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Custom styles -->
    <style>
        /* Additional styles for shopping cart page */
        .cart-item {
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }
        .form-control {
            width: 60px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Shopping Cart</h2>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <?php if (!empty($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <form method="POST">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                        <tr class="cart-item">
                                            <td><?php echo $product['name']; ?></td>
                                            <td>$<?php echo number_format($product['price'], 2); ?></td>
                                            <td>
                                                <input type="number" name="quantity[<?php echo $product['id']; ?>]" class="form-control" min="1" value="<?php echo $product['quantity']; ?>">
                                            </td>
                                            <td>$<?php echo number_format($product['price'] * $product['quantity'], 2); ?></td>
                                            <td>
                                                <button type="submit" class="btn btn-danger btn-sm" name="remove_item" value="<?php echo $product['id']; ?>">Remove</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" name="update_cart">Update Cart</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <p>Your shopping cart is empty.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Cart Summary</h4>
                    <?php if (!empty($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <p>Total Items: <?php echo count($_SESSION['cart']); ?></p>
                        <p>Total Price: $<?php echo number_format(calculateTotal($products), 2); ?></p>
                        <a href="checkout.php" class="btn btn-primary btn-block">Proceed to Checkout</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Add additional JavaScript if needed -->
</body>
</html>
