<?php
// Start session
session_start();

// Include database connection file
require_once '../db/db_connect.php';

// Check if user is already logged in, redirect to dashboard if true
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input (you can add more validation as needed)
    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        // Prepare SQL statement to retrieve admin details
        $sql = "SELECT * FROM Admins WHERE username = :username";

        // Prepare the SQL statement and bind parameters
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        // Execute the query
        if ($stmt->execute()) {
            // Check if admin exists
            if ($stmt->rowCount() == 1) {
                // Fetch admin details
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verify password
                if ($password === $admin['password']) {
                    // Password is correct, start a new session
                    session_regenerate_id();
                    $_SESSION['admin_id'] = $admin['admin_id'];
                    $_SESSION['username'] = $admin['username'];
                    $_SESSION['full_name'] = $admin['full_name'];

                    // Redirect to admin dashboard
                    header("Location: dashboard.php");
                    exit();
                } else {
                    // Password is not correct
                    $error = "Incorrect password.";
                }
            } else {
                // Admin with given username not found
                $error = "Admin not found with the provided username.";
            }
        } else {
            // Query execution error
            $error = "Oops! Something went wrong. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Login</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS for styling -->
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <h2 class="text-center">Admin Panel Login</h2>
                    <?php if (isset($error)): ?>
                        <p class="error"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
