-- ==========================================
-- FIX: Add sort_order to brands table
-- ==========================================

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'brands'
    AND COLUMN_NAME = 'sort_order'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `brands` ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `is_active`',
    'SELECT "Column sort_order already exists in brands" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ sort_order додано до brands' AS Status;

-- ==========================================
-- FIX: Add slug column to categories table
-- ==========================================

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'categories'
    AND COLUMN_NAME = 'slug'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `categories` ADD COLUMN `slug` VARCHAR(255) NOT NULL AFTER `name`, ADD UNIQUE KEY `categories_slug_unique` (`slug`)',
    'SELECT "Column slug already exists in categories" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ slug додано до categories' AS Status;

-- ==========================================
-- FIX: Add SEO fields to categories table
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
    'SELECT "Column meta_title already exists in categories" AS message'
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
    'SELECT "Column meta_description already exists in categories" AS message'
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
    'SELECT "Column meta_keywords already exists in categories" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ SEO поля додано до categories' AS Status;

-- ==========================================
-- FIX: Create attribute_category pivot table
-- ==========================================

CREATE TABLE IF NOT EXISTS `attribute_category` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `attribute_id` BIGINT UNSIGNED NOT NULL,
    `category_id` BIGINT UNSIGNED NOT NULL,
    `sort_order` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    UNIQUE KEY `attribute_category_unique` (`attribute_id`, `category_id`),
    CONSTRAINT `ac_attribute_id_foreign`
        FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
    CONSTRAINT `ac_category_id_foreign`
        FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SELECT '✓ Таблиця attribute_category створена' AS Status;

-- ==========================================
-- FIX: Create attribute_product pivot table (if needed)
-- ==========================================

CREATE TABLE IF NOT EXISTS `attribute_product` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `attribute_id` BIGINT UNSIGNED NOT NULL,
    `product_id` BIGINT UNSIGNED NOT NULL,
    `value` TEXT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    UNIQUE KEY `attribute_product_unique` (`attribute_id`, `product_id`),
    CONSTRAINT `ap_attribute_id_foreign`
        FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
    CONSTRAINT `ap_product_id_foreign`
        FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SELECT '✓ Таблиця attribute_product створена' AS Status;

-- ==========================================
-- FIX: Create product_attributes pivot table (used in Product model)
-- ==========================================

CREATE TABLE IF NOT EXISTS `product_attributes` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `product_id` BIGINT UNSIGNED NOT NULL,
    `attribute_id` BIGINT UNSIGNED NOT NULL,
    `value_string` VARCHAR(255) NULL,
    `value_number` DECIMAL(12,4) NULL,
    `value_bool` TINYINT(1) NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    UNIQUE KEY `product_attributes_unique` (`product_id`, `attribute_id`),
    CONSTRAINT `pa_product_id_foreign`
        FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
    CONSTRAINT `pa_attribute_id_foreign`
        FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SELECT '✓ Таблиця product_attributes створена' AS Status;

-- ==========================================
-- FIX: Add slug column to attributes table
-- ==========================================

-- Step 1: Add slug column as nullable first
SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'attributes'
    AND COLUMN_NAME = 'slug'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `attributes` ADD COLUMN `slug` VARCHAR(255) NULL AFTER `name`',
    'SELECT "Column slug already exists in attributes" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Step 2: Generate slug values for existing records
UPDATE `attributes`
SET `slug` = LOWER(
    REPLACE(
        REPLACE(
            REPLACE(
                REPLACE(`name`, ' ', '-'),
                '/', '-'
            ),
            '(', ''
        ),
        ')', ''
    )
)
WHERE `slug` IS NULL OR `slug` = '';

-- Step 3: Handle duplicates by appending ID
UPDATE `attributes` a1
SET `slug` = CONCAT(a1.`slug`, '-', a1.`id`)
WHERE EXISTS (
    SELECT 1 FROM (SELECT `slug`, COUNT(*) as cnt FROM `attributes` GROUP BY `slug` HAVING cnt > 1) a2
    WHERE a2.`slug` = a1.`slug`
);

