<?php
require_once 'includes/db.php';

try {
    // Ensuring the connection is UTF-8
    $pdo->exec("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");

    // Update Site Settings
    $stmt1 = $pdo->prepare("UPDATE site_settings SET about_title_tr = ?, about_text_tr = ? WHERE id = 1");
    $stmt1->execute([
        'Hakkımızda',
        'DENIMSAN hakkında varsayılan metin. Yüksek kaliteli denim üretimi.'
    ]);

    // Update Categories
    $stmt2 = $pdo->prepare("UPDATE collection_categories SET title_tr = ?, description_tr = ? WHERE id = 1");
    $stmt2->execute([
        'Erkek Koleksiyon',
        'Premium denim serisi.'
    ]);

    echo "Successfully updated database with UTF-8 strings.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>