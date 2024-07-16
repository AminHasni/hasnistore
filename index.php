<?php
session_start();

// Exemple de données pour les produits avec des images dynamiques
$products = [
    ["name" => "Product 1", "price" => "$10.00", "image" => "assets/images/product1.jpg"],
    ["name" => "Product 2", "price" => "$15.00", "image" => "assets/images/product2.jpg"],
    ["name" => "Product 3", "price" => "$20.00", "image" => "assets/images/product3.jpg"],
    ["name" => "Product 4", "price" => "$25.00", "image" => "assets/images/product4.jpg"],
];

// Exemple de données pour les catégories avec des images
$categories = [
    ["name" => "Electronics", "image" => "assets/images/electronics.jpg"],
    ["name" => "Fashion", "image" => "assets/images/fashion.jpg"],
    ["name" => "Home & Garden", "image" => "assets/images/home_garden.jpg"],
];

// Exemple de données pour les articles de blog avec des images
$blogPosts = [
    ["title" => "10 Must-Have Gadgets for 2024", "date" => "January 10, 2024", "image" => "assets/images/blog1.jpg"],
    ["title" => "Fashion Trends: What's In and Out", "date" => "February 15, 2024", "image" => "assets/images/blog2.jpg"],
];

// Exemple de données pour les témoignages avec des images
$testimonials = [
    ["name" => "John Doe", "text" => "Great products and excellent customer service!", "image" => "assets/images/user1.jpg"],
    ["name" => "Jane Smith", "text" => "I love shopping here, highly recommended.", "image" => "assets/images/user2.jpg"],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<?php include './includes/header.php'; ?>

<div class="container mt-5">
    <!-- Section: Featured Products -->
    <section id="featured-products" class="mb-5">
        <h2 class="mb-4">Featured Products</h2>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow">
                        <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="card-text"><?php echo $product['price']; ?></p>
                            <a href="#" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Section: Categories -->
    <section id="categories" class="mb-5">
        <h2 class="mb-4">Categories</h2>
        <div class="row">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow category-card">
                        <img src="<?php echo $category['image']; ?>" class="card-img-top" alt="<?php echo $category['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $category['name']; ?></h5>
                            <a href="#" class="btn btn-primary">Explore</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Section: Latest Blog Posts -->
    <section id="latest-blog-posts" class="mb-5">
        <h2 class="mb-4">Latest Blog Posts</h2>
        <div class="row">
            <?php foreach ($blogPosts as $post): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow blog-card">
                        <img src="<?php echo $post['image']; ?>" class="card-img-top" alt="<?php echo $post['title']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $post['title']; ?></h5>
                            <p class="card-text"><?php echo $post['date']; ?></p>
                            <a href="#" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Section: Testimonials -->
    <section id="testimonials" class="mb-5">
        <h2 class="mb-4">Customer Testimonials</h2>
        <div id="testimonialsCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($testimonials as $index => $testimonial): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="card shadow testimonial-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo $testimonial['image']; ?>" class="rounded-circle mr-3" style="width: 80px; height: 80px;" alt="<?php echo $testimonial['name']; ?>">
                                    <div>
                                        <h5><?php echo $testimonial['name']; ?></h5>
                                        <p><?php echo $testimonial['text']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#testimonialsCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#testimonialsCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
</div>

<?php include './includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
