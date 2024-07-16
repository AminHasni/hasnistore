<?php
session_start();

// Mock user data (replace with actual database query)
$user = [
    'username' => 'john_doe',
    'email' => 'john.doe@example.com',
    'fullname' => 'John Doe',
    'address' => '123 Main St, City, Country',
    // Add more fields as needed
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Hasni_Store</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Include Bootstrap or any other CSS framework if used -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Additional styles for animations and design */
        .profile-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .profile-card .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .profile-card .btn-edit-profile {
            background-color: #28a745;
            border-color: #28a745;
        }
        .profile-card .btn-edit-profile:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-card">
                <div class="card-header">
                    User Profile
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" class="form-control" value="<?php echo $user['username']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" value="<?php echo $user['email']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" class="form-control" value="<?php echo $user['fullname']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" class="form-control" rows="3" readonly><?php echo $user['address']; ?></textarea>
                    </div>
                    <!-- Add more fields as needed -->

                    <button class="btn btn-primary btn-edit-profile">Edit Profile</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Add additional JavaScript if needed -->
<script>
    // Example: Add animations or interactive features with JavaScript
    $(document).ready(function() {
        $('.btn-edit-profile').on('click', function() {
            // Replace this with actual edit profile functionality
            alert('Implement edit profile functionality here!');
        });
    });
</script>
</body>
</html>
