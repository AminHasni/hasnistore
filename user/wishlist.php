<?php
// Example of user's wishlist (replace with actual database connection and query)
$wishlist = [
    ['id' => 1, 'name' => 'Product 1', 'price' => 10.99, 'description' => 'Description of Product 1', 'image' => 'product1.jpg'],
    ['id' => 3, 'name' => 'Product 3', 'price' => 5.99, 'description' => 'Description of Product 3', 'image' => 'product3.jpg'],
    ['id' => 5, 'name' => 'Product 5', 'price' => 12.99, 'description' => 'Description of Product 5', 'image' => 'product5.jpg'],
];

// Function to retrieve product details from the database (mocked data)
function getProductById($id) {
    global $wishlist; // Replace with actual database query
    foreach ($wishlist as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
    return null; // Return null if product is not found
}

// Function to remove product from wishlist (example, replace with actual functionality)
function removeFromWishlist($productId) {
    // Implement your logic to remove the product from the user's wishlist (e.g., database update)
    // Example:
    // unset($_SESSION['wishlist'][$productId]);
    // Alternatively, update database table to remove product from user's wishlist
    // Redirect to wishlist.php or refresh current page after processing
    header("Location: wishlist.php");
    exit;
}

// Example of getting product ID from URL to remove from wishlist
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    removeFromWishlist($productId);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Custom styles -->
    <style>
        /* Additional styles for wishlist page */
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
    <h2 class="text-center mb-4">My Wishlist</h2>
    <?php if (empty($wishlist)): ?>
        <div class="alert alert-info" role="alert">
            Your wishlist is empty.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($wishlist as $product): ?>
                <div class="col-md-4">
                    <div class="card product-card">
                        <img src="assets/images/<?php echo $product['image']; ?>" class="card-img-top product-image" alt="<?php echo $product['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="card-text"><?php echo $product['description']; ?></p>
                            <p class="card-text"><strong>Price: $<?php echo number_format($product['price'], 2); ?></strong></p>
                            <a href="product-details.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>
                            <a href="wishlist.php?action=remove&id=<?php echo $product['id']; ?>" class="btn btn-danger">Remove from Wishlist</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Add additional JavaScript if needed -->
</body>
</html>
