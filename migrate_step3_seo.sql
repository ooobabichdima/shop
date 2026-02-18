-- ==========================================
-- КРОК 3: SEO налаштування
-- ==========================================

-- Додати SEO поля до categories
ALTER TABLE `categories`
ADD COLUMN IF NOT EXISTS `meta_title` VARCHAR(255) NULL AFTER `description`;

ALTER TABLE `categories`
ADD COLUMN IF NOT EXISTS `meta_description` TEXT NULL AFTER `meta_title`;

ALTER TABLE `categories`
ADD COLUMN IF NOT EXISTS `meta_keywords` VARCHAR(255) NULL AFTER `meta_description`;

-- Створити таблицю seo_pages
CREATE TABLE IF NOT EXISTS `seo_pages` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `page_key` VARCHAR(255) NOT NULL,
  `page_name` VARCHAR(255) NOT NULL,
  `meta_title` VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `meta_keywords` VARCHAR(255) NULL,
  `og_title` VARCHAR(255) NULL,
  `og_description` TEXT NULL,
  `og_image` VARCHAR(255) NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  UNIQUE KEY `seo_pages_page_key_unique` (`page_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Вставити дефолтні SEO сторінки (IGNORE дубликати)
INSERT IGNORE INTO `seo_pages` (`page_key`, `page_name`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `created_at`, `updated_at`) VALUES
('home', 'Головна сторінка', 'Strikeball Shop — Інтернет-магазин страйкбольного обладнання', 'Купити страйкбольне обладнання в Україні: приводи AEG, магазини, кулі, захист, тактичне спорядження. Великий вибір, вигідні ціни, доставка по Україні.', 'страйкбол, airsoft, привод AEG, магазини страйкбол, кулі airsoft, захист, тактичне спорядження', 1, NOW(), NOW()),
('catalog', 'Каталог товарів', 'Каталог - Strikeball Shop', 'Повний каталог страйкбольного обладнання: приводи, обладнання, аксесуари', 'каталог страйкбол, товари airsoft', 1, NOW(), NOW());

-- Додати в migrations
INSERT IGNORE INTO `migrations` (`migration`, `batch`)
VALUES ('2024_02_18_000004_create_seo_pages_table', 3);

SELECT 'КРОК 3: SEO налаштування - ВИКОНАНО' as Status;

-- Перевірка
SELECT COUNT(*) as 'SEO Pages Count' FROM seo_pages;
SELECT * FROM seo_pages;
