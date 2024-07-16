<?php
// Example of retrieving products (replace with actual database connection and query)
$products = [
    ['id' => 1, 'name' => 'Product 1', 'price' => 10.99, 'description' => 'Description of Product 1', 'image' => 'product1.jpg'],
    ['id' => 2, 'name' => 'Product 2', 'price' => 19.99, 'description' => 'Description of Product 2', 'image' => 'product2.jpg'],
    ['id' => 3, 'name' => 'Product 3', 'price' => 5.99, 'description' => 'Description of Product 3', 'image' => 'product3.jpg'],
    ['id' => 4, 'name' => 'Product 4', 'price' => 15.99, 'description' => 'Description of Product 4', 'image' => 'product4.jpg'],
    ['id' => 5, 'name' => 'Product 5', 'price' => 12.99, 'description' => 'Description of Product 5', 'image' => 'product5.jpg'],
    ['id' => 6, 'name' => 'Product 6', 'price' => 8.99, 'description' => 'Description of Product 6', 'image' => 'product6.jpg'],
];

// Function to fetch products from the database (mocked data)
function getProducts() {
    global $products;
    return $products;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Custom styles -->
    <style>
        /* Additional styles for product listing page */
        .product-card {
            margin-bottom: 20px;
        }
        .product-image {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">All Products</h2>
    <div class="row">
        <?php foreach (getProducts() as $product): ?>
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="assets/images/<?php echo $product['image']; ?>" class="card-img-top product-image" alt="<?php echo $product['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text"><?php echo $product['description']; ?></p>
                        <p class="card-text"><strong>Price: $<?php echo number_format($product['price'], 2); ?></strong></p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Add additional JavaScript if needed -->
</body>
</html>
