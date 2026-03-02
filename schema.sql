-- DENIMSAN Database Schema

CREATE DATABASE IF NOT EXISTS denimsan_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE denimsan_db;

-- Admins Table
CREATE TABLE IF NOT EXISTS `admins` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default Admin: admin / admin123 (Please change in production)
INSERT IGNORE INTO `admins` (`username`, `password`) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Collection Categories
CREATE TABLE IF NOT EXISTS `collection_categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title_tr` VARCHAR(255) NOT NULL,
  `title_en` VARCHAR(255) NOT NULL,
  `description_tr` TEXT,
  `description_en` TEXT,
  `cover_image` VARCHAR(255),
  `video_url` VARCHAR(255) DEFAULT NULL,
  `order_num` INT DEFAULT 0,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Site Settings (Single Row Pattern)
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `about_title_tr` VARCHAR(255),
  `about_title_en` VARCHAR(255),
  `about_text_tr` TEXT,
  `about_text_en` TEXT,
  `contact_email` VARCHAR(100),
  `contact_phone` VARCHAR(50),
  `contact_address` TEXT,
  `linkedin_url` VARCHAR(255),
  `hero_video_url` VARCHAR(255),
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT IGNORE INTO `site_settings` (`id`, `about_title_tr`, `about_title_en`, `about_text_tr`, `about_text_en`, `contact_email`, `contact_phone`, `contact_address`, `linkedin_url`) 
VALUES (1, 'Hakkımızda', 'About Us', 'DENIMSAN hakkında varsayılan metin...', 'Default text about DENIMSAN...', 'info@denimsan.com.tr', '+90 555 555 55 55', 'İstanbul, Türkiye', 'https://linkedin.com/company/denimsan');

-- Contact Messages
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `subject` VARCHAR(255),
  `message` TEXT NOT NULL,
  `is_read` BOOLEAN DEFAULT FALSE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
