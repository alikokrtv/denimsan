<?php
// includes/db.php
// Database Connection file

$host = 'localhost'; // Change for VPS if necessary
$db = 'denimsan_db';
$user = 'root';      // Development default, change for production
$pass = '';          // Development default, change for production
$charset = 'utf8mb4';

// Dynamic host configuration for Railway/VPS production
if (getenv('MYSQLHOST')) {
    $host = getenv('MYSQLHOST');
    if (getenv('MYSQLPORT')) {
        $host .= ";port=" . getenv('MYSQLPORT');
    }
    $db = getenv('MYSQLDATABASE');
    $user = getenv('MYSQLUSER');
    $pass = getenv('MYSQLPASSWORD');
} elseif (getenv('MYSQL_URL')) {
    $url = parse_url(getenv('MYSQL_URL'));
    $host = $url["host"] ?? '';
    $user = $url["user"] ?? '';
    $pass = $url["pass"] ?? '';
    $db = isset($url["path"]) ? ltrim($url["path"], '/') : '';
    if (isset($url["port"])) {
        $host .= ";port=" . $url["port"];
    }
} elseif (getenv('DATABASE_URL')) {
    $url = parse_url(getenv('DATABASE_URL'));
    $host = $url["host"] ?? '';
    $user = $url["user"] ?? '';
    $pass = $url["pass"] ?? '';
    $db = isset($url["path"]) ? ltrim($url["path"], '/') : '';
    if (isset($url["port"])) {
        $host .= ";port=" . $url["port"];
    }
}

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // For Production: don't output $e->getMessage() directly to the user.
    die('Database connection failed: ' . $e->getMessage());
}
?>