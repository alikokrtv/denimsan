<?php
require_once 'includes/header.php';

// Fetch Categories for the Grid
$categories = $pdo->query("SELECT * FROM collection_categories WHERE is_active = 1 ORDER BY order_num ASC")->fetchAll();

// Handle Contact Form Submission via AJAX/POST
$contact_msg = '';
$contact_status = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $email, $subject, $message])) {
            $contact_msg = $current_lang === 'tr' ? 'Mesajınız başarıyla gönderildi. Teşekkür ederiz.' : 'Your message has been sent successfully. Thank you.';
            $contact_status = 'success';
        } else {
            $contact_msg = $current_lang === 'tr' ? 'Bir hata oluştu, lütfen daha sonra tekrar deneyin.' : 'An error occurred, please try again later.';
            $contact_status = 'error';
        }
    }
}
?>

<!-- ======================= HERO ======================= -->
<section class="hero" id="home">
    <div class="hero-slider">
        <div class="slide active">
            <img class="hero-media-bg" src="assets/img/hero/hero_slide_0.png" alt="Denim Manufacturing Facility">
            <div class="hero-overlay"></div>
        </div>

        <div class="slide">
            <img class="hero-media-bg" src="assets/img/hero/hero_slide_1.png" alt="Premium Indigo Threads">
            <div class="hero-overlay"></div>
        </div>

        <div class="slide">
            <img class="hero-media-bg" src="assets/img/hero/hero_slide_2.png" alt="Premium Raw Denim Fabric">
            <div class="hero-overlay"></div>
        </div>
    </div>

    <div class="hero-content">
        <span class="hero-subtitle fade-up">Premium Denim</span>
        <h1 class="fade-up" style="letter-spacing: 5px; font-weight: 400;">DENIM<strong>SAN</strong></h1>
        <div class="fade-up" style="margin-top:40px;">
            <a href="#about" class="btn">
                <?php echo tr('discover'); ?>
            </a>
        </div>
    </div>
</section>

<!-- ======================= ABOUT US ======================= -->
<section class="section-padding about-section" id="about">
    <div class="container">
        <h2 class="text-uppercase fade-up"
            style="margin-bottom: 40px; color:#fff; font-size: 1.5rem; letter-spacing: 5px;">
            <?php echo htmlspecialchars($site_config['about_title']); ?>
        </h2>
        <div class="about-text fade-up">
            <?php echo nl2br(htmlspecialchars($site_config['about_text'])); ?>
        </div>
    </div>
</section>

<!-- ======================= COLLECTIONS / CATEGORIES ======================= -->
<section class="section-padding collections-section" id="collections">
    <div class="container">
        <h2 class="text-center text-uppercase fade-up" style="margin-bottom: 20px;">
            <?php echo tr('collections'); ?>
        </h2>
        <p class="text-center fade-up">Yüksek Kaliteli Üretim & Entegre Teknolojiler</p>

        <div class="categories-grid">
            <?php foreach ($categories as $cat): ?>
                <?php $catTitle = $current_lang === 'tr' ? $cat['title_tr'] : $cat['title_en']; ?>
                <?php $catDesc = $current_lang === 'tr' ? $cat['description_tr'] : $cat['description_en']; ?>
                <?php
                // Fallback image if cover is empty
                $imgSrc = !empty($cat['cover_image']) ? $cat['cover_image'] : 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80';
                ?>

                <div class="category-card">
                    <div class="category-img-wrap">
                        <img src="<?php echo htmlspecialchars($imgSrc); ?>" alt="<?php echo htmlspecialchars($catTitle); ?>"
                            class="category-img">
                    </div>
                    <div class="category-info">
                        <h3 class="category-title text-uppercase"><?php echo htmlspecialchars($catTitle); ?></h3>
                        <?php if (!empty($catDesc)): ?>
                            <p class="category-desc-text"><?php echo htmlspecialchars($catDesc); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ======================= STORY OF DENIM / VIDEO ======================= -->
