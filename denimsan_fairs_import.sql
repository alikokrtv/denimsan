-- Denimsan Fairs Table Export
-- Run this in Hostinger phpMyAdmin SQL tab

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS `fairs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title_tr` VARCHAR(255),
    `title_en` VARCHAR(255),
    `location` VARCHAR(255),
    `fair_date` VARCHAR(100),
    `description_tr` TEXT,
    `description_en` TEXT,
    `cover_image` VARCHAR(500),
    `video_url` VARCHAR(500),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `fairs` (`id`, `title_tr`, `title_en`, `location`, `fair_date`, `description_tr`, `description_en`, `cover_image`) VALUES
(1, 'Munich Fabric Start', 'Munich Fabric Start', 'Münih, Almanya', 'Ocak 2024', 'Premium denim koleksiyonlarımızı sergilediğimiz prestijli fuar.', 'Prestigious fair where we showcase our premium denim collections.'),
(2, 'Premiere Vision Paris', 'Premiere Vision Paris', 'Paris, Fransa', 'Şubat 2024', 'Sürdürülebilir kumaş teknolojilerimizi sunduğumuz global etkinlik.', 'Global event where we present our sustainable fabric technologies.'),
(3, 'Kingpins Show Amsterdam', 'Kingpins Show Amsterdam', 'Amsterdam, Hollanda', 'Nisan 2024', 'Denim dünyasının en yenilikçi buluşma noktası.', 'The most innovative meeting point of the denim world.');

SET FOREIGN_KEY_CHECKS=1;
