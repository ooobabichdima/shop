-- ==========================================
-- КРОК 2: Батьківські категорії
-- ==========================================

-- Додати parent_id до categories
ALTER TABLE `categories`
ADD COLUMN IF NOT EXISTS `parent_id` BIGINT UNSIGNED NULL AFTER `id`;

-- Додати sort_order до categories
ALTER TABLE `categories`
ADD COLUMN IF NOT EXISTS `sort_order` INT NOT NULL DEFAULT 0 AFTER `is_active`;

-- Додати зовнішній ключ для parent_id
SET @constraintExists = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE CONSTRAINT_NAME = 'categories_parent_id_foreign'
    AND TABLE_SCHEMA = DATABASE()
);

SET @sql = IF(@constraintExists = 0,
    'ALTER TABLE `categories` ADD CONSTRAINT `categories_parent_id_foreign`
     FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE',
    'SELECT "Constraint already exists"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Додати в migrations
INSERT IGNORE INTO `migrations` (`migration`, `batch`)
VALUES ('2024_02_18_000003_add_parent_id_to_categories', 3);

SELECT 'КРОК 2: Батьківські категорії - ВИКОНАНО' as Status;
