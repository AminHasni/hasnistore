<?php
session_start();

// Mock user registration (replace with actual database interaction)
$registered = false;
$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If no errors, proceed with registration (mock success)
    if (empty($errors)) {
        // Simulate user registration (replace with actual database insert)
        // Here, you would typically hash the password before storing it in the database
        $registered = true;

        // Simulate success message
        $success_message = "Registration successful. You can now login.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Custom styles -->
    <style>
        /* Additional styles for registration page */
        .form-control {
            margin-bottom: 15px;
        }
        .error-message {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Register for Hasni_Store</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger error-message" role="alert">
                            <?php foreach ($errors as $error): ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($registered && isset($success_message)): ?>
                        <div class="alert alert-success success-message" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
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
