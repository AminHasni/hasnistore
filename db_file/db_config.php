<?php
// Database configuration
$dbHost = 'localhost'; // Change this to your database host
$dbName = 'hasni_store'; // Change this to your database name
$dbUser = 'root'; // Change this to your database username
$dbPass = ''; // Change this to your database password
$dbCharset = 'utf8mb4'; // Change this if necessary

// Database connection using PDO
try {
    $pdo = new PDO("mysql:host={$dbHost};dbname={$dbName};charset={$dbCharset}", $dbUser, $dbPass);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle database connection error
    die("Connection failed: " . $e->getMessage());
}
?>
