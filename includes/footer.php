</div> <!-- End smooth-content -->
</main> <!-- End smooth-wrapper -->

<!-- Footer -->
<footer class="site-footer">
    <div class="container footer-inner">
        <div class="footer-grid">
            <div class="footer-col brand-col">
                <div class="logo footer-logo">denim<strong>san</strong></div>
                <p class="footer-desc">
                    <?php echo tr('footer_text'); ?> &copy;
                    <?php echo date('Y'); ?>
                </p>
                <p style="font-size: 0.8rem; color: #666; margin-top: 15px;">
                    Geliştirici: Ali Kök
                </p>
            </div>

            <div class="footer-col links-col">
                <h4>Menü</h4>
                <a href="#about">
                    <?php echo tr('about_us'); ?>
                </a>
                <a href="#collections">
                    <?php echo tr('collections'); ?>
                </a>
                <a href="#story">
                    <?php echo tr('story_of_denim'); ?>
                </a>
                <a href="#contact"
                    onclick="document.querySelector('input[name=subject]').value='İş Başvurusu / Career Application';">
                    <?php echo tr('career'); ?>
                </a>
            </div>

            <div class="footer-col contact-col">
                <h4>
                    <?php echo tr('contact'); ?>
                </h4>
                <p><i class="ph ph-map-pin"></i>
                    <?php echo nl2br(htmlspecialchars($site_config['contact_address'])); ?>
                </p>
                <p><i class="ph ph-phone"></i> <a
                        href="tel:<?php echo str_replace(' ', '', $site_config['contact_phone']); ?>">
                        <?php echo htmlspecialchars($site_config['contact_phone']); ?>
                    </a></p>
                <p><i class="ph ph-envelope"></i> <a
                        href="mailto:<?php echo htmlspecialchars($site_config['contact_email']); ?>">
                        <?php echo htmlspecialchars($site_config['contact_email']); ?>
                    </a></p>
            </div>

            <div class="footer-col social-col">
                <h4>Sosyal Medya</h4>
                <a href="#" class="social-icon"><i class="ph ph-linkedin-logo"></i> LinkedIn</a>
                <a href="#" class="social-icon"><i class="ph ph-instagram-logo"></i> Instagram</a>
                <a href="#" class="social-icon"><i class="ph ph-facebook-logo"></i> Facebook</a>
            </div>
        </div>
    </div>
</footer>

<!-- Main Custom Javascript -->
<script src="assets/js/main.js"></script>

<!-- Mobile Floating Language Switcher -->
<div class="mobile-floating-lang">
    <a href="?lang=<?php echo $current_lang === 'tr' ? 'en' : 'tr'; ?>">
        <i class="ph ph-globe"></i>
        <span><?php echo $current_lang === 'tr' ? 'EN' : 'TR'; ?></span>
    </a>
</div>

</body>

</html>