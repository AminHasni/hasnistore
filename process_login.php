<?php
// process_login.php

session_start();
include './db_file/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header('Location: user_panel.php');
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid username or password.";
        header('Location: login.php');
        exit();
    }
}
?>
