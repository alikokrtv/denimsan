<?php
require_once 'includes/db.php';

$tr_text = "Denimsa; sahip olduğu bilgi, tecrübe ve birikimlerini siz değerli müşterileri ile paylaşmanın heyecanını ve mutluluğunu duyar. Sektörde 20 yıllık tecrübesi ile sektöre ve siz değerli müşterilerine çözüm ortağı olarak hizmet vermeyi kendine birinci vazife ve hedef seçmiştir.";

$en_text = "Denimsa is excited and happy to share its knowledge, experience, and background with our valued customers. With 20 years of experience in the sector, we have set it as our primary duty and goal to serve as a solution partner to the industry and our esteemed clients.";

try {
    $stmt = $pdo->prepare("UPDATE site_settings SET about_text_tr = ?, about_text_en = ? WHERE id = 1");
    $stmt->execute([$tr_text, $en_text]);
    echo "SUCCESS: About Us text updated correctly with UTF-8.";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
?>