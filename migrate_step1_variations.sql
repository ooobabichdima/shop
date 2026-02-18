-- ==========================================
-- КРОК 1: Варіації товарів (кольори)
-- ==========================================

-- Додати поля color та parent_variation_id до products
ALTER TABLE `products`
ADD COLUMN IF NOT EXISTS `color` VARCHAR(100) NULL AFTER `youtube_url`;

ALTER TABLE `products`
ADD COLUMN IF NOT EXISTS `parent_variation_id` BIGINT UNSIGNED NULL AFTER `color`;

-- Додати зовнішній ключ (якщо не існує)
SET @constraintExists = (
    SELECT COUNT(*)
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE CONSTRAINT_NAME = 'products_parent_variation_id_foreign'
    AND TABLE_SCHEMA = DATABASE()
);

SET @sql = IF(@constraintExists = 0,
    'ALTER TABLE `products` ADD CONSTRAINT `products_parent_variation_id_foreign`
     FOREIGN KEY (`parent_variation_id`) REFERENCES `products` (`id`) ON DELETE CASCADE',
    'SELECT "Constraint already exists"'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Створити таблицю product_variations
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

-- Додати в migrations
INSERT IGNORE INTO `migrations` (`migration`, `batch`)
VALUES ('2024_02_18_000002_create_product_variations_table', 3);

SELECT 'КРОК 1: Варіації товарів - ВИКОНАНО' as Status;
