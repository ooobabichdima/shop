-- ==========================================
-- Застосування всіх нових міграцій
-- Виконати на продакшн після відновлення бекапу
-- Безпечно - не видаляє існуючі дані!
-- ==========================================

SET FOREIGN_KEY_CHECKS = 0;

-- ==========================================
-- 1. PRODUCTS: Додати color та parent_variation_id
-- ==========================================

-- Перевірка і додавання поля color
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

-- Перевірка і додавання поля parent_variation_id
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

-- Додати зовнішній ключ для parent_variation_id
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

SELECT '✓ КРОК 1: Поля color і parent_variation_id додано до products' AS Status;

-- ==========================================
-- 2. PRODUCT_VARIATIONS: Створити таблицю
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

SELECT '✓ КРОК 2: Таблиця product_variations створена' AS Status;

-- ==========================================
-- 3. CATEGORIES: Додати parent_id та sort_order
-- ==========================================

-- Додати parent_id
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

-- Додати sort_order
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

-- Додати зовнішній ключ для parent_id
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

SELECT '✓ КРОК 3: Поля parent_id і sort_order додано до categories' AS Status;

-- ==========================================
-- 4. CATEGORIES: Додати SEO поля
-- ==========================================

-- Додати meta_title
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

-- Додати meta_description
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

-- Додати meta_keywords
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

SELECT '✓ КРОК 4: SEO поля додано до categories' AS Status;

-- ==========================================
-- 5. SEO_PAGES: Створити таблицю
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

-- Вставити дефолтні SEO сторінки
INSERT INTO `seo_pages` (`page_key`, `page_name`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `created_at`, `updated_at`) VALUES
('home', 'Головна сторінка', 'Strikeball Shop — Інтернет-магазин страйкбольного обладнання', 'Купити страйкбольне обладнання в Україні: приводи AEG, магазини, кулі, захист, тактичне спорядження. Великий вибір, вигідні ціни, доставка по Україні.', 'страйкбол, airsoft, привод AEG, магазини страйкбол, кулі airsoft, захист, тактичне спорядження', 1, NOW(), NOW()),
('catalog', 'Каталог товарів', 'Каталог - Strikeball Shop', 'Повний каталог страйкбольного обладнання: приводи, обладнання, аксесуари', 'каталог страйкбол, товари airsoft', 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `page_name` = VALUES(`page_name`);

SELECT '✓ КРОК 5: Таблиця seo_pages створена і заповнена' AS Status;

-- ==========================================
-- 6. MIGRATIONS: Додати записи
-- ==========================================

INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
('2024_02_18_000002_create_product_variations_table', 10),
('2024_02_18_000003_add_parent_id_to_categories', 10),
('2024_02_18_000004_create_seo_pages_table', 10);

SELECT '✓ КРОК 6: Записи додано в таблицю migrations' AS Status;

-- ==========================================
-- ПЕРЕВІРКА: Показати результати
-- ==========================================

SELECT '===========================================' AS '';
SELECT '✓ ВСІ МІГРАЦІЇ ВИКОНАНІ УСПІШНО!' AS 'РЕЗУЛЬТАТ';
SELECT '===========================================' AS '';

-- Показати структуру products
SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
AND TABLE_NAME = 'products'
AND COLUMN_NAME IN ('color', 'parent_variation_id', 'youtube_url')
ORDER BY ORDINAL_POSITION;

-- Показати структуру categories
SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
AND TABLE_NAME = 'categories'
AND COLUMN_NAME IN ('parent_id', 'sort_order', 'meta_title', 'meta_description', 'meta_keywords')
ORDER BY ORDINAL_POSITION;

-- Показати створені таблиці
SHOW TABLES LIKE '%variation%';
SHOW TABLES LIKE '%seo%';

-- Показати SEO сторінки
SELECT * FROM seo_pages;

SET FOREIGN_KEY_CHECKS = 1;

SELECT '===========================================' AS '';
SELECT 'Тепер виконайте: php artisan cache:clear' AS 'НАСТУПНИЙ КРОК';
SELECT '===========================================' AS '';
