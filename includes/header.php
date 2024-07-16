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



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="assets/images/hasniStore.png" alt="Logo" height="40">
            Hasni_Store
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="#">Cart <i class="fas fa-shopping-cart ml-1"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Section Images Dynamiques -->
<section class="header-image">
    <div id="headerCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/pexels-fauxels-3184306.jpg" class="d-block w-100" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="assets/images/pexels-fauxels-3184306.jpg" class="d-block w-100" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="assets/images/pexels-fauxels-3184306.jpg" class="d-block w-100" alt="Image 3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#headerCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#headerCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

