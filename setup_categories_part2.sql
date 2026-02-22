-- ==========================================
-- СТРУКТУРА КАТЕГОРІЙ - ЧАСТИНА 2
-- ==========================================

-- ==========================================
-- 7. ЗАХИСНЕ СПОРЯДЖЕННЯ
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(7, NULL, 'Захисне спорядження', 'zakhyst', 'Маски, окуляри, шоломи, захист тіла', 7, 1, NOW(), NOW()),
(71, 7, 'Маски', 'masky', 'Повнолицьові, нижня частина (сітка / м\'які)', 1, 1, NOW(), NOW()),
(72, 7, 'Окуляри', 'okulyary', 'Балістичні, тактичні, з анти-фог покриттям', 2, 1, NOW(), NOW()),
(73, 7, 'Шоломи', 'sholomy', 'FAST, MICH, Ops-Core репліки, чохли', 3, 1, NOW(), NOW()),
(74, 7, 'Наколінники / Налокітники', 'nakolinnyky', 'Жорсткі, м\'які, вбудовані в одяг', 4, 1, NOW(), NOW()),
(75, 7, 'Рукавички', 'rukavychky', 'Повнопалі, безпалі, з захистом кісточок', 5, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- 8. ТАКТИЧНЕ СПОРЯДЖЕННЯ
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(8, NULL, 'Тактичне спорядження', 'taktychne-sporyadzhennya', 'Розвантажувальні системи, підсумки, ремені', 8, 1, NOW(), NOW()),
-- Носильні системи
(81, 8, 'Плейт-керієри', 'pleyt-keriery', 'JPC, CPC, 6094, AVS, Стрілець', 1, 1, NOW(), NOW()),
(82, 8, 'Розвантажувальні жилети', 'rozvantazhuvalni-zhylety', 'Chest Rig, модульні', 2, 1, NOW(), NOW()),
(83, 8, 'Чест-ріги', 'chest-rigy', 'Micro Rig, D3CR, Haley Strategic репліки', 3, 1, NOW(), NOW()),
(84, 8, 'Тактичні пояси', 'taktychni-poyasy', 'Бойові пояси, подвійні системи (inner + outer)', 4, 1, NOW(), NOW()),
-- Підсумки
(85, 8, 'Підсумки під магазини', 'pidsumky-magazyny', 'AR / AK / Пістолетні - одинарні, подвійні, потрійні', 5, 1, NOW(), NOW()),
(86, 8, 'Утилітарні підсумки', 'utylitarni-pidsumky', 'Для дрібних речей, інструментів', 6, 1, NOW(), NOW()),
(87, 8, 'Підсумки для гранат', 'pidsumky-granaty', 'Під димові шашки, гранати', 7, 1, NOW(), NOW()),
(88, 8, 'Медичні підсумки (IFAK)', 'medychni-pidsumky', 'Для аптечки першої допомоги', 8, 1, NOW(), NOW()),
(89, 8, 'Підсумки для рацій', 'pidsumky-ratsii', 'Під Baofeng, Kenwood', 9, 1, NOW(), NOW()),
(810, 8, 'Дамп-підсумки', 'damp-pidsumky', 'Складні для порожніх магазинів', 10, 1, NOW(), NOW()),
-- Інше
(811, 8, 'Ремені зброї', 'remeni-zbroi', '1-точкові, 2-точкові, 3-точкові', 11, 1, NOW(), NOW()),
(812, 8, 'Рюкзаки та сумки', 'ryukzaky', 'Тактичні, штурмові, чохли для зброї', 12, 1, NOW(), NOW()),
(813, 8, 'Кобури', 'kobury', 'Жорсткі (Kydex/Serpa), м\'які, набедрені, MOLLE', 13, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- 9. ОДЯГ
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(9, NULL, 'Одяг', 'odyag', 'Камуфляж, тактичний одяг, взуття', 9, 1, NOW(), NOW()),
(91, 9, 'Куртки / Кітелі', 'kurtky', 'Мультикам, Піксель ЗСУ, Олива, Чорний', 1, 1, NOW(), NOW()),
(92, 9, 'Штани', 'shtany', 'Бойові штани з наколінниками / без', 2, 1, NOW(), NOW()),
(93, 9, 'Комплекти (куртка + штани)', 'komplekty', 'Камуфляжні костюми', 3, 1, NOW(), NOW()),
(94, 9, 'Базовий шар', 'bazovyy-shar', 'Термобілизна, вологовідвідна', 4, 1, NOW(), NOW()),
(95, 9, 'Головні убори', 'golovni-ubory', 'Бейсболки, боні, бандани, балаклави, шемаги', 5, 1, NOW(), NOW()),
(96, 9, 'Взуття', 'vzuttya', 'Тактичні черевики, берці, літні/зимові', 6, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- 10. ЗВ'ЯЗОК
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(10, NULL, 'Зв\'язок', 'zvyazok', 'Рації, гарнітури, навушники', 10, 1, NOW(), NOW()),
(101, 10, 'Рації', 'ratsii', 'Baofeng UV-5R, Kenwood та інші', 1, 1, NOW(), NOW()),
(102, 10, 'Гарнітури', 'garnitury', 'Активні навушники, PTT кнопки', 2, 1, NOW(), NOW()),
(103, 10, 'Навушники-репліки', 'navushnyky', 'Comtac, Sordin, GSSH-01', 3, 1, NOW(), NOW()),
(104, 10, 'Адаптери та кріплення', 'adaptery-zvyazok', 'ARC Rail адаптери, перехідники', 4, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- 11. КАМУФЛЯЖ ТА МАСКУВАННЯ
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(11, NULL, 'Камуфляж та маскування', 'kamuflyazh', 'Маскхалати, гіллі-костюми, сітки', 11, 1, NOW(), NOW()),
(111, 11, 'Маскхалати / Гіллі', 'gilli', 'Повні, накидки, голова', 1, 1, NOW(), NOW()),
(112, 11, 'Маскувальні сітки', 'maskuvalni-sitky', 'Різні кольори та розміри', 2, 1, NOW(), NOW()),
(113, 11, 'Камуфляжні стрічки', 'kamuflyazhni-strichky', 'Тканинні, самоклеючі, фарби', 3, 1, NOW(), NOW()),
(114, 11, 'Чохли на зброю', 'chokhly-zbroyu', 'Камуфляжні обмотки, сітки', 4, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- 12. ІНСТРУМЕНТИ ТА ОБСЛУГОВУВАННЯ
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(12, NULL, 'Інструменти та обслуговування', 'instrumenty', 'Мастила, інструменти, хронографи', 12, 1, NOW(), NOW()),
(121, 12, 'Мастила та силікон', 'mastyla', 'Силіконове масло, тефлонова змазка, WD-40', 1, 1, NOW(), NOW()),
(122, 12, 'Мультитули та інструменти', 'multytools', 'Ключі, викрутки, набори для приводів', 2, 1, NOW(), NOW()),
(123, 12, 'Хронографи', 'khronografy', 'Для заміру швидкості кулі (FPS)', 3, 1, NOW(), NOW()),
(124, 12, 'Мішені та пастки', 'misheni', 'Паперові, металеві, сітчасті пастки', 4, 1, NOW(), NOW()),
(125, 12, 'Кейси та чохли', 'keysy', 'Жорсткі кейси, м\'які чохли, ганбеги', 5, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

SELECT '✓ Категорії створено: Захист, Тактика, Одяг, Зв\'язок, Камуфляж, Інструменти' AS Status;
SELECT '✓ Всього створено 12 основних категорій + підкатегорії' AS Info;
