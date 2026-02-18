-- ==========================================
-- ПОВНА міграція для старого бекапу
-- Додає ВСІ відсутні поля до products
-- ==========================================

SET FOREIGN_KEY_CHECKS = 0;

-- Показати поточну структуру products
SELECT 'Поточна структура products:' AS '';
DESCRIBE products;

-- ==========================================
-- PRODUCTS: Додати specs (JSON) - якщо немає
-- ==========================================

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'products'
    AND COLUMN_NAME = 'specs'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `products` ADD COLUMN `specs` JSON NULL AFTER `stock`',
    'SELECT "Column specs already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ Поле specs додано (якщо не було)' AS Status;

-- ==========================================
-- PRODUCTS: Додати tuning_kits (JSON) - якщо немає
-- ==========================================

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'products'
    AND COLUMN_NAME = 'tuning_kits'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `products` ADD COLUMN `tuning_kits` JSON NULL AFTER `specs`',
    'SELECT "Column tuning_kits already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ Поле tuning_kits додано (якщо не було)' AS Status;

-- ==========================================
-- PRODUCTS: Додати youtube_url - якщо немає
-- ==========================================

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'products'
    AND COLUMN_NAME = 'youtube_url'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `products` ADD COLUMN `youtube_url` VARCHAR(255) NULL AFTER `tuning_kits`',
    'SELECT "Column youtube_url already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ Поле youtube_url додано (якщо не було)' AS Status;

-- ==========================================
-- PRODUCTS: Додати color
-- ==========================================

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'products'
    AND COLUMN_NAME = 'color'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `products` ADD COLUMN `color` VARCHAR(100) NULL AFTER `youtube_url`',
    'SELECT "Column color already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ Поле color додано' AS Status;

-- ==========================================
-- PRODUCTS: Додати parent_variation_id
-- ==========================================

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'products'
    AND COLUMN_NAME = 'parent_variation_id'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `products` ADD COLUMN `parent_variation_id` BIGINT UNSIGNED NULL AFTER `color`',
    'SELECT "Column parent_variation_id already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Додати зовнішній ключ
SET @constraint_exists = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE CONSTRAINT_SCHEMA = DATABASE()
    AND CONSTRAINT_NAME = 'products_parent_variation_id_foreign'
    AND TABLE_NAME = 'products'
);

