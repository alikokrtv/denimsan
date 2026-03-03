<?php
session_start();
require_once 'config/db.php';
require_once 'includes/functions.php';

$current_lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'tr';
$_SESSION['lang'] = $current_lang;

$fairs = $pdo->query("SELECT * FROM fairs ORDER BY fair_date DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo tr('fairs'); ?> | DENIMSAN
    </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="section-padding" style="min-height: 100vh; padding-top: 160px;">
            <div class="container">
                <h2 class="text-uppercase fade-up" style="margin-bottom: 10px;">
                    <?php echo tr('fairs'); ?>
                </h2>
                <p class="fade-up" style="margin-bottom: 60px; max-width: none;">
                    <?php echo $current_lang === 'tr' ? 'Katıldığımız uluslararası fuarlar ve etkinlikler.' : 'International fairs and events we attended.'; ?>
                </p>

                <?php if (empty($fairs)): ?>
                    <p style="opacity: 0.5; text-align: center; margin-top: 80px;">
                        <?php echo $current_lang === 'tr' ? 'Yakında eklenecek.' : 'Coming soon.'; ?>
                    </p>
                <?php else: ?>
                    <div class="fairs-grid">
                        <?php foreach ($fairs as $fair):
                            $title = $current_lang === 'tr' ? $fair['title_tr'] : $fair['title_en'];
                            $desc = $current_lang === 'tr' ? $fair['description_tr'] : $fair['description_en'];
                            $img = !empty($fair['cover_image']) ? htmlspecialchars($fair['cover_image']) : 'assets/img/story_bg.png';
                            ?>
                            <div class="fair-card fade-up">
                                <div class="fair-img-wrap">
                                    <?php if (!empty($fair['video_url'])): ?>
                                        <video src="<?php echo htmlspecialchars($fair['video_url']); ?>" autoplay muted loop
                                            playsinline class="fair-media"></video>
                                    <?php else: ?>
                                        <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($title); ?>"
                                            class="fair-media">
                                    <?php endif; ?>
                                </div>
                                <div class="fair-info">
                                    <div class="fair-meta">
                                        <span class="fair-location"><i class="ph ph-map-pin"></i>
                                            <?php echo htmlspecialchars($fair['location']); ?>
                                        </span>
                                        <span class="fair-date">
                                            <?php echo htmlspecialchars($fair['fair_date']); ?>
                                        </span>
                                    </div>
                                    <h3>
                                        <?php echo htmlspecialchars($title); ?>
                                    </h3>
                                    <p>
                                        <?php echo htmlspecialchars($desc); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <style>
        .fairs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
        }

        .fair-card {
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 6px;
            overflow: hidden;
            transition: border-color 0.3s;
        }

        .fair-card:hover {
            border-color: rgba(212, 175, 55, 0.4);
        }

        .fair-img-wrap {
            aspect-ratio: 16/9;
            overflow: hidden;
        }

        .fair-media {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .fair-info {
            padding: 24px;
        }

        .fair-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 0.78rem;
            color: #888;
        }

        .fair-meta i {
            margin-right: 4px;
        }

        .fair-info h3 {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 10px;
            color: #fff;
        }

        .fair-info p {
            font-size: 0.88rem;
            color: #aaa;
            max-width: 100%;
            margin: 0;
        }

        @media (max-width: 768px) {
            .fairs-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>