SET NAMES utf8mb4;
TRUNCATE TABLE collection_categories;

-- Found Categories on Original Site
INSERT INTO collection_categories (title_tr, title_en, description_tr, description_en, cover_image, video_url, is_active, order_num) VALUES
('RIGID', 'RIGID', 'RIGID özelliklerine sahip premium üretim.', 'Premium production with RIGID characteristics.', 'assets/img/collections/premium.png', '#', 1, 1),
('COMFORT', 'COMFORT', 'COMFORT özelliklerine sahip premium üretim.', 'Premium production with COMFORT characteristics.', 'assets/img/collections/premium.png', '#', 1, 2),
('SUPER STRECH', 'SUPER STRECH', 'SUPER STRECH özelliklerine sahip premium üretim.', 'Premium production with SUPER STRECH characteristics.', 'assets/img/collections/premium.png', '#', 1, 3),
('JACQUARED', 'JACQUARED', 'JACQUARED özelliklerine sahip premium üretim.', 'Premium production with JACQUARED characteristics.', 'assets/img/collections/premium.png', '#', 1, 4),
('PFD', 'PFD', 'PFD özelliklerine sahip premium üretim.', 'Premium production with PFD characteristics.', 'assets/img/collections/premium.png', '#', 1, 5),
('DOBBY', 'DOBBY', 'DOBBY özelliklerine sahip premium üretim.', 'Premium production with DOBBY characteristics.', 'assets/img/collections/premium.png', '#', 1, 6),
('5 OZ - 17 OZ', '5 OZ - 17 OZ', '5 OZ - 17 OZ özelliklerine sahip premium üretim.', 'Premium production with 5 OZ - 17 OZ characteristics.', 'assets/img/collections/premium.png', '#', 1, 7),
('ORGANIC', 'ORGANIC', 'ORGANIC özelliklerine sahip premium üretim.', 'Premium production with ORGANIC characteristics.', 'assets/img/collections/premium.png', '#', 1, 8),
('RECYCLED', 'RECYCLED', 'RECYCLED özelliklerine sahip premium üretim.', 'Premium production with RECYCLED characteristics.', 'assets/img/collections/premium.png', '#', 1, 9),
('TENCEL', 'TENCEL', 'TENCEL özelliklerine sahip premium üretim.', 'Premium production with TENCEL characteristics.', 'assets/img/collections/premium.png', '#', 1, 10);

-- Make sure the Hero Video matches the TemperTekstil requirement from the PDF
UPDATE site_settings SET hero_video_url = 'https://www.tempertekstil.com.tr/assets/video/intro.mp4' WHERE id = 1;

-- Set final corporate text for About Us and Contact
UPDATE site_settings SET 
    about_title_tr = 'Hakkımızda', 
    about_title_en = 'About Us', 
    about_text_tr = 'Denimsan, 12 yıl önce İstanbul Merter’de kurulmuş bir denim kumaş ticaret firmasıdır. İç piyasa üreticilerine, ihracatçılara ve kendi markasını üreten firmalara hizmet vermektedir. Geniş ürün çeşitliliği, güçlü stok yapısı ve termin esnekliği ile müşterilerine hızlı ve güvenilir tedarik çözümleri sunar.', 
    about_text_en = 'Denimsan is a denim fabric trading company established 12 years ago in Merter, Istanbul. It serves domestic market manufacturers, exporters, and companies producing their own brands. With its wide product variety, strong stock structure, and lead time flexibility, it offers fast and reliable supply solutions to its customers.',
    contact_phone = '+90 530 774 26 06',
    contact_address = 'Mehmet Nesih Özmen, Kasım Sok. Özmen Mah. Kasım Sok No:5/E, 34173 Güngören/İstanbul, Türkiye'
WHERE id = 1;
