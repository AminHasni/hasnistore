<?php
session_start();

// Mock user data (replace with actual database query)
$user = [
    'id' => 1,
    'username' => 'hasni_user',
    'email' => 'user@example.com',
    'fullname' => 'Hasni User',
    'address' => '123 Main St, City, Country',
    'phone' => '123-456-7890'
];

// Handle form submission for updating user information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulated update process
    $user['email'] = $_POST['email'];
    $user['fullname'] = $_POST['fullname'];
    $user['address'] = $_POST['address'];
    $user['phone'] = $_POST['phone'];

    // Simulate success message
    $success_message = "Your information has been updated successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings - Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Custom styles -->
    <style>
        /* Additional styles for settings page */
        .form-control {
            margin-bottom: 15px;
        }
        .success-message {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Account Settings</h2>

            <?php if (isset($success_message)): ?>
                <div class="alert alert-success success-message" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="fullname">Full Name:</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $user['fullname']; ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="3"><?php echo $user['address']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
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
