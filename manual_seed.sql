SET NAMES utf8mb4;
TRUNCATE TABLE collection_categories;

-- Found Categories on Original Site
INSERT INTO collection_categories (title_tr, title_en, description_tr, description_en, cover_image, video_url, is_active, order_num) VALUES
('Comfort', 'Comfort (EN)', 'Premium Comfort serisi. Yüksek esneklik ve form koruma teknolojisi.', 'Premium Comfort series. High flexibility and shape retention technology.', 'https://www.denimsa.com.tr/kaynak/icerik/3edebdb2-4fc0-a5d4-03973e750935.jpeg', 'https://www.denimsa.com.tr/koleksiyon/liste?kats=2&kategori=Comfort', 1, 1),

('Power', 'Power (EN)', 'Premium Power serisi. İddialı, güçlü ve dayanıklı denim.', 'Premium Power series. Bold, strong and durable denim.', 'https://www.denimsa.com.tr/kaynak/icerik/e4fb2d75-472d-8b06-5b4d9ef2676b.jpeg', 'https://www.denimsa.com.tr/koleksiyon/liste?kats=1&kategori=Power', 1, 2),

('Stay Black', 'Stay Black (EN)', 'Özel Stay Black koleksiyonu. Rengini asla kaybetmeyen kusursuz siyah.', 'Special Stay Black collection. Flawless black that never loses its color.', 'https://www.denimsa.com.tr/kaynak/icerik/0feff5f0-61ba-7b79-522be723467f.jpeg', 'https://www.denimsa.com.tr/koleksiyon/liste?kats=5&kategori=Stay%20Black', 1, 3),

('Super Stretch', 'Super Stretch (EN)', 'Super Stretch formülü. Maksimum konfor, günlük kullanım.', 'Super Stretch formula. Maximum comfort, daily usage.', 'https://www.denimsa.com.tr/kaynak/icerik/e078ecb3-6c7c-471a-fae1227090b8.jpeg', 'https://www.denimsa.com.tr/koleksiyon/liste?kats=3&kategori=Super%20Stretch', 1, 4),

('Denimsa Premium', 'Denimsa Premium (EN)', 'En üst düzey kalite. Lüks denim konseptimiz.', 'Top tier quality. Our luxury denim concept.', 'https://www.denimsa.com.tr/kaynak/icerik/1392b450-4107-16d1-419b4babbbc9.webp', 'https://www.denimsa.com.tr/koleksiyon/liste?kats=6&kategori=Denimsa%20Premium', 1, 5);

-- Make sure the Hero Video matches the TemperTekstil requirement from the PDF
UPDATE site_settings SET hero_video_url = 'https://www.tempertekstil.com.tr/assets/video/intro.mp4' WHERE id = 1;
