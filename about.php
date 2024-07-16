<?php
// Start the session (if needed)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<?php include './includes/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    About Us
                </div>
                <div class="card-body">
                    <h3>Welcome to Hasni_Store!</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ultricies libero et eros elementum, at tincidunt nunc lacinia. Suspendisse potenti.</p>
                    <p>Phasellus sit amet lacinia nisi, in dapibus risus. Nulla facilisi. Mauris dignissim nulla ac orci facilisis, id efficitur ex fermentum.</p>
                    <p>Donec in tellus vitae eros ultrices condimentum. Aenean auctor, sapien non varius posuere, velit metus feugiat libero, eget consectetur erat erat eget orci.</p>
                    <p>Curabitur tempor justo vel tellus lacinia, vitae auctor orci ultrices. Sed eu neque nec est dictum scelerisque. Fusce euismod aliquet ante, a cursus erat dapibus ac.</p>
                    <p>Nullam vitae consequat mauris, eu bibendum enim. Vivamus tincidunt velit id orci feugiat faucibus. Integer feugiat lorem eget felis tincidunt vestibulum.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
