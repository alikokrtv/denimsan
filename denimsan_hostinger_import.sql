-- Denimsan DB Export from Railway → Hostinger
-- Generated: 2026-03-03 20:05:21

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;

-- Table: admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
('1', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-03-02 18:40:41');

-- Table: collection_categories
DROP TABLE IF EXISTS `collection_categories`;
CREATE TABLE `collection_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_tr` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `description_tr` text,
  `description_en` text,
  `cover_image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `order_num` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `collection_categories` (`id`, `title_tr`, `title_en`, `description_tr`, `description_en`, `cover_image`, `video_url`, `order_num`, `is_active`, `created_at`, `updated_at`) VALUES
('1', 'RIGID', 'RIGID', 'RIGID özelliklerine sahip premium üretim.', 'Premium production with RIGID characteristics.', 'assets/img/collections/rigid.png', NULL, '1', '1', '2026-03-03 16:46:59', '2026-03-03 17:24:46'),
('2', 'COMFORT', 'COMFORT', 'COMFORT özelliklerine sahip premium üretim.', 'Premium production with COMFORT characteristics.', 'assets/img/collections/comfort.png', NULL, '2', '1', '2026-03-03 16:46:59', '2026-03-03 17:24:46'),
('3', 'SUPER STRECH', 'SUPER STRECH', 'SUPER STRECH özelliklerine sahip premium üretim.', 'Premium production with SUPER STRECH characteristics.', 'assets/img/collections/superstrech.png', NULL, '3', '1', '2026-03-03 16:46:59', '2026-03-03 17:24:46'),
('4', 'JACQUARED', 'JACQUARED', 'JACQUARED özelliklerine sahip premium üretim.', 'Premium production with JACQUARED characteristics.', 'assets/img/collections/jacquard.png', NULL, '4', '1', '2026-03-03 16:47:00', '2026-03-03 17:24:46'),
('5', 'PFD', 'PFD', 'PFD özelliklerine sahip premium üretim.', 'Premium production with PFD characteristics.', 'assets/img/collections/pfd.png', NULL, '5', '1', '2026-03-03 16:47:00', '2026-03-03 17:24:47'),
('6', 'DOBBY', 'DOBBY', 'DOBBY özelliklerine sahip premium üretim.', 'Premium production with DOBBY characteristics.', 'assets/img/collections/dobby.png', NULL, '6', '1', '2026-03-03 16:47:00', '2026-03-03 17:24:47'),
('7', '5 OZ - 17 OZ', '5 OZ - 17 OZ', '5 OZ - 17 OZ özelliklerine sahip premium üretim.', 'Premium production with 5 OZ - 17 OZ characteristics.', 'assets/img/collections/weights.png', NULL, '7', '1', '2026-03-03 16:47:00', '2026-03-03 17:24:47'),
('8', 'ORGANIC', 'ORGANIC', 'ORGANIC özelliklerine sahip premium üretim.', 'Premium production with ORGANIC characteristics.', 'assets/img/collections/organic.png', NULL, '8', '1', '2026-03-03 16:47:00', '2026-03-03 17:24:47'),
('9', 'RECYCLED', 'RECYCLED', 'RECYCLED özelliklerine sahip premium üretim.', 'Premium production with RECYCLED characteristics.', 'assets/img/collections/recycled.png', NULL, '9', '1', '2026-03-03 16:47:00', '2026-03-03 17:24:47'),
('10', 'TENCEL', 'TENCEL', 'TENCEL özelliklerine sahip premium üretim.', 'Premium production with TENCEL characteristics.', 'assets/img/collections/tencel.png', NULL, '10', '1', '2026-03-03 16:47:00', '2026-03-03 17:24:47');

-- Table: contact_messages
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Table: site_settings
DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `about_title_tr` varchar(255) DEFAULT NULL,
  `about_title_en` varchar(255) DEFAULT NULL,
  `about_text_tr` text,
  `about_text_en` text,
  `contact_email` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `contact_address` text,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `hero_video_url` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `site_settings` (`id`, `about_title_tr`, `about_title_en`, `about_text_tr`, `about_text_en`, `contact_email`, `contact_phone`, `contact_address`, `linkedin_url`, `hero_video_url`, `updated_at`) VALUES
('1', 'Hakkımızda', 'About Us', 'Denimsan, 2014 yılında İstanbul\'da denim kumaş ticareti alanında faaliyet göstermek üzere kurulmuştur. İç piyasa üreticilerine, ihracatçı firmalara ve kendi markasını geliştiren hazır giyim şirketlerine stratejik tedarik çözümleri sunmaktadır. Geniş ürün çeşitliliği, güçlü stok yapısı ve termin esnekliği ile müşterilerine hızlı ve güvenilir tedarik çözümleri sunar.', 'Denimsan was established in 2014 in Istanbul to operate in the field of denim fabric trade. It provides strategic supply solutions to domestic market manufacturers, exporters, and ready-to-wear companies developing their own brands. With its wide product variety, strong stock structure, and lead time flexibility, it offers fast and reliable supply solutions to its customers.', 'info@denimsan.com.tr', '+90 533 365 17 26', 'Mehmet Nesih Özmen, Kasım Sok. Özmen Mah. Kasım Sok No:5/E, 34173 Güngören/İstanbul, Türkiye', 'https://linkedin.com/company/denimsan', 'https://www.tempertekstil.com.tr/assets/video/intro.mp4', '2026-03-03 18:23:12');

SET FOREIGN_KEY_CHECKS=1;