SET @sql = IF(@constraint_exists = 0,
    'ALTER TABLE `products` ADD CONSTRAINT `products_parent_variation_id_foreign`
     FOREIGN KEY (`parent_variation_id`) REFERENCES `products` (`id`) ON DELETE CASCADE',
    'SELECT "Constraint already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ Поле parent_variation_id додано з FK' AS Status;

-- ==========================================
-- PRODUCT_VARIATIONS: Створити таблицю
-- ==========================================

CREATE TABLE IF NOT EXISTS `product_variations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `product_id` BIGINT UNSIGNED NOT NULL,
  `variation_id` BIGINT UNSIGNED NOT NULL,
  `variation_type` VARCHAR(50) NOT NULL DEFAULT 'color',
  `sort_order` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  UNIQUE KEY `product_variations_unique` (`product_id`, `variation_id`),
  CONSTRAINT `product_variations_product_id_foreign`
    FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_variations_variation_id_foreign`
    FOREIGN KEY (`variation_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SELECT '✓ Таблиця product_variations створена' AS Status;

-- ==========================================
-- CATEGORIES: Додати parent_id
-- ==========================================

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'categories'
    AND COLUMN_NAME = 'parent_id'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `categories` ADD COLUMN `parent_id` BIGINT UNSIGNED NULL AFTER `id`',
    'SELECT "Column parent_id already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @constraint_exists = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE CONSTRAINT_SCHEMA = DATABASE()
    AND CONSTRAINT_NAME = 'categories_parent_id_foreign'
    AND TABLE_NAME = 'categories'
);

SET @sql = IF(@constraint_exists = 0,
    'ALTER TABLE `categories` ADD CONSTRAINT `categories_parent_id_foreign`
     FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE',
    'SELECT "Constraint already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ Поле parent_id додано до categories' AS Status;

-- ==========================================
-- CATEGORIES: Додати sort_order
-- ==========================================

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'categories'
    AND COLUMN_NAME = 'sort_order'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `categories` ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `is_active`',
    'SELECT "Column sort_order already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ Поле sort_order додано до categories' AS Status;

-- ==========================================
-- CATEGORIES: Додати SEO поля
-- ==========================================

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'categories'
    AND COLUMN_NAME = 'meta_title'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `categories` ADD COLUMN `meta_title` VARCHAR(255) NULL AFTER `description`',
    'SELECT "Column meta_title already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'categories'
    AND COLUMN_NAME = 'meta_description'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `categories` ADD COLUMN `meta_description` TEXT NULL AFTER `meta_title`',
    'SELECT "Column meta_description already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'categories'
    AND COLUMN_NAME = 'meta_keywords'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `categories` ADD COLUMN `meta_keywords` VARCHAR(255) NULL AFTER `meta_description`',
    'SELECT "Column meta_keywords already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ SEO поля додано до categories' AS Status;

-- ==========================================
-- SEO_PAGES: Створити таблицю
-- ==========================================

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

INSERT INTO `seo_pages` (`page_key`, `page_name`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `created_at`, `updated_at`) VALUES
('home', 'Головна сторінка', 'Strikeball Shop — Інтернет-магазин страйкбольного обладнання', 'Купити страйкбольне обладнання в Україні: приводи AEG, магазини, кулі, захист, тактичне спорядження. Великий вибір, вигідні ціни, доставка по Україні.', 'страйкбол, airsoft, привод AEG, магазини страйкбол, кулі airsoft, захист, тактичне спорядження', 1, NOW(), NOW()),
('catalog', 'Каталог товарів', 'Каталог - Strikeball Shop', 'Повний каталог страйкбольного обладнання: приводи, обладнання, аксесуари', 'каталог страйкбол, товари airsoft', 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `page_name` = VALUES(`page_name`);

SELECT '✓ Таблиця seo_pages створена' AS Status;

-- ==========================================
-- MIGRATIONS: Додати записи
-- ==========================================

INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
('2024_02_16_000000_add_specs_to_products_table', 10),
('2024_02_16_000000_add_tuning_kits_to_products_table', 10),
('2024_02_17_000000_add_youtube_url_to_products_table', 10),
('2024_02_18_000002_create_product_variations_table', 10),
('2024_02_18_000003_add_parent_id_to_categories', 10),
('2024_02_18_000004_create_seo_pages_table', 10);

SELECT '✓ Міграції додано' AS Status;

SET FOREIGN_KEY_CHECKS = 1;

-- ==========================================
-- ФІНАЛЬНА ПЕРЕВІРКА
-- ==========================================

SELECT '===========================================' AS '';
SELECT '✓✓✓ ВСІ МІГРАЦІЇ ВИКОНАНІ! ✓✓✓' AS '';
SELECT '===========================================' AS '';

-- Показати нову структуру products
SELECT 'Нова структура products:' AS '';
DESCRIBE products;

-- Показати нові поля в products
SELECT 'Додані поля в products:' AS '';
SELECT COLUMN_NAME, COLUMN_TYPE
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
AND TABLE_NAME = 'products'
AND COLUMN_NAME IN ('specs', 'tuning_kits', 'youtube_url', 'color', 'parent_variation_id')
ORDER BY ORDINAL_POSITION;

-- Показати нові поля в categories
SELECT 'Додані поля в categories:' AS '';
SELECT COLUMN_NAME, COLUMN_TYPE
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
AND TABLE_NAME = 'categories'
AND COLUMN_NAME IN ('parent_id', 'sort_order', 'meta_title', 'meta_description', 'meta_keywords')
ORDER BY ORDINAL_POSITION;

SELECT '===========================================' AS '';
SELECT 'НАСТУПНІ КРОКИ:' AS '';
SELECT '1. php artisan cache:clear' AS '';
SELECT '2. php artisan config:clear' AS '';
SELECT '3. php artisan view:clear' AS '';
SELECT '4. Перевірити сайт http://shop.spf.org.ua' AS '';
SELECT '===========================================' AS '';
