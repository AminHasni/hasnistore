<?php
// Start the session (if needed)
session_start();

// Example product data grouped by categories (replace with your actual product data)
$products = [
    'Electronics' => [
        [
            'name' => 'Smartphone',
            'image' => 'assets/images/product1.jpg',
            'price' => '$399',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        ],
        [
            'name' => 'Laptop',
            'image' => 'assets/images/product2.jpg',
            'price' => '$999',
            'description' => 'Nullam ac urna et arcu ornare feugiat non nec diam.',
        ],
        [
            'name' => 'Tablet',
            'image' => 'assets/images/product3.jpg',
            'price' => '$299',
            'description' => 'Praesent ac velit consequat, accumsan dui eu, vehicula est.',
        ],
    ],
    'Clothing' => [
        [
            'name' => 'T-Shirt',
            'image' => 'assets/images/product4.jpg',
            'price' => '$29',
            'description' => 'Morbi mattis risus at purus aliquam, nec luctus urna posuere.',
        ],
        [
            'name' => 'Jeans',
            'image' => 'assets/images/product5.jpg',
            'price' => '$59',
            'description' => 'Vestibulum fermentum odio ac magna convallis, nec placerat lorem condimentum.',
        ],
        [
            'name' => 'Dress',
            'image' => 'assets/images/product6.jpg',
            'price' => '$79',
            'description' => 'Maecenas auctor nisi nec lorem varius, sed fermentum augue vestibulum.',
        ],
    ],
];

// Function to display products under a category
function displayProducts($category, $products)
{
    foreach ($products[$category] as $product) {
        echo '
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card product-card border-0 shadow-sm">
                <img src="' . $product['image'] . '" class="card-img-top rounded-top" alt="' . $product['name'] . '">
                <div class="card-body">
                    <h5 class="card-title text-primary">' . $product['name'] . '</h5>
                    <p class="card-text text-muted">' . $product['description'] . '</p>
                    <p class="card-text"><strong>Price: ' . $product['price'] . '</strong></p>
                    <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                </div>
            </div>
        </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        /* Custom CSS styles for products.php */
        .product-card {
            transition: transform 0.3s ease-in-out;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .product-card .card-img-top {
            height: 250px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }
        .product-card .card-title {
            font-size: 1.2rem;
        }
        .product-card .card-text {
            line-height: 1.5;
        }
    </style>
</head>
<body>

<?php include './includes/header.php'; ?>

<div class="container mt-5">
    <!-- Categories Section -->
    <div class="row mb-4">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach (array_keys($products) as $category): ?>
                            <li class="list-group-item"><a href="#<?php echo strtolower($category); ?>"><?php echo $category; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <?php foreach ($products as $category => $categoryProducts): ?>
        <div id="<?php echo strtolower($category); ?>" class="row">
            <div class="col">
                <h2 class="text-center mb-4"><?php echo $category; ?></h2>
            </div>
        </div>
        <div class="row">
            <?php displayProducts($category, $products); ?>
        </div>
    <?php endforeach; ?>
</div>

<?php include './includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
