<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DENIMSAN - Premium Denim & Textile Manufacturer</title>
    <meta name="description"
        content="Denimsan; sahip olduğu bilgi, tecrübe ve birikimlerini siz değerli müşterileri ile paylaşmanın heyecanını ve mutluluğunu duyar.">
    <meta name="keywords"
        content="denimsan, denımsan, DENİMSAN, DENIMSAN, denim, denimkumaş, denimkumas, kotkumaşı, kotkumasi, kot, denim kumaş">
    <!-- Fonts: Avenir Next representation using Montserrat for now unless provided -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <!-- Simple Icons (Phosphor or FontAwesome alternative) -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-logo">denim<strong>san</strong></div>
    </div>

    <!-- Header -->
    <header class="site-header">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container top-bar-inner">
                <div class="top-bar-left">
                    <a href="mailto:<?php echo htmlspecialchars($site_config['contact_email']); ?>"
                        class="top-link"><?php echo tr('contact_us'); ?></a>
                    <span class="separator">|</span>
                    <a href="tel:<?php echo htmlspecialchars($site_config['contact_phone']); ?>"
                        class="top-link"><?php echo tr('support_line'); ?></a>
                </div>
                <div class="top-bar-right">
                    <span class="top-text"><?php echo tr('working_hours'); ?></span>
                    <span class="separator">|</span>
                    <div class="top-socials">
                        <a href="#"><i class="ph ph-facebook-logo"></i></a>
                        <a href="#"><i class="ph ph-instagram-logo"></i></a>
                        <a href="#"><i class="ph ph-youtube-logo"></i></a>
                    </div>
                    <span class="separator">|</span>
                    <!-- Language Switcher -->
                    <a href="?lang=<?php echo $current_lang === 'tr' ? 'en' : 'tr'; ?>" class="lang-switch-top">
                        <?php echo $current_lang === 'tr' ? 'English' : 'Türkçe'; ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <div class="container header-inner">
            <nav class="desktop-nav left-nav">
                <div class="nav-item has-dropdown">
                    <a href="#collections" class="nav-link"><?php echo tr('collections'); ?> <i
                            class="ph ph-caret-down"></i></a>
                    <div class="dropdown-menu">
                        <?php
                        $stmt = $pdo->query("SELECT * FROM collection_categories ORDER BY order_num ASC");
                        while ($cat = $stmt->fetch()) {
                            $title = $current_lang === 'tr' ? $cat['title_tr'] : $cat['title_en'];
                            echo '<a href="#collections" class="dropdown-link">' . htmlspecialchars($title) . '</a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#gallery" class="nav-link"><?php echo tr('gallery'); ?> <i
                            class="ph ph-caret-down"></i></a>
                </div>
            </nav>

            <a href="index.php" class="logo">
                <span class="logo-main">denim<strong>san</strong></span>
            </a>

            <nav class="desktop-nav right-nav">
                <div class="nav-item has-dropdown">
                    <a href="#about" class="nav-link"><?php echo tr('corporate'); ?> <i
                            class="ph ph-caret-down"></i></a>
                    <div class="dropdown-menu">
                        <a href="#about" class="dropdown-link"><?php echo tr('about_denimsa'); ?></a>
                        <a href="#about" class="dropdown-link"><?php echo tr('values'); ?></a>
                        <a href="#about" class="dropdown-link"><?php echo tr('how_we_produce'); ?></a>
                        <a href="#about" class="dropdown-link"><?php echo tr('certificates'); ?></a>
                        <a href="#about" class="dropdown-link"><?php echo tr('announcements'); ?></a>
                    </div>
                </div>
                <div class="nav-item has-dropdown">
                    <a href="#contact" class="nav-link"><?php echo tr('contact_menu'); ?> <i
                            class="ph ph-caret-down"></i></a>
                    <div class="dropdown-menu">
                        <a href="#contact" class="dropdown-link"><?php echo tr('contact_us'); ?></a>
                        <a href="#contact" class="dropdown-link"><?php echo tr('support_line'); ?></a>
                    </div>
                </div>
            </nav>

            <!-- Mobile Menu Toggle -->
            <button class="menu-toggle" aria-label="Toggle Menu">
                <i class="ph ph-list"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Navigation Overlay -->
    <div class="mobile-nav">
        <button class="menu-close"><i class="ph ph-x"></i></button>
        <div class="mobile-nav-links">
            <a href="#about" class="nav-link">
                <?php echo tr('about_us'); ?>
            </a>
            <a href="#collections" class="nav-link">
                <?php echo tr('collections'); ?>
            </a>
            <a href="#story" class="nav-link">
                <?php echo tr('story_of_denim'); ?>
            </a>
            <a href="#contact"
                onclick="document.querySelector('.menu-close').click(); document.querySelector('input[name=subject]').value='İş Başvurusu / Career Application';"
                class="nav-link">
                <?php echo tr('career'); ?>
            </a>
            <a href="#contact" class="nav-link">
                <?php echo tr('contact'); ?>
            </a>
            <a href="?lang=<?php echo $current_lang === 'tr' ? 'en' : 'tr'; ?>" class="nav-link lang-switch-mobile">
                <?php echo $current_lang === 'tr' ? 'Switch to English' : 'Türkçe\'ye Geç'; ?>
            </a>
        </div>
    </div>

    <main id="smooth-wrapper">
        <div id="smooth-content">