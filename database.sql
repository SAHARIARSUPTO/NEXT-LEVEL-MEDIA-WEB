-- Next Level Media Database Schema
-- Database: next_level_media_db

CREATE DATABASE IF NOT EXISTS `next_level_media_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `next_level_media_db`;

-- 1. Admin Users Table
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default Admin User (username: admin | password: admin123)
INSERT INTO `admin_users` (`id`, `username`, `password_hash`, `email`) 
VALUES (1, 'admin', '$2y$10$kxRvxSpNuktTkAH9wOq8zOE4EDnZlgEDUjcWZRVuYePMJLp4sMKL.', 'admin@nextlevelmediadigital.com')
ON DUPLICATE KEY UPDATE `password_hash` = VALUES(`password_hash`), `username` = VALUES(`username`);

-- 2. Site Settings Table
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `setting_key` VARCHAR(100) NOT NULL UNIQUE,
  `setting_value` LONGTEXT DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default Site Settings
INSERT INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('meta_title', 'Next Level Media | High-Performance Video Production & Creative Systems'),
('meta_description', 'Next Level Media crafts high-retention video content, YouTube edits, viral shorts, VSLs, and 3D motion assets that convert. Trusted by 500+ creators & brands.'),
('meta_keywords', 'Next Level Media, video editing agency, SaaS product videos, viral shorts, YouTube video editor, VSL, motion graphics, 3D animation'),
('og_image', 'main-logo.png'),
('contact_email', 'contact@nextlevelmediadigital.com'),
('contact_phone', '+880 1753-506047'),
('booking_calendly_url', 'https://calendly.com/nextlevelmediacall/30min?month=2025-07'),
('hero_video_url', 'https://player.vimeo.com/video/1219066986?autoplay=1&title=0&byline=0&portrait=0&badge=0'),
('hero_badge_text', 'Agency Showreel')
ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`);

-- 3. Client Orders Table
CREATE TABLE IF NOT EXISTS `client_orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `client_name` VARCHAR(255) NOT NULL,
  `client_email` VARCHAR(255) NOT NULL,
  `contact_number` VARCHAR(100) DEFAULT NULL,
  `company_name` VARCHAR(255) DEFAULT NULL,
  `service_types` TEXT DEFAULT NULL,
  `budget_range` VARCHAR(100) DEFAULT NULL,
  `deadline` VARCHAR(100) DEFAULT NULL,
  `delivery_date` VARCHAR(100) DEFAULT NULL,
  `project_description` LONGTEXT DEFAULT NULL,
  `reference_links` TEXT DEFAULT NULL,
  `status` VARCHAR(50) DEFAULT 'Pending',
  `order_amount` DECIMAL(10,2) DEFAULT 0.00,
  `paid_amount` DECIMAL(10,2) DEFAULT 0.00,
  `payment_status` VARCHAR(50) DEFAULT 'Unpaid',
  `client_address` VARCHAR(255) DEFAULT NULL,
  `invoice_notes` TEXT DEFAULT NULL,
  `admin_notes` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Financial Records Table (Income & Expenses Tracker)
CREATE TABLE IF NOT EXISTS `financial_records` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `type` ENUM('income', 'expense') NOT NULL,
  `order_id` INT DEFAULT NULL,
  `category` VARCHAR(100) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `payment_method` VARCHAR(100) DEFAULT 'Bank Transfer',
  `transaction_date` DATE NOT NULL,
  `notes` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Contact Inquiries Table
CREATE TABLE IF NOT EXISTS `contact_inquiries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(100) DEFAULT NULL,
  `subject` VARCHAR(255) DEFAULT NULL,
  `message` LONGTEXT NOT NULL,
  `status` VARCHAR(50) DEFAULT 'Unread',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Visitor Analytics Table
