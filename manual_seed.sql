SET NAMES utf8mb4;
TRUNCATE TABLE collection_categories;

-- Found Categories on Original Site
INSERT INTO collection_categories (title_tr, title_en, description_tr, description_en, cover_image, video_url, is_active, order_num) VALUES
('Comfort', 'Comfort (EN)', 'Premium Comfort serisi. Yüksek esneklik ve form koruma teknolojisi.', 'Premium Comfort series. High flexibility and shape retention technology.', 'assets/img/collections/comfort.png', '#', 1, 1),

('Power', 'Power (EN)', 'Premium Power serisi. İddialı, güçlü ve dayanıklı denim.', 'Premium Power series. Bold, strong and durable denim.', 'assets/img/collections/power.png', '#', 1, 2),

('Stay Black', 'Stay Black (EN)', 'Özel Stay Black koleksiyonu. Rengini asla kaybetmeyen kusursuz siyah.', 'Special Stay Black collection. Flawless black that never loses its color.', 'assets/img/collections/stayblack.png', '#', 1, 3),

('Super Stretch', 'Super Stretch (EN)', 'Super Stretch formülü. Maksimum konfor, günlük kullanım.', 'Super Stretch formula. Maximum comfort, daily usage.', 'assets/img/collections/superstretch.png', '#', 1, 4),

('Denimsa Premium', 'Denimsa Premium (EN)', 'En üst düzey kalite. Lüks denim konseptimiz.', 'Top tier quality. Our luxury denim concept.', 'assets/img/collections/premium.png', '#', 1, 5);

-- Make sure the Hero Video matches the TemperTekstil requirement from the PDF
UPDATE site_settings SET hero_video_url = 'https://www.tempertekstil.com.tr/assets/video/intro.mp4' WHERE id = 1;

-- Set final corporate text for About Us and Contact
UPDATE site_settings SET 
    about_title_tr = 'Hakkımızda', 
    about_title_en = 'About Us', 
    about_text_tr = 'Denimsan olarak, 20 yılı aşkın köklü tekstil mirasımızı modern üretim teknolojileriyle harmanlıyoruz. Premium denim kumaş üretiminde, estetik ve dayanıklılığı bir araya getirerek global moda dünyasına yenilikçi dokunuşlar sunmaktan gurur duyuyoruz. Sadece bir kumaş üreticisi değil, kaliteden ödün vermeyen markaların güvenilir çözüm ortağıyız.', 
    about_text_en = 'At Denimsan, we blend over 20 years of deep-rooted textile heritage with modern production technologies. We take pride in offering innovative touches to the global fashion world by combining aesthetics and durability in premium denim fabric manufacturing. More than just a fabric producer, we are the trusted solution partner for brands that refuse to compromise on quality.',
    contact_phone = '+90 530 774 26 06',
    contact_address = 'Mehmet Nesih Özmen, Kasım Sok. Özmen Mah. Kasım Sok No:5/E, 34173 Güngören/İstanbul, Türkiye'
WHERE id = 1;
