<?php
// process_register.php

session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if the username or email already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['register_error'] = "Username or email already exists.";
        header('Location: register.php');
        exit();
    } else {
        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);

        $_SESSION['username'] = $username;
        header('Location: user_panel.php');
        exit();
    }
}
?>