-- Step 4: Make slug NOT NULL
SET @column_nullable = (
    SELECT IS_NULLABLE
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'attributes'
    AND COLUMN_NAME = 'slug'
);

SET @sql = IF(@column_nullable = 'YES',
    'ALTER TABLE `attributes` MODIFY COLUMN `slug` VARCHAR(255) NOT NULL',
    'SELECT "Column slug is already NOT NULL" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Step 5: Add unique constraint if not exists
SET @index_exists = (
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'attributes'
    AND INDEX_NAME = 'attributes_slug_unique'
);

SET @sql = IF(@index_exists = 0,
    'ALTER TABLE `attributes` ADD UNIQUE KEY `attributes_slug_unique` (`slug`)',
    'SELECT "Unique key attributes_slug_unique already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ slug додано до attributes' AS Status;

-- ==========================================
-- FIX: Add SEO fields to products (if not already done)
-- ==========================================

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'products'
    AND COLUMN_NAME = 'meta_title'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `products` ADD COLUMN `meta_title` VARCHAR(255) NULL AFTER `youtube_url`',
    'SELECT "Column meta_title already exists in products" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'products'
    AND COLUMN_NAME = 'meta_description'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `products` ADD COLUMN `meta_description` TEXT NULL AFTER `meta_title`',
    'SELECT "Column meta_description already exists in products" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'products'
    AND COLUMN_NAME = 'meta_keywords'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `products` ADD COLUMN `meta_keywords` VARCHAR(255) NULL AFTER `meta_description`',
    'SELECT "Column meta_keywords already exists in products" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SELECT '✓ SEO поля додано до products' AS Status;

-- ==========================================
-- Add more SEO pages (if not already done)
-- ==========================================

INSERT INTO `seo_pages` (`page_key`, `page_name`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `created_at`, `updated_at`) VALUES
('about', 'Про нас', 'Про нас - Strikeball Shop', 'Інформація про інтернет-магазин Strikeball Shop.', 'про нас, strikeball shop', 1, NOW(), NOW()),
('contacts', 'Контакти', 'Контакти - Strikeball Shop', 'Контактна інформація Strikeball Shop.', 'контакти, адреса магазину', 1, NOW(), NOW()),
('delivery', 'Доставка та оплата', 'Доставка та оплата - Strikeball Shop', 'Умови доставки та способи оплати.', 'доставка, оплата, нова пошта', 1, NOW(), NOW()),
('warranty', 'Гарантія', 'Гарантія - Strikeball Shop', 'Гарантійні умови на обладнання.', 'гарантія, умови гарантії', 1, NOW(), NOW()),
('return', 'Повернення та обмін', 'Повернення та обмін - Strikeball Shop', 'Умови повернення та обміну товарів.', 'повернення, обмін товару', 1, NOW(), NOW()),
('brands', 'Бренди', 'Бренди - Strikeball Shop', 'Каталог брендів страйкбольного обладнання.', 'бренди, виробники', 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `page_name` = VALUES(`page_name`), `updated_at` = NOW();

SELECT '✓ SEO сторінки додано' AS Status;

-- ==========================================
-- Add migration records
-- ==========================================

INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
('2024_02_19_000000_add_seo_fields_to_products_table', 11),
('2024_02_19_000001_add_sort_order_to_brands', 11),
('2024_02_19_000002_create_attribute_category_table', 11),
('2024_02_19_000003_create_attribute_product_table', 11),
('2024_02_19_000004_create_product_attributes_table', 11);

SELECT '===========================================' AS '';
SELECT '✓✓✓ ВСІ ВИПРАВЛЕННЯ ЗАСТОСОВАНО! ✓✓✓' AS '';
SELECT '===========================================' AS '';
