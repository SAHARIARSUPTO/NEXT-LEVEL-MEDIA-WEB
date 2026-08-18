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
('hero_video_url', 'https://player.vimeo.com/video/824804225'),
('hero_badge_text', 'Agency Showreel (01:24)')
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
(1, 'shorts', 'Viral Hook Breakdown', 'Fitness Creator', 'https://youtube.com/shorts/LPXvOwKmgF0', 1),
(2, 'shorts', 'SaaS Product Demo Reel', 'SaaS Brand', 'https://youtube.com/shorts/A0K4cyrD48U', 1),
(3, 'shorts', 'Personal Brand Story', 'Agency Founder', 'https://youtube.com/shorts/BSDP0qphx8o', 1),
(4, 'shorts', 'High Retention Pacing', 'YouTube Creator', 'https://youtube.com/shorts/v03bJY39b6U', 1),
(5, 'shorts', 'E-Commerce Spotlight', 'E-Com Brand', 'https://youtube.com/shorts/kRtHRAsHKk8', 1),
(6, 'shorts', 'Conversion Focused Cut', 'Growth Brand', 'https://youtube.com/shorts/3gDusm-pYr4', 1),
(7, 'youtube', 'Full Production Showcase 01', 'Creator Channel', 'https://www.youtube.com/watch?v=_VZpzlfgMog', 1),
(8, 'youtube', 'Full Production Showcase 02', 'Tech Channel', 'https://www.youtube.com/watch?v=vVjQcWh7pVI', 1),
(9, 'youtube', 'Full Production Showcase 03', 'Documentary', 'https://www.youtube.com/watch?v=ZdaiBOEJhTY', 1),
(10, 'youtube', 'Full Production Showcase 04', 'Creator Studio', 'https://www.youtube.com/watch?v=mF2so1ihSQ4', 1),
(11, 'youtube', 'Full Production Showcase 05', 'Podcast Cut', 'https://www.youtube.com/watch?v=WyWPeGKKVIE', 1),
(12, 'vsl', 'Direct Response Performance Ad 01', 'Direct Response', 'https://www.youtube.com/watch?v=s7p6OLwV_50', 1),
(13, 'vsl', 'Direct Response Performance Ad 02', 'App Growth', 'https://youtu.be/WMxo_4q0MNg', 1),
(14, 'vsl', 'Direct Response Performance Ad 03', 'E-Com Ad', 'https://youtu.be/AlsXNhTm4AA', 1),
(15, 'motion_3d', '3D Product Animation Showcase', '3D Studio', 'https://nextlevelmediadigital.com/components/videos/3d.mp4', 1),
(16, 'reviews', 'Client Story - Mike Over Case Study', 'Mike Over', 'https://nextlevelmediadigital.com/components/videos/review.mp4', 1)
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`);
