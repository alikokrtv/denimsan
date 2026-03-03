<?php
// includes/db.php — Multi-environment database connection

$host = 'localhost';
$db = 'denimsan_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// 1. Railway production (environment variables set in Railway dashboard)
if (getenv('MYSQLHOST')) {
    $host = getenv('MYSQLHOST');
    if (getenv('MYSQLPORT')) {
        $host .= ';port=' . getenv('MYSQLPORT');
    }
    $db = getenv('MYSQLDATABASE') ?: $db;
    $user = getenv('MYSQLUSER') ?: $user;
    $pass = getenv('MYSQLPASSWORD') ?: $pass;

} elseif (getenv('MYSQL_URL') || getenv('DATABASE_URL')) {
    $rawUrl = getenv('MYSQL_URL') ?: getenv('DATABASE_URL');
    $url = parse_url($rawUrl);
    $host = $url['host'] ?? $host;
    $user = $url['user'] ?? $user;
    $pass = $url['pass'] ?? $pass;
    $db = isset($url['path']) ? ltrim($url['path'], '/') : $db;
    if (isset($url['port'])) {
        $host .= ';port=' . $url['port'];
    }

    // 2. Hostinger production — denimsan.com
} elseif (isset($_SERVER['SERVER_NAME']) && strpos($_SERVER['SERVER_NAME'], 'denimsan.com') !== false) {
    $host = 'localhost';
    $db = 'u177542463_denimsan';
    $user = 'u177542463_root';
    $pass = '255223Rtv..';
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
    die('Database connection failed.');
}
?>