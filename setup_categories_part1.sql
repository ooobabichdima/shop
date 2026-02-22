-- ==========================================
-- СТРУКТУРА КАТЕГОРІЙ СТРАЙКБОЛЬНОГО МАГАЗИНУ
-- ==========================================

SET FOREIGN_KEY_CHECKS = 0;

-- Очистити існуючі категорії (обережно!)
-- TRUNCATE TABLE categories;

SET FOREIGN_KEY_CHECKS = 1;

-- ==========================================
-- 1. ПРИВОДИ (AEG / Репліки зброї)
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Приводи', 'pryvody', 'Електричні, газові та пружинні репліки зброї для страйкболу', 1, 1, NOW(), NOW()),
(11, 1, 'Штурмові гвинтівки', 'shturmovi-gvyntivky', 'M4/M16, AK серія, G36, SCAR, HK416, AR-15', 1, 1, NOW(), NOW()),
(12, 1, 'Пістолети-кулемети', 'pistolety-kulemety', 'MP5, MP7, MP9, P90, UMP, Kriss Vector', 2, 1, NOW(), NOW()),
(13, 1, 'Снайперські гвинтівки', 'snayperski-gvyntivky', 'Болтові (Spring), напівавтоматичні (DMR)', 3, 1, NOW(), NOW()),
(14, 1, 'Кулемети', 'kulemety', 'M249, M60, ПКМ, РПК', 4, 1, NOW(), NOW()),
(15, 1, 'Дробовики', 'drobowyky', 'Помпові, газові, електричні', 5, 1, NOW(), NOW()),
(16, 1, 'Пістолети', 'pistolety', 'GBB (газові), CO2, електричні (AEP)', 6, 1, NOW(), NOW()),
(17, 1, 'Гранатомети / Підствольники', 'granatomety', 'M203, ГП-25, РПГ-репліки', 7, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- 2. БОЄПРИПАСИ ТА ВИТРАТНІ МАТЕРІАЛИ
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(2, NULL, 'Боєприпаси та витратні матеріали', 'boieprypasy', 'Кулі, газ, гранати для страйкболу', 2, 1, NOW(), NOW()),
(21, 2, 'Кулі (BB)', 'kuli-bb', 'За вагою: 0.20г - 0.40г+', 1, 1, NOW(), NOW()),
(22, 2, 'Трасерні кулі', 'traserni-kuli', 'Світяться у темряві для трасерних насадок', 2, 1, NOW(), NOW()),
(23, 2, 'БІО-кулі', 'bio-kuli', 'Біорозкладні для відкритих полігонів', 3, 1, NOW(), NOW()),
(24, 2, 'Газ', 'gaz', 'Green Gas, Red Gas, CO2 балончики, Propane адаптери', 4, 1, NOW(), NOW()),
(25, 2, 'Гранати та міни', 'granaty-ta-miny', 'Піротехніка, газові гранати, Тагінн, димові шашки', 5, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- 3. АПГРЕЙД ТА ТЮНІНГ
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(3, NULL, 'Апгрейд та тюнінг', 'apgreid', 'Внутрішні та зовнішні покращення для приводів', 3, 1, NOW(), NOW()),
-- Внутрішній апгрейд
(31, 3, 'Гірбокси та корпуси', 'girboksy', 'V2 (M4), V3 (AK), V6 (P90), V7 (M14)', 1, 1, NOW(), NOW()),
(32, 3, 'Мотори', 'motory', 'High Speed, High Torque, Balanced', 2, 1, NOW(), NOW()),
(33, 3, 'Шестерні', 'shesterni', 'Стандартні, посилені, DSG', 3, 1, NOW(), NOW()),
(34, 3, 'Поршні та голівки поршня', 'porshni', 'Полікарбонат, сталь, алюміній', 4, 1, NOW(), NOW()),
(35, 3, 'Циліндри та голівки циліндра', 'tsylindry', 'Повні, з портами, алюмінієві', 5, 1, NOW(), NOW()),
(36, 3, 'Нозли', 'nozli', 'За платформою (M4, AK, G36 тощо)', 6, 1, NOW(), NOW()),
(37, 3, 'Пружини', 'pruzhyny', 'M90 - M190', 7, 1, NOW(), NOW()),
(38, 3, 'Бушинги / підшипники', 'bushyngy', '6мм / 7мм / 8мм', 8, 1, NOW(), NOW()),
(39, 3, 'Hop-Up камери', 'hop-up-kamery', 'Метал, пластик, CNC', 9, 1, NOW(), NOW()),
(310, 3, 'Гумки Hop-Up', 'gumky-hop-up', 'Maple Leaf, Modify, Prometheus, G&G Green', 10, 1, NOW(), NOW()),
(311, 3, 'Стволи внутрішні', 'stvoly-vnutrishni', '6.01 / 6.03 / 6.05 / 6.08 мм', 11, 1, NOW(), NOW()),
(312, 3, 'MOSFET / ETU / електроніка', 'mosfet-etu', 'GATE Titan, Perun, Jefftron, MOSFET модулі', 12, 1, NOW(), NOW()),
(313, 3, 'Електропроводка', 'elektroprovodka', 'Tamiya, Deans (T-plug), XT60', 13, 1, NOW(), NOW()),
-- Зовнішній тюнінг
(314, 3, 'Цівки / Хендгарди', 'tsivky-hendgardy', 'M-LOK, KeyMod, Picatinny / Weaver', 14, 1, NOW(), NOW()),
(315, 3, 'Приклади', 'pryklady', 'Телескопічні, складні, фіксовані', 15, 1, NOW(), NOW()),
(316, 3, 'Пістолетні руків\'я', 'pistoletni-rukivya', 'Ергономічні, з відсіком для мотора', 16, 1, NOW(), NOW()),
(317, 3, 'Зовнішні стволи', 'zovnishni-stvoly', 'Різна довжина, різьба 14мм CCW', 17, 1, NOW(), NOW()),
(318, 3, 'Полум\'ягасники / Глушники', 'polumyagasnyky', 'Декоративні та функціональні, трасери', 18, 1, NOW(), NOW()),
(319, 3, 'Рейкові системи', 'reykovi-systemy', 'Планки Пікатінні, адаптери', 19, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- 4. МАГАЗИНИ (ДЛЯ ПРИВОДІВ)
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(4, NULL, 'Магазини', 'magazyny', 'Магазини для приводів різних платформ', 4, 1, NOW(), NOW()),
(41, 4, 'Магазини M4 / M16', 'magazyny-m4', 'Mid-Cap, Hi-Cap, Low-Cap для M4/AR15', 1, 1, NOW(), NOW()),
(42, 4, 'Магазини AK', 'magazyny-ak', 'Mid-Cap, Hi-Cap для AK серії', 2, 1, NOW(), NOW()),
(43, 4, 'Магазини G36', 'magazyny-g36', 'Mid-Cap, Hi-Cap для G36', 3, 1, NOW(), NOW()),
(44, 4, 'Магазини MP5', 'magazyny-mp5', 'Mid-Cap, Hi-Cap для MP5', 4, 1, NOW(), NOW()),
(45, 4, 'Пістолетні магазини', 'magazyny-pistoletni', 'Для газових та електричних пістолетів', 5, 1, NOW(), NOW()),
(46, 4, 'Снайперські магазини', 'magazyny-snayperski', 'Для болтових та напівавтоматичних снайперок', 6, 1, NOW(), NOW()),
(47, 4, 'Drum магазини', 'drum-magazyny', 'Бункерні магазини високої ємності', 7, 1, NOW(), NOW()),
(48, 4, 'Аксесуари магазинів', 'aksesuary-magazyniv', 'Прискорювачі, спідлоадери, зв\'язки', 8, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- 5. АКУМУЛЯТОРИ ТА ЗАРЯДНІ
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(5, NULL, 'Акумулятори та зарядні', 'akumulyatory', 'LiPo, NiMH, Li-Ion акумулятори та зарядні пристрої', 5, 1, NOW(), NOW()),
(51, 5, 'LiPo акумулятори', 'lipo', '7.4V (2S) / 11.1V (3S) - різні форми', 1, 1, NOW(), NOW()),
(52, 5, 'NiMH акумулятори', 'nimh', '8.4V / 9.6V - mini, large', 2, 1, NOW(), NOW()),
(53, 5, 'Li-Ion акумулятори', 'li-ion', '18650, 21700 збірки', 3, 1, NOW(), NOW()),
(54, 5, 'Зарядні пристрої', 'zaryadni', 'Прості, балансні, розумні (IMAX B6, SkyRC)', 4, 1, NOW(), NOW()),
(55, 5, 'Аксесуари акумуляторів', 'aksesuary-akb', 'LiPo-safe мішки, адаптери, тестери', 5, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- 6. ОПТИКА ТА ПРИЦІЛЬНІ ПРИСТРОЇ
-- ==========================================

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(6, NULL, 'Оптика та прицільні пристрої', 'optyka', 'Коліматори, оптичні приціли, ліхтарі, лазери', 6, 1, NOW(), NOW()),
(61, 6, 'Коліматорні приціли', 'kolimatorni', 'Red Dot, Holo, T1/T2, EOTech репліки', 1, 1, NOW(), NOW()),
(62, 6, 'Оптичні приціли', 'optychni', '1-4x, 3-9x, 4x32 ACOG репліки', 2, 1, NOW(), NOW()),
(63, 6, 'LPVO приціли', 'lpvo', '1-6x, 1-8x зі змінною кратністю', 3, 1, NOW(), NOW()),
(64, 6, 'Мушки та цілики', 'mushky-tsilyky', 'Flip-up (відкидні), стаціонарні, BUIS', 4, 1, NOW(), NOW()),
(65, 6, 'Збільшувачі (Magnifier)', 'zbilshuvachi', '3x, 5x з відкидним кріпленням', 5, 1, NOW(), NOW()),
(66, 6, 'Лазерні цілевказівники', 'lazerni', 'PEQ-15, AN/PEQ, DBAL репліки', 6, 1, NOW(), NOW()),
(67, 6, 'Тактичні ліхтарі', 'taktychni-likhtari', 'Підствольні, шлемні, з виносною кнопкою', 7, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `description` = VALUES(`description`),
    `parent_id` = VALUES(`parent_id`),
    `sort_order` = VALUES(`sort_order`);

-- Продовження в наступній частині...

SELECT '✓ Категорії створено: Приводи, Боєприпаси, Апгрейд, Магазини, Акумулятори, Оптика' AS Status;
