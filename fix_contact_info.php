<?php
require_once 'includes/db.php';

$address = "Mehmet Nezih Özmen Mah. Kasım Sk. No:5/E Merter Güngören İSTANBUL";
$email = "info@denimsan.com.tr";

// Make sure PDO handles unicode correctly and direct string avoids powershell encoding issues
$stmt = $pdo->prepare("UPDATE site_settings SET contact_address = ?, contact_email = ? WHERE id = 1");
$stmt->execute([$address, $email]);

echo "DB updated successfully via PHP.";
