<?php
// Example of retrieving a single product (replace with actual database connection and query)
$products = [
    ['id' => 1, 'name' => 'Product 1', 'price' => 10.99, 'description' => 'Description of Product 1', 'image' => 'product1.jpg'],
    ['id' => 2, 'name' => 'Product 2', 'price' => 19.99, 'description' => 'Description of Product 2', 'image' => 'product2.jpg'],
    ['id' => 3, 'name' => 'Product 3', 'price' => 5.99, 'description' => 'Description of Product 3', 'image' => 'product3.jpg'],
    ['id' => 4, 'name' => 'Product 4', 'price' => 15.99, 'description' => 'Description of Product 4', 'image' => 'product4.jpg'],
    ['id' => 5, 'name' => 'Product 5', 'price' => 12.99, 'description' => 'Description of Product 5', 'image' => 'product5.jpg'],
    ['id' => 6, 'name' => 'Product 6', 'price' => 8.99, 'description' => 'Description of Product 6', 'image' => 'product6.jpg'],
];

// Function to fetch a single product from the database (mocked data)
function getProductById($id) {
    global $products;
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
    return null; // Return null if product is not found
}

// Example of getting product ID from URL (replace with actual method)
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $product = getProductById($productId);

    if (!$product) {
        // Redirect or handle error if product not found
        header("Location: products.php");
        exit;
    }
} else {
    // Redirect or handle error if product ID is not provided
    header("Location: products.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Custom styles -->
    <style>
        /* Additional styles for product details page */
        .product-image {
            max-width: 100%;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="assets/images/<?php echo $product['image']; ?>" class="img-fluid product-image" alt="<?php echo $product['name']; ?>">
        </div>
        <div class="col-md-6">
            <h2><?php echo $product['name']; ?></h2>
            <p><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
            <p><strong>Description:</strong><br><?php echo $product['description']; ?></p>
            <form action="cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Add additional JavaScript if needed -->
</body>
</html>
