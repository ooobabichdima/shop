-- Add more pages to SEO admin

INSERT INTO `seo_pages` (`page_key`, `page_name`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `created_at`, `updated_at`) VALUES
('about', 'Про нас', 'Про нас - Strikeball Shop', 'Інформація про інтернет-магазин Strikeball Shop. Наша історія, цінності та переваги.', 'про нас, strikeball shop, про магазин', 1, NOW(), NOW()),
('contacts', 'Контакти', 'Контакти - Strikeball Shop', 'Контактна інформація Strikeball Shop: телефон, email, адреса магазину.', 'контакти, зв\'язатися з нами, адреса магазину', 1, NOW(), NOW()),
('delivery', 'Доставка та оплата', 'Доставка та оплата - Strikeball Shop', 'Умови доставки та способи оплати в Strikeball Shop. Новою Поштою по всій Україні.', 'доставка, оплата, нова пошта, спосіб оплати', 1, NOW(), NOW()),
('warranty', 'Гарантія', 'Гарантія - Strikeball Shop', 'Гарантійні умови на страйкбольне обладнання. Повернення та обмін товарів.', 'гарантія, умови гарантії, повернення товару', 1, NOW(), NOW()),
('return', 'Повернення та обмін', 'Повернення та обмін - Strikeball Shop', 'Умови повернення та обміну товарів у Strikeball Shop. Гарантія якості.', 'повернення, обмін товару, умови повернення', 1, NOW(), NOW()),
('brands', 'Бренди', 'Бренди - Strikeball Shop', 'Каталог брендів страйкбольного обладнання. Офіційні виробники та постачальники.', 'бренди, виробники, страйкбол бренди', 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `page_name` = VALUES(`page_name`), `updated_at` = NOW();

SELECT 'SEO pages added successfully!' AS result;