<section class="story-section" id="story">
    <div class="container fade-up">
        <h2 class="text-uppercase" style="margin-bottom: 30px;">
            <?php echo tr('story_of_denim'); ?>
        </h2>

        <!-- Cinematic Image Wrapper (Replacing YouTube) -->
        <div class="video-wrapper cinematic-wrapper"
            style="position: relative; overflow: hidden; border-radius: 8px; cursor: pointer; aspect-ratio: 16/9; background:#000;">

            <div class="cinematic-slides" style="width: 100%; height: 100%; position: absolute; top:0; left:0;">
                <img src="assets/img/story_bg.png" alt="Story of Denimsan 1" class="story-cinematic-img active"
                    style="width: 100%; height: 100%; object-fit: cover; position: absolute; top:0; left:0; filter: brightness(0.7); opacity: 1; transition: opacity 1.5s ease, transform 6s linear; transform: scale(1.05);">
                <img src="assets/img/story_bg_1.png" alt="Story of Denimsan 2" class="story-cinematic-img"
                    style="width: 100%; height: 100%; object-fit: cover; position: absolute; top:0; left:0; filter: brightness(0.7); opacity: 0; transition: opacity 1.5s ease, transform 6s linear; transform: scale(1);">
                <img src="assets/img/story_bg_2.png" alt="Story of Denimsan 3" class="story-cinematic-img"
                    style="width: 100%; height: 100%; object-fit: cover; position: absolute; top:0; left:0; filter: brightness(0.7); opacity: 0; transition: opacity 1.5s ease, transform 6s linear; transform: scale(1);">
            </div>

            <!-- Dynamic Text Overlays -->
            <div class="cinematic-texts"
                style="position: absolute; bottom: 10%; left: 0; width: 100%; text-align: center; z-index: 15; pointer-events: none;">
                <div class="story-text-slide"
                    style="opacity: 1; transition: opacity 1s ease; position: absolute; width: 100%; bottom: 0;">
                    <h3
                        style="color: #fff; font-size: 2rem; font-weight: 300; letter-spacing: 2px; text-transform: uppercase; text-shadow: 0 4px 15px rgba(0,0,0,0.8); margin: 0;">
                        <?php echo $current_lang === 'tr' ? '1984\'ten Gelen Gelenek' : 'Tradition Since 1984'; ?>
                    </h3>
                </div>
                <div class="story-text-slide"
                    style="opacity: 0; transition: opacity 1s ease; position: absolute; width: 100%; bottom: 0;">
                    <h3
                        style="color: #fff; font-size: 2rem; font-weight: 300; letter-spacing: 2px; text-transform: uppercase; text-shadow: 0 4px 15px rgba(0,0,0,0.8); margin: 0;">
                        <?php echo $current_lang === 'tr' ? 'Sürdürülebilir Süreçler' : 'Sustainable Processes'; ?>
                    </h3>
                </div>
                <div class="story-text-slide"
                    style="opacity: 0; transition: opacity 1s ease; position: absolute; width: 100%; bottom: 0;">
                    <h3
                        style="color: #fff; font-size: 2rem; font-weight: 300; letter-spacing: 2px; text-transform: uppercase; text-shadow: 0 4px 15px rgba(0,0,0,0.8); margin: 0;">
                        <?php echo $current_lang === 'tr' ? 'Gerçek Lüks İşçilik' : 'True Luxury Craftsmanship'; ?>
                    </h3>
                </div>
            </div>
        </div>

        <!-- Extra Text Below the Video/Cinematic Image -->
        <div class="story-text-content fade-up"
            style="margin-top: 40px; text-align: center; max-width: 800px; margin-left: auto; margin-right: auto;">
            <p style="color: #ccc; line-height: 1.8; font-size: 1rem; font-weight: 300;">
                <?php echo $current_lang === 'tr'
                    ? 'Denim, 19. yüzyılda dayanıklı çalışma kıyafeti olarak doğdu. Birbirine geçen atkı ve çözgü ipliklerinin oluşturduğu twill dokuma, ham indigo mavisi ve sağlamlığıyla efsane oldu. Bugün Denimsan olarak bu köklü gelenekten ilham alıyor; rigid yapıdan dört yönlü stretch\'e, geri dönüştürülmüş iplikten tensel karışımlara kadar her kumaşı bir zanaat eseri anlayışıyla işliyoruz.'
                    : 'Denim was born as rugged workwear in the 19th century — a twill weave celebrated for its raw indigo depth and durability. Today at Denimsan, we draw from that heritage: from rigid structures to four-way stretch, from recycled yarns to tencel blends, every fabric is treated as a work of craft.';
                ?>
            </p>
        </div>

        <!-- Corporate Info Wrapper -->
        <div class="corporate-info fade-up"
            style="margin-top: 60px; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; text-align: left;">
            <!-- Vision & Mission -->
            <div class="info-card hover-glow"
                style="background: rgba(15,15,15,0.6); padding: 40px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); transition: all 0.3s ease;">
                <h3
                    style="color: #d4af37; margin-bottom: 20px; font-weight: 300; letter-spacing: 1px; display: flex; align-items: center; gap: 10px;">
                    <i class="ph ph-target" style="font-size: 1.5rem;"></i> <?php echo tr('vision_mission'); ?>
                </h3>
                <p style="color: #ccc; line-height: 1.8; font-size: 0.95rem;">
                    <?php echo tr('vision_text'); ?>
                </p>
            </div>

            <!-- Production -->
            <div class="info-card hover-glow"
                style="background: rgba(15,15,15,0.6); padding: 40px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.05); transition: all 0.3s ease;">
                <h3
                    style="color: #d4af37; margin-bottom: 20px; font-weight: 300; letter-spacing: 1px; display: flex; align-items: center; gap: 10px;">
                    <i class="ph ph-factory" style="font-size: 1.5rem;"></i> <?php echo tr('production_title'); ?>
                </h3>
                <p style="color: #ccc; line-height: 1.8; font-size: 0.95rem;">
                    <?php echo tr('production_text'); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ======================= CONTACT & SHOWROOM ======================= -->
