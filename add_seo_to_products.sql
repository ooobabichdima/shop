-- Add SEO fields to products table

-- Check and add meta_title field
SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'products'
    AND COLUMN_NAME = 'meta_title'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `products` ADD COLUMN `meta_title` VARCHAR(255) NULL AFTER `youtube_url`',
    'SELECT "Column meta_title already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Check and add meta_description field
SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'products'
    AND COLUMN_NAME = 'meta_description'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `products` ADD COLUMN `meta_description` TEXT NULL AFTER `meta_title`',
    'SELECT "Column meta_description already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Check and add meta_keywords field
SET @column_exists = (
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'products'
    AND COLUMN_NAME = 'meta_keywords'
);

SET @sql = IF(@column_exists = 0,
    'ALTER TABLE `products` ADD COLUMN `meta_keywords` VARCHAR(255) NULL AFTER `meta_description`',
    'SELECT "Column meta_keywords already exists" AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Add migration record
INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
('2024_02_19_000000_add_seo_fields_to_products_table', 11);

SELECT 'SEO fields added to products table successfully!' AS result;
