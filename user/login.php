<?php
session_start();

// Mock user authentication (replace with actual database query)
$users = [
    ['username' => 'user1', 'password' => 'password1', 'fullname' => 'User One'],
    ['username' => 'user2', 'password' => 'password2', 'fullname' => 'User Two']
];

$errors = []; // Array to store validation errors

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username and password
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // Authenticate user
    $authenticated = false;
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $user['fullname'];
            $authenticated = true;
            break;
        }
    }

    if ($authenticated) {
        // Redirect to user panel or dashboard
        header('Location: user_panel/dashboard.php');
        exit();
    } else {
        $errors[] = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hasni_Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Custom styles -->
    <style>
        /* Additional styles for login page */
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
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Login to Hasni_Store</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger error-message" role="alert">
                            <?php foreach ($errors as $error): ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
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