<section class="section-padding contact-section" id="contact">
    <div class="container fade-up">
        <div class="contact-grid">

            <div class="contact-info">
                <h2 class="text-uppercase">
                    <?php echo tr('contact'); ?>
                </h2>
                <div style="margin-top:40px; display:flex; flex-direction:column; gap:20px;">
                    <div>
                        <strong
                            style="color:var(--accent); text-transform:uppercase; letter-spacing:1px; display:block; margin-bottom:5px;">Adres
                            / Address</strong>
                        <p style="color:#fff; margin:0;">
                            <?php echo nl2br(htmlspecialchars($site_config['contact_address'])); ?>
                        </p>
                    </div>
                    <div>
                        <strong
                            style="color:var(--accent); text-transform:uppercase; letter-spacing:1px; display:block; margin-bottom:5px;">E-Posta
                            / Email</strong>
                        <a href="mailto:<?php echo htmlspecialchars($site_config['contact_email']); ?>"
                            style="color:#fff; text-decoration:none;">
                            <?php echo htmlspecialchars($site_config['contact_email']); ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrapper">
                <?php if ($contact_msg):
                    ; ?>
                    <div
                        style="padding:15px; margin-bottom:20px; border-radius:4px; color:white; background: <?php echo $contact_status === 'success' ? '#28a745' : '#dc3545'; ?>;">
                        <?php echo $contact_msg; ?>
                    </div>
                <?php endif;
                ; ?>
                <form class="contact-form" method="POST" action="#contact">
                    <input type="hidden" name="contact_submit" value="1">
                    <input type="text" name="name" class="form-input" placeholder="<?php echo tr('name'); ?>" required>
                    <input type="email" name="email" class="form-input" placeholder="<?php echo tr('email'); ?>"
                        required>
                    <input type="text" name="subject" class="form-input" placeholder="<?php echo tr('subject'); ?>">
                    <textarea name="message" class="form-textarea" placeholder="<?php echo tr('message'); ?>"
                        required></textarea>
                    <button type="submit" class="btn" style="color:white; border-color:white;">
                        <?php echo tr('send_message'); ?>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
; ?>