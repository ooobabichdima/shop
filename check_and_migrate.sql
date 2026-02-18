-- ==========================================
-- Перевірка та покрокове виконання міграцій
-- ==========================================

-- Показати всі таблиці
SHOW TABLES;

-- Перевірити структуру categories
DESCRIBE categories;

-- Перевірити структуру products
DESCRIBE products;

-- Перевірити чи є таблиця migrations
SELECT * FROM migrations ORDER BY id DESC LIMIT 20;
