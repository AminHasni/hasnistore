<?php
// Start session
session_start();

// Check if user is logged in as admin, redirect to login page if not
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection file
require_once '../db/db_connect.php';

// Retrieve admin details from session
$admin_id = $_SESSION['admin_id'];
$username = $_SESSION['username'];
$full_name = $_SESSION['full_name'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    $new_full_name = trim($_POST['full_name']);
    $new_password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Initialize error array
    $errors = [];

    // Validate form data
    if (empty($new_username)) {
        $errors[] = "Username is required.";
    }
    if (empty($new_email) || !filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }
    if (empty($new_full_name)) {
        $errors[] = "Full name is required.";
    }
    if (!empty($new_password) && $new_password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If no errors, proceed to update the database
    if (empty($errors)) {
        try {
            // Update admin details in the database
            $sql = "UPDATE admins SET username = :username, email = :email, full_name = :full_name WHERE admin_id = :admin_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $new_username);
            $stmt->bindParam(':email', $new_email);
            $stmt->bindParam(':full_name', $new_full_name);
            $stmt->bindParam(':admin_id', $admin_id);
            $stmt->execute();

            // If password is provided, update it
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql = "UPDATE admins SET password = :password WHERE admin_id = :admin_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindParam(':admin_id', $admin_id);
                $stmt->execute();
            }

            // Update session variables
            $_SESSION['username'] = $new_username;
            $_SESSION['email'] = $new_email;
            $_SESSION['full_name'] = $new_full_name;

            // Success message
            $success_message = "Settings updated successfully.";

        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="stylesheet" href="assets/css/dashboard.css"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <style>
        .error-message {
            color: red;
        }
        .success-message {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h2>Admin Settings</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Return to Dashboard</a>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Update Admin Details Form -->
            <div class="col-md-6">
                <h3>Update Admin Details</h3>
                <form action="settings.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo htmlspecialchars($full_name); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">New Password (leave blank to keep current password)</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <!-- Additional Settings -->
            <div class="col-md-6">
                <h3>Additional Settings</h3>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Update Site Settings</a>
                    <a href="#" class="list-group-item list-group-item-action">Manage User Roles</a>
                    <a href="#" class="list-group-item list-group-item-action">View Logs</a>
                    <a href="#" class="list-group-item list-group-item-action">Backup Data</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
