SET NAMES utf8mb4;
TRUNCATE TABLE collection_categories;

INSERT INTO collection_categories (title_tr, title_en, description_tr, description_en, cover_image, is_active, order_num) VALUES
('Power', 'Power', 'Premium Power serisi. İddialı, güçlü ve dayanıklı denim.', 'Premium Power series. Bold, strong and durable denim.', 'assets/img/collections/power.png', 1, 1),
('Comfort', 'Comfort', 'Yüksek esneklik ve form koruma teknolojisi.', 'High flexibility and shape retention technology.', 'assets/img/collections/comfort.png', 1, 2),
('Rigid', 'Rigid', 'Klasik, sert ve otantik ham denim.', 'Classic, stiff and authentic raw denim.', 'assets/img/collections/rigid.png', 1, 3),
('Super Stretch', 'Super Stretch', 'Maksimum konfor için geliştirilmiş esnek formül.', 'Highly elastic formula developed for maximum comfort.', 'assets/img/collections/superstretch.png', 1, 4),
('ACCESS PREMIUM', 'ACCESS PREMIUM', 'En üst düzey lüks denim konseptimiz.', 'Our top tier luxury denim concept.', 'assets/img/collections/premium.png', 1, 5),
('STF', 'STF (Shrink-To-Fit)', 'Orijinal Shrink-To-Fit geleneği.', 'The original Shrink-To-Fit tradition.', 'assets/img/collections/stf.png', 1, 6);