CREATE TABLE IF NOT EXISTS `visitor_analytics` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `ip_address` VARCHAR(100) NOT NULL,
  `country_code` VARCHAR(50) DEFAULT NULL,
  `country_name` VARCHAR(100) DEFAULT NULL,
  `city` VARCHAR(100) DEFAULT NULL,
  `page_visited` VARCHAR(255) NOT NULL,
  `device_type` VARCHAR(50) DEFAULT NULL,
  `browser` VARCHAR(50) DEFAULT NULL,
  `referrer` VARCHAR(255) DEFAULT NULL,
  `visitor_email` VARCHAR(255) DEFAULT NULL,
  `visited_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_ip_page_time` (`ip_address`, `page_visited`, `visited_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Section Videos Table
CREATE TABLE IF NOT EXISTS `section_videos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `section` VARCHAR(50) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `client_name` VARCHAR(255) DEFAULT NULL,
  `video_url` VARCHAR(500) NOT NULL,
  `is_active` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Initial Section Videos
INSERT INTO `section_videos` (`id`, `section`, `title`, `client_name`, `video_url`, `is_active`) VALUES
(1, 'shorts', 'Viral Hook Breakdown', 'Fitness Creator', 'https://vimeo.com/1219657057', 1),
(2, 'shorts', 'SaaS Product Demo Reel', 'SaaS Brand', 'https://vimeo.com/1219657058', 1),
(3, 'shorts', 'Personal Brand Story', 'Agency Founder', 'https://vimeo.com/1219657056', 1),
(4, 'shorts', 'High Retention Pacing', 'YouTube Creator', 'https://vimeo.com/1219657047', 1),
(5, 'shorts', 'E-Commerce Spotlight', 'E-Com Brand', 'https://vimeo.com/1219578174', 1),
(6, 'shorts', 'Conversion Focused Cut', 'Growth Brand', 'https://vimeo.com/1219577544', 1),
(7, 'youtube', 'High-Retention YouTube Masterclass', 'YouTube Creator', 'https://vimeo.com/1219614785', 1),
(8, 'youtube', 'Authority Documentary Production', 'Creator Studio', 'https://vimeo.com/1219614782', 1),
(9, 'youtube', 'Viral Long-Form Breakdown', 'Growth Channel', 'https://vimeo.com/1219353241', 1),
(10, 'youtube', 'Founder Storytelling & Case Study', 'SaaS Brand', 'https://vimeo.com/1219614784', 1),
(11, 'youtube', 'Cinematic Video Essay Cut', 'Media Channel', 'https://vimeo.com/1219353240', 1),
(12, 'youtube', 'Studio Deep Dive & Visual Essay', 'Podcast & Show', 'https://vimeo.com/1219353239', 1),
(13, 'vsl', 'Direct Response Performance VSL 01', 'Direct Response', 'https://vimeo.com/1219660179?fl=ip&fe=ec', 1),
(14, 'vsl', 'Direct Response Performance VSL 02', 'App Growth', 'https://vimeo.com/1219668107?fl=ip&fe=ec', 1),
(15, 'vsl', 'Direct Response Performance VSL 03', 'Scale Brand', 'https://vimeo.com/1219664254?fl=ip&fe=ec', 1),
(16, 'vsl', 'Direct Response Performance VSL 04', 'Growth Agency', 'https://vimeo.com/1219669663?fl=ip&fe=ec', 1),
(17, 'vsl', 'Direct Response Performance VSL 05', 'Performance Marketing', 'https://vimeo.com/1219663527?fl=ip&fe=ec', 1),
(18, 'vsl', 'Direct Response Performance VSL 06', 'E-Com Brand', 'https://vimeo.com/1219614073?fl=ip&fe=ec', 1),
(19, 'podcast', 'Studio Podcast Production 01', 'Podcast & Show', 'https://youtu.be/H8f7pukBu2k?si=7NP1TL9ZPhQk-lZ8', 1),
(20, 'podcast', 'Studio Podcast Production 02', 'Founder Interview', 'https://youtu.be/JtZYHd3txEc?si=bnAVHchqkb7s9OHn', 1),
(21, 'podcast', 'Studio Podcast Production 03', 'Creator Studio', 'https://youtu.be/14ahDH7Ud74?si=sLnyg45M9Zk63ET0', 1),
(22, 'podcast', 'Studio Podcast Production 04', 'Industry Insights', 'https://youtu.be/xHB5zFYb0M4?si=osxMCVbuTbGmv2w3', 1),
(23, 'podcast', 'Studio Podcast Production 05', 'Tech & Growth', 'https://youtu.be/sE3OsRi9LWk?si=qZyVzZNHIZP-7Dwi', 1),
(24, 'motion_3d', '3D Product Animation Showcase', '3D Studio', 'https://nextlevelmediadigital.com/components/videos/3d.mp4', 1),
(25, 'reviews', 'Client Story - Mike Over Case Study', 'Mike Over', 'https://nextlevelmediadigital.com/components/videos/review.mp4', 1)
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `video_url` = VALUES(`video_url`), `section` = VALUES(`section`);
