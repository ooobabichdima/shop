-- ==========================================
-- SQL скрипт для ручного виконання міграцій
-- shop.spf.org.ua
-- ==========================================

-- 1. Додати поля для варіацій товарів
-- Міграція: 2024_02_18_000002_create_product_variations_table.php

-- Перевірка і додавання полів до products
ALTER TABLE `products`
ADD COLUMN `color` VARCHAR(100) NULL AFTER `youtube_url`,
ADD COLUMN `parent_variation_id` BIGINT UNSIGNED NULL AFTER `color`,
ADD CONSTRAINT `products_parent_variation_id_foreign`
  FOREIGN KEY (`parent_variation_id`)
  REFERENCES `products` (`id`)
  ON DELETE CASCADE;

-- Створення таблиці product_variations
CREATE TABLE IF NOT EXISTS `product_variations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `product_id` BIGINT UNSIGNED NOT NULL,
  `variation_id` BIGINT UNSIGNED NOT NULL,
  `variation_type` VARCHAR(50) NOT NULL DEFAULT 'color',
  `sort_order` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  UNIQUE KEY `product_variations_product_id_variation_id_unique` (`product_id`, `variation_id`),
  CONSTRAINT `product_variations_product_id_foreign`
    FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_variations_variation_id_foreign`
    FOREIGN KEY (`variation_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2. Додати батьківські категорії
-- Міграція: 2024_02_18_000003_add_parent_id_to_categories.php

ALTER TABLE `categories`
ADD COLUMN `parent_id` BIGINT UNSIGNED NULL AFTER `id`,
ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `is_active`,
ADD CONSTRAINT `categories_parent_id_foreign`
  FOREIGN KEY (`parent_id`)
  REFERENCES `categories` (`id`)
  ON DELETE CASCADE;


-- 3. SEO налаштування
-- Міграція: 2024_02_18_000004_create_seo_pages_table.php

-- Додати SEO поля до категорій
ALTER TABLE `categories`
ADD COLUMN `meta_title` VARCHAR(255) NULL AFTER `description`,
ADD COLUMN `meta_description` TEXT NULL AFTER `meta_title`,
ADD COLUMN `meta_keywords` VARCHAR(255) NULL AFTER `meta_description`;

-- Створити таблицю seo_pages
CREATE TABLE IF NOT EXISTS `seo_pages` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `page_key` VARCHAR(255) NOT NULL UNIQUE,
  `page_name` VARCHAR(255) NOT NULL,
  `meta_title` VARCHAR(255) NULL,
  `meta_description` TEXT NULL,
  `meta_keywords` VARCHAR(255) NULL,
  `og_title` VARCHAR(255) NULL,
  `og_description` TEXT NULL,
  `og_image` VARCHAR(255) NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Вставити дефолтні SEO сторінки
INSERT INTO `seo_pages` (`page_key`, `page_name`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `created_at`, `updated_at`) VALUES
('home', 'Головна сторінка', 'Strikeball Shop — Інтернет-магазин страйкбольного обладнання', 'Купити страйкбольне обладнання в Україні: приводи AEG, магазини, кулі, захист, тактичне спорядження. Великий вибір, вигідні ціни, доставка по Україні.', 'страйкбол, airsoft, привод AEG, магазини страйкбол, кулі airsoft, захист, тактичне спорядження', 1, NOW(), NOW()),
('catalog', 'Каталог товарів', 'Каталог - Strikeball Shop', 'Повний каталог страйкбольного обладнання: приводи, обладнання, аксесуари', 'каталог страйкбол, товари airsoft', 1, NOW(), NOW());


-- 4. Додати записи в таблицю migrations
INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2024_02_18_000002_create_product_variations_table', 3),
('2024_02_18_000003_add_parent_id_to_categories', 3),
('2024_02_18_000004_create_seo_pages_table', 3)
ON DUPLICATE KEY UPDATE migration=migration;

-- Готово!
-- Після виконання цього скрипта сайт повинен запрацювати
