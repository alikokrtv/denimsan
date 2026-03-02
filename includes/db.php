<?php
// includes/db.php
// Database Connection file

$host = 'localhost'; // Change for VPS if necessary
$db = 'denimsan_db';
$user = 'root';      // Development default, change for production
$pass = '';          // Development default, change for production
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'"
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // For Production: don't output $e->getMessage() directly to the user.
    die('Database connection failed: ' . $e->getMessage());
}
?>