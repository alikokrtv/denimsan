<?php
// includes/functions.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
header('Content-Type: text/html; charset=utf-8');

// Set/Get Active Language (Default to 'tr')
if (isset($_GET['lang']) && in_array(strtolower($_GET['lang']), ['tr', 'en'])) {
    $_SESSION['lang'] = strtolower($_GET['lang']);
}
$current_lang = $_SESSION['lang'] ?? 'tr';

// Fetch Global Site Settings based on the chosen language
function get_settings($pdo, $lang)
{
    // Basic test
    $stmt = $pdo->query("SELECT * FROM site_settings WHERE id = 1");
    $settings = $stmt->fetch();

    // Abstract the bilingual fields easily
    return [
        'about_title' => $settings['about_title_' . $lang],
        'about_text' => $settings['about_text_' . $lang],
        'contact_email' => $settings['contact_email'],
        'contact_phone' => $settings['contact_phone'],
        'contact_address' => $settings['contact_address'],
        'linkedin_url' => $settings['linkedin_url'],
        'hero_video_url' => $settings['hero_video_url']
    ];
}

$site_config = get_settings($pdo, $current_lang);

// Static Dictionary Translation Array for Interface Text
$dictionary = [
    'tr' => [
        'home' => 'Ana Sayfa',
        'about_us' => 'Hakkımızda',
        'collections' => 'Koleksiyon',
        'gallery' => 'Galeri',
        'corporate' => 'Kurumsal',
        'story_of_denim' => 'Denimin Hikayesi',
        'career' => 'Kariyer',
        'contact' => 'İletişim & Showroom',
        'discover' => 'Keşfet',
        'send_message' => 'Mesaj Gönder',
        'name' => 'Adınız Soyadınız',
        'email' => 'E-posta Adresiniz',
        'subject' => 'Konu',
        'message' => 'Mesajınız',
        'language_switch' => 'EN',
        'language_link' => '?lang=en',
        'footer_text' => 'Tüm hakları saklıdır.',
        'contact_us' => 'Bize Ulaşın',
        'support_line' => 'Destek Hattı',
        'working_hours' => 'Pzt - Cmt: 08:00 - 18:00',
        'about_denimsa' => 'Denimsan Hakkında',
        'values' => 'Değerler ve Hedefler',
        'how_we_produce' => 'Nasıl Üretiyoruz?',
        'certificates' => 'Sertifikalarımız',
        'announcements' => 'Duyurular',
        'contact_menu' => 'İletişim',
        'vision_mission' => 'Vizyon & Misyon',
        'vision_text' => 'Sektörde 20 yıllık tecrübesi ile sektöre ve siz değerli müşterilerine çözüm ortağı olarak hizmet vermeyi kendine birinci vazife ve hedef seçmiştir. Denimsan web sayfası yakında burada hizmetinizde olacak.',
        'production_title' => 'Nasıl Üretiyoruz?',
        'production_text' => 'Premium denim kumaşlarımız, sürdürülebilir üretim teknikleri ve yenilikçi dokuma makineleri kullanılarak, kalite standartlarından ödün vermeden özenle üretilmektedir.'
    ],
    'en' => [
        'home' => 'Home',
        'about_us' => 'About Us',
        'collections' => 'Collections',
        'gallery' => 'Gallery',
        'corporate' => 'Corporate',
        'story_of_denim' => 'Story of Denim',
        'career' => 'Career',
        'contact' => 'Contact & Showroom',
        'discover' => 'Discover',
        'send_message' => 'Send Message',
        'name' => 'Full Name',
        'email' => 'Email Address',
        'subject' => 'Subject',
        'message' => 'Your Message',
        'language_switch' => 'TR',
        'language_link' => '?lang=tr',
        'footer_text' => 'All rights reserved.',
        'contact_us' => 'Contact Us',
        'support_line' => 'Support Line',
        'working_hours' => 'Mon - Sat: 08:00 - 18:00',
        'about_denimsa' => 'About Denimsan',
        'values' => 'Values and Goals',
        'how_we_produce' => 'How We Produce?',
        'certificates' => 'Our Certificates',
        'announcements' => 'Announcements',
        'contact_menu' => 'Contact',
        'vision_mission' => 'Vision & Mission',
        'vision_text' => 'With 20 years of experience in the sector, we have set it as our primary duty and goal to serve as a solution partner to the sector and our valued customers. Denimsan web page will be at your service here soon.',
        'production_title' => 'How We Produce?',
        'production_text' => 'Our premium denim fabrics are carefully produced using sustainable production techniques and innovative weaving machines without compromising quality standards.'
    ]
];

// Helper Function: Tr
// Usage: echo tr('about_us');
function tr($key)
{
    global $dictionary, $current_lang;
    return $dictionary[$current_lang][$key] ?? $key;
}
?>