-- ==========================================
-- ПОВНА УСТАНОВКА СТРАЙКБОЛЬНОГО МАГАЗИНУ
-- 99 категорій + 40 атрибутів + SEO
-- ==========================================

SET FOREIGN_KEY_CHECKS = 0;

-- ==========================================
-- ЧАСТИНА 1: КАТЕГОРІЇ 1-6
-- ==========================================

-- 1. ПРИВОДИ (AEG / Репліки зброї)
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Приводи', 'pryvody', 'Електричні, газові та пружинні репліки зброї для страйкболу', 1, 1, NOW(), NOW()),
(11, 1, 'Штурмові гвинтівки', 'shturmovi-gvyntivky', 'M4/M16, AK серія, G36, SCAR, HK416, AR-15', 1, 1, NOW(), NOW()),
(12, 1, 'Пістолети-кулемети', 'pistolety-kulemety', 'MP5, MP7, MP9, P90, UMP, Kriss Vector', 2, 1, NOW(), NOW()),
(13, 1, 'Снайперські гвинтівки', 'snayperski-gvyntivky', 'Болтові (Spring), напівавтоматичні (DMR)', 3, 1, NOW(), NOW()),
(14, 1, 'Кулемети', 'kulemety', 'M249, M60, ПКМ, РПК', 4, 1, NOW(), NOW()),
(15, 1, 'Дробовики', 'drobowyky', 'Помпові, газові, електричні', 5, 1, NOW(), NOW()),
(16, 1, 'Пістолети', 'pistolety', 'GBB (газові), CO2, електричні (AEP)', 6, 1, NOW(), NOW()),
(17, 1, 'Гранатомети / Підствольники', 'granatomety', 'M203, ГП-25, РПГ-репліки', 7, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

-- 2. БОЄПРИПАСИ ТА ВИТРАТНІ МАТЕРІАЛИ
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(2, NULL, 'Боєприпаси та витратні матеріали', 'boieprypasy', 'Кулі, газ, гранати для страйкболу', 2, 1, NOW(), NOW()),
(21, 2, 'Кулі (BB)', 'kuli-bb', 'За вагою: 0.20г - 0.40г+', 1, 1, NOW(), NOW()),
(22, 2, 'Трасерні кулі', 'traserni-kuli', 'Світяться у темряві для трасерних насадок', 2, 1, NOW(), NOW()),
(23, 2, 'БІО-кулі', 'bio-kuli', 'Біорозкладні для відкритих полігонів', 3, 1, NOW(), NOW()),
(24, 2, 'Газ', 'gaz', 'Green Gas, Red Gas, CO2 балончики, Propane адаптери', 4, 1, NOW(), NOW()),
(25, 2, 'Гранати та міни', 'granaty-ta-miny', 'Піротехніка, газові гранати, Тагінн, димові шашки', 5, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

-- 3. АПГРЕЙД ТА ТЮНІНГ
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(3, NULL, 'Апгрейд та тюнінг', 'apgreid', 'Внутрішні та зовнішні покращення для приводів', 3, 1, NOW(), NOW()),
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
(314, 3, 'Цівки / Хендгарди', 'tsivky-hendgardy', 'M-LOK, KeyMod, Picatinny / Weaver', 14, 1, NOW(), NOW()),
(315, 3, 'Приклади', 'pryklady', 'Телескопічні, складні, фіксовані', 15, 1, NOW(), NOW()),
(316, 3, 'Пістолетні руків\'я', 'pistoletni-rukivya', 'Ергономічні, з відсіком для мотора', 16, 1, NOW(), NOW()),
(317, 3, 'Зовнішні стволи', 'zovnishni-stvoly', 'Різна довжина, різьба 14мм CCW', 17, 1, NOW(), NOW()),
(318, 3, 'Полум\'ягасники / Глушники', 'polumyagasnyky', 'Декоративні та функціональні, трасери', 18, 1, NOW(), NOW()),
(319, 3, 'Рейкові системи', 'reykovi-systemy', 'Планки Пікатінні, адаптери', 19, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

-- 4. МАГАЗИНИ (ДЛЯ ПРИВОДІВ)
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
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

-- 5. АКУМУЛЯТОРИ ТА ЗАРЯДНІ
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(5, NULL, 'Акумулятори та зарядні', 'akumulyatory', 'LiPo, NiMH, Li-Ion акумулятори та зарядні пристрої', 5, 1, NOW(), NOW()),
(51, 5, 'LiPo акумулятори', 'lipo', '7.4V (2S) / 11.1V (3S) - різні форми', 1, 1, NOW(), NOW()),
(52, 5, 'NiMH акумулятори', 'nimh', '8.4V / 9.6V - mini, large', 2, 1, NOW(), NOW()),
(53, 5, 'Li-Ion акумулятори', 'li-ion', '18650, 21700 збірки', 3, 1, NOW(), NOW()),
(54, 5, 'Зарядні пристрої', 'zaryadni', 'Прості, балансні, розумні (IMAX B6, SkyRC)', 4, 1, NOW(), NOW()),
(55, 5, 'Аксесуари акумуляторів', 'aksesuary-akb', 'LiPo-safe мішки, адаптери, тестери', 5, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

-- 6. ОПТИКА ТА ПРИЦІЛЬНІ ПРИСТРОЇ
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(6, NULL, 'Оптика та прицільні пристрої', 'optyka', 'Коліматори, оптичні приціли, ліхтарі, лазери', 6, 1, NOW(), NOW()),
(61, 6, 'Коліматорні приціли', 'kolimatorni', 'Red Dot, Holo, T1/T2, EOTech репліки', 1, 1, NOW(), NOW()),
(62, 6, 'Оптичні приціли', 'optychni', '1-4x, 3-9x, 4x32 ACOG репліки', 2, 1, NOW(), NOW()),
(63, 6, 'LPVO приціли', 'lpvo', '1-6x, 1-8x зі змінною кратністю', 3, 1, NOW(), NOW()),
(64, 6, 'Мушки та цілики', 'mushky-tsilyky', 'Flip-up (відкидні), стаціонарні, BUIS', 4, 1, NOW(), NOW()),
(65, 6, 'Збільшувачі (Magnifier)', 'zbilshuvachi', '3x, 5x з відкидним кріпленням', 5, 1, NOW(), NOW()),
(66, 6, 'Лазерні цілевказівники', 'lazerni', 'PEQ-15, AN/PEQ, DBAL репліки', 6, 1, NOW(), NOW()),
(67, 6, 'Тактичні ліхтарі', 'taktychni-likhtari', 'Підствольні, шлемні, з виносною кнопкою', 7, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

SELECT '✓ Категорії 1-6 створено: Приводи, Боєприпаси, Апгрейд, Магазини, Акумулятори, Оптика' AS Status;

-- ==========================================
-- ЧАСТИНА 2: КАТЕГОРІЇ 7-12
-- ==========================================

-- 7. ЗАХИСНЕ СПОРЯДЖЕННЯ
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(7, NULL, 'Захисне спорядження', 'zakhyst', 'Маски, окуляри, шоломи, захист тіла', 7, 1, NOW(), NOW()),
(71, 7, 'Маски', 'masky', 'Повнолицьові, нижня частина (сітка / м\'які)', 1, 1, NOW(), NOW()),
(72, 7, 'Окуляри', 'okulyary', 'Балістичні, тактичні, з анти-фог покриттям', 2, 1, NOW(), NOW()),
(73, 7, 'Шоломи', 'sholomy', 'FAST, MICH, Ops-Core репліки, чохли', 3, 1, NOW(), NOW()),
(74, 7, 'Наколінники / Налокітники', 'nakolinnyky', 'Жорсткі, м\'які, вбудовані в одяг', 4, 1, NOW(), NOW()),
(75, 7, 'Рукавички', 'rukavychky', 'Повнопалі, безпалі, з захистом кісточок', 5, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

-- 8. ТАКТИЧНЕ СПОРЯДЖЕННЯ
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(8, NULL, 'Тактичне спорядження', 'taktychne-sporyadzhennya', 'Розвантажувальні системи, підсумки, ремені', 8, 1, NOW(), NOW()),
(81, 8, 'Плейт-керієри', 'pleyt-keriery', 'JPC, CPC, 6094, AVS, Стрілець', 1, 1, NOW(), NOW()),
(82, 8, 'Розвантажувальні жилети', 'rozvantazhuvalni-zhylety', 'Chest Rig, модульні', 2, 1, NOW(), NOW()),
(83, 8, 'Чест-ріги', 'chest-rigy', 'Micro Rig, D3CR, Haley Strategic репліки', 3, 1, NOW(), NOW()),
(84, 8, 'Тактичні пояси', 'taktychni-poyasy', 'Бойові пояси, подвійні системи (inner + outer)', 4, 1, NOW(), NOW()),
(85, 8, 'Підсумки під магазини', 'pidsumky-magazyny', 'AR / AK / Пістолетні - одинарні, подвійні, потрійні', 5, 1, NOW(), NOW()),
(86, 8, 'Утилітарні підсумки', 'utylitarni-pidsumky', 'Для дрібних речей, інструментів', 6, 1, NOW(), NOW()),
(87, 8, 'Підсумки для гранат', 'pidsumky-granaty', 'Під димові шашки, гранати', 7, 1, NOW(), NOW()),
(88, 8, 'Медичні підсумки (IFAK)', 'medychni-pidsumky', 'Для аптечки першої допомоги', 8, 1, NOW(), NOW()),
(89, 8, 'Підсумки для рацій', 'pidsumky-ratsii', 'Під Baofeng, Kenwood', 9, 1, NOW(), NOW()),
(810, 8, 'Дамп-підсумки', 'damp-pidsumky', 'Складні для порожніх магазинів', 10, 1, NOW(), NOW()),
(811, 8, 'Ремені зброї', 'remeni-zbroi', '1-точкові, 2-точкові, 3-точкові', 11, 1, NOW(), NOW()),
(812, 8, 'Рюкзаки та сумки', 'ryukzaky', 'Тактичні, штурмові, чохли для зброї', 12, 1, NOW(), NOW()),
(813, 8, 'Кобури', 'kobury', 'Жорсткі (Kydex/Serpa), м\'які, набедрені, MOLLE', 13, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

-- 9. ОДЯГ
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(9, NULL, 'Одяг', 'odyag', 'Камуфляж, тактичний одяг, взуття', 9, 1, NOW(), NOW()),
(91, 9, 'Куртки / Кітелі', 'kurtky', 'Мультикам, Піксель ЗСУ, Олива, Чорний', 1, 1, NOW(), NOW()),
(92, 9, 'Штани', 'shtany', 'Бойові штани з наколінниками / без', 2, 1, NOW(), NOW()),
(93, 9, 'Комплекти (куртка + штани)', 'komplekty', 'Камуфляжні костюми', 3, 1, NOW(), NOW()),
(94, 9, 'Базовий шар', 'bazovyy-shar', 'Термобілизна, вологовідвідна', 4, 1, NOW(), NOW()),
(95, 9, 'Головні убори', 'golovni-ubory', 'Бейсболки, боні, бандани, балаклави, шемаги', 5, 1, NOW(), NOW()),
(96, 9, 'Взуття', 'vzuttya', 'Тактичні черевики, берці, літні/зимові', 6, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

-- 10. ЗВ'ЯЗОК
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(10, NULL, 'Зв\'язок', 'zvyazok', 'Рації, гарнітури, навушники', 10, 1, NOW(), NOW()),
(101, 10, 'Рації', 'ratsii', 'Baofeng UV-5R, Kenwood та інші', 1, 1, NOW(), NOW()),
(102, 10, 'Гарнітури', 'garnitury', 'Активні навушники, PTT кнопки', 2, 1, NOW(), NOW()),
(103, 10, 'Навушники-репліки', 'navushnyky', 'Comtac, Sordin, GSSH-01', 3, 1, NOW(), NOW()),
(104, 10, 'Адаптери та кріплення', 'adaptery-zvyazok', 'ARC Rail адаптери, перехідники', 4, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

-- 11. КАМУФЛЯЖ ТА МАСКУВАННЯ
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(11, NULL, 'Камуфляж та маскування', 'kamuflyazh', 'Маскхалати, гіллі-костюми, сітки', 11, 1, NOW(), NOW()),
(111, 11, 'Маскхалати / Гіллі', 'gilli', 'Повні, накидки, голова', 1, 1, NOW(), NOW()),
(112, 11, 'Маскувальні сітки', 'maskuvalni-sitky', 'Різні кольори та розміри', 2, 1, NOW(), NOW()),
(113, 11, 'Камуфляжні стрічки', 'kamuflyazhni-strichky', 'Тканинні, самоклеючі, фарби', 3, 1, NOW(), NOW()),
(114, 11, 'Чохли на зброю', 'chokhly-zbroyu', 'Камуфляжні обмотки, сітки', 4, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

-- 12. ІНСТРУМЕНТИ ТА ОБСЛУГОВУВАННЯ
INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(12, NULL, 'Інструменти та обслуговування', 'instrumenty', 'Мастила, інструменти, хронографи', 12, 1, NOW(), NOW()),
(121, 12, 'Мастила та силікон', 'mastyla', 'Силіконове масло, тефлонова змазка, WD-40', 1, 1, NOW(), NOW()),
(122, 12, 'Мультитули та інструменти', 'multytools', 'Ключі, викрутки, набори для приводів', 2, 1, NOW(), NOW()),
(123, 12, 'Хронографи', 'khronografy', 'Для заміру швидкості кулі (FPS)', 3, 1, NOW(), NOW()),
(124, 12, 'Мішені та пастки', 'misheni', 'Паперові, металеві, сітчасті пастки', 4, 1, NOW(), NOW()),
(125, 12, 'Кейси та чохли', 'keysy', 'Жорсткі кейси, м\'які чохли, ганбеги', 5, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `description` = VALUES(`description`), `parent_id` = VALUES(`parent_id`), `sort_order` = VALUES(`sort_order`);

SELECT '✓ Категорії 7-12 створено: Захист, Тактика, Одяг, Зв\'язок, Камуфляж, Інструменти' AS Status;

-- Продовження в наступному повідомленні...
-- ==========================================
-- ЧАСТИНА 3: АТРИБУТИ
-- ==========================================

-- ГЛОБАЛЬНІ АТРИБУТИ
INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Бренд', 'brand', 'select', '["Tokyo Marui", "G&G", "Cyma", "Specna Arms", "VFC", "E&L", "LCT", "ASG", "WE", "KWA", "Novritsch", "Modify", "Maple Leaf", "Prometheus", "FMA", "TMC", "Emerson", "Element", "WELL", "Double Eagle", "Nuprol", "Evolution", "Ares", "ICS", "Classic Army", "King Arms", "SRC", "JG", "BOLT", "GHK"]', 1, 1, 1, NOW(), NOW()),
(2, 'Країна виробника', 'country', 'select', '["Тайвань", "Китай", "Японія", "Гонконг", "Південна Корея", "США", "Інше"]', 2, 1, 1, NOW(), NOW()),
(3, 'Колір / Камуфляж', 'color-camo', 'select', '["Чорний", "Tan/Coyote/Пісочний", "Олива (OD Green)", "Ranger Green", "Мультикам", "Піксель ЗСУ", "Flecktarn", "A-TACS", "Жаба (Kryptek)", "Woodland", "Desert", "Сірий", "Білий"]', 3, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `type` = VALUES(`type`), `options` = VALUES(`options`), `sort_order` = VALUES(`sort_order`);

-- АТРИБУТИ ДЛЯ ПРИВОДІВ
INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(10, 'Тип приводу', 'drive-type', 'select', '["AEG (електричний)", "GBB (газовий)", "GBBR (газова гвинтівка)", "Spring (пружинний)", "HPA (високий тиск)", "CO2", "AEP (електричний пістолет)"]', 10, 1, 1, NOW(), NOW()),
(11, 'Платформа', 'platform', 'select', '["M4/M16/AR-15", "AK-47/AK-74", "G36", "MP5", "SCAR", "HK416", "M14", "G3", "FAL", "AUG", "P90", "UMP", "Kriss Vector", "L85/SA80", "SIG", "Tavor", "M249/M60", "PKM", "RPK", "VSS/AS VAL"]', 11, 1, 1, NOW(), NOW()),
(12, 'Матеріал корпусу', 'body-material', 'select', '["Повністю метал", "Метал + полімер", "Полімер/пластик", "Дерево + метал", "Алюміній", "Сталь"]', 12, 1, 1, NOW(), NOW()),
(13, 'Швидкість кулі (FPS)', 'fps', 'range', '["< 300", "300-350", "350-400", "400-450", "450-500", "500+"]', 13, 1, 1, NOW(), NOW()),
(14, 'Енергія (Джоулі)', 'joules', 'range', '["< 1.0", "1.0-1.5", "1.5-2.0", "2.0-2.5", "2.5+"]', 14, 1, 1, NOW(), NOW()),
(15, 'Тип акумулятора', 'battery-type', 'select', '["LiPo 7.4V", "LiPo 11.1V", "NiMH 8.4V", "NiMH 9.6V", "Li-Ion", "Не потрібен (газовий/пружинний)"]', 15, 1, 1, NOW(), NOW()),
(16, 'Довжина', 'length', 'select', '["Компактний (< 600мм)", "Середній (600-800мм)", "Повнорозмірний (800-1000мм)", "Довгий (> 1000мм)"]', 16, 1, 1, NOW(), NOW()),
(17, 'Hop-Up', 'hop-up', 'select', '["Регульований", "Нерегульований", "Напівавтоматичний"]', 17, 1, 1, NOW(), NOW()),
(18, 'Blowback', 'blowback', 'select', '["Є", "Немає"]', 18, 1, 1, NOW(), NOW()),
(19, 'Сторона', 'side', 'select', '["NATO", "Варшавський блок", "Інше"]', 19, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `type` = VALUES(`type`), `options` = VALUES(`options`), `sort_order` = VALUES(`sort_order`);

-- АТРИБУТИ ДЛЯ БОЄПРИПАСІВ
INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(20, 'Вага кулі', 'bb-weight', 'select', '["0.20г", "0.23г", "0.25г", "0.28г", "0.30г", "0.32г", "0.36г", "0.40г", "0.43г", "0.45г", "0.48г"]', 20, 1, 1, NOW(), NOW()),
(21, 'Тип кулі', 'bb-type', 'select', '["Звичайні", "БІО (біорозкладні)", "Трасерні", "Поліровані"]', 21, 1, 1, NOW(), NOW()),
(22, 'Колір кулі', 'bb-color', 'select', '["Білі", "Чорні", "Зелені (трасерні)", "Червоні (трасерні)"]', 22, 1, 1, NOW(), NOW()),
(23, 'Кількість в упаковці', 'bb-quantity', 'select', '["500", "1000", "2000", "2500", "3000", "4000", "5000", "Мішок (25кг)"]', 23, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `type` = VALUES(`type`), `options` = VALUES(`options`), `sort_order` = VALUES(`sort_order`);

-- АТРИБУТИ ДЛЯ АПГРЕЙДУ
INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(30, 'Сумісність (гірбокс)', 'gearbox-version', 'select', '["V2 (M4/M16)", "V3 (AK)", "V6 (P90)", "V7 (M14)", "V8 (SVD)", "Універсальний"]', 30, 1, 1, NOW(), NOW()),
(31, 'Тип деталі', 'part-type', 'select', '["Ствол внутрішній", "Пружина", "Мотор", "Hop-Up", "Електроніка/MOSFET", "Шестерні", "Поршень", "Циліндр", "Нозль", "Гірбокс", "Бушинг/підшипники"]', 31, 1, 1, NOW(), NOW()),
(32, 'Діаметр ствола', 'barrel-diameter', 'select', '["6.01мм", "6.03мм", "6.05мм", "6.08мм"]', 32, 1, 1, NOW(), NOW()),
(33, 'Матеріал деталі', 'part-material', 'select', '["Сталь", "Алюміній", "Латунь", "Полікарбонат", "Пластик", "Карбон"]', 33, 1, 1, NOW(), NOW()),
(34, 'Тип мотора', 'motor-type', 'select', '["High Speed", "High Torque", "Balanced", "Long", "Short"]', 34, 1, 1, NOW(), NOW()),
(35, 'Сила пружини', 'spring-power', 'select', '["M90", "M100", "M110", "M120", "M130", "M140", "M150", "M160", "M170", "M190"]', 35, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `type` = VALUES(`type`), `options` = VALUES(`options`), `sort_order` = VALUES(`sort_order`);

-- АТРИБУТИ ДЛЯ МАГАЗИНІВ
INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(40, 'Платформа магазину', 'mag-platform', 'select', '["M4/M16/AR-15", "AK-47/74", "G36", "MP5", "SCAR", "P90", "UMP", "Пістолетний", "Снайперський"]', 40, 1, 1, NOW(), NOW()),
(41, 'Тип магазину', 'mag-type', 'select', '["Mid-Cap (70-150 куль)", "Hi-Cap (300+ куль)", "Low-Cap (30-50 куль)", "Drum/Бункерний (500+ куль)", "Real-Cap"]', 41, 1, 1, NOW(), NOW()),
(42, 'Ємність магазину', 'mag-capacity', 'select', '["30-50 куль", "70-100 куль", "120-150 куль", "300-400 куль", "500+ куль"]', 42, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `type` = VALUES(`type`), `options` = VALUES(`options`), `sort_order` = VALUES(`sort_order`);

-- АТРИБУТИ ДЛЯ АКУМУЛЯТОРІВ
INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(50, 'Тип акумулятора', 'akb-type', 'select', '["LiPo", "NiMH", "Li-Ion"]', 50, 1, 1, NOW(), NOW()),
(51, 'Напруга', 'voltage', 'select', '["7.4V (2S)", "11.1V (3S)", "8.4V", "9.6V", "14.8V (4S)"]', 51, 1, 1, NOW(), NOW()),
(52, 'Ємність (mAh)', 'capacity', 'select', '["< 1000mAh", "1000-1500mAh", "1500-2000mAh", "2000-3000mAh", "3000+ mAh"]', 52, 1, 1, NOW(), NOW()),
(53, 'Форм-фактор', 'akb-form', 'select', '["Stick (паличка)", "Butterfly (метелик)", "PEQ box", "Crane stock", "Nunchuck", "Mini", "Large"]', 53, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `type` = VALUES(`type`), `options` = VALUES(`options`), `sort_order` = VALUES(`sort_order`);

-- АТРИБУТИ ДЛЯ ОПТИКИ
INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(60, 'Тип прицілу', 'sight-type', 'select', '["Коліматорний (Red Dot)", "Оптичний", "LPVO (зі змінною кратністю)", "Голографічний", "Лазерний цілевказівник", "Ліхтар"]', 60, 1, 1, NOW(), NOW()),
(61, 'Кратність', 'magnification', 'select', '["1x", "1-4x", "1-6x", "1-8x", "3-9x", "4x", "Фіксована", "Змінна"]', 61, 1, 1, NOW(), NOW()),
(62, 'Тип кріплення', 'mount-type', 'select', '["Weaver/Picatinny 20мм", "Dovetail 11мм", "Вбудоване"]', 62, 1, 1, NOW(), NOW()),
(63, 'Підсвітка сітки', 'reticle-light', 'select', '["Червона", "Зелена", "Червона+Зелена", "Без підсвітки"]', 63, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `type` = VALUES(`type`), `options` = VALUES(`options`), `sort_order` = VALUES(`sort_order`);

-- АТРИБУТИ ДЛЯ ЕКІПІРУВАННЯ ТА ОДЯГУ
INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(70, 'Розмір', 'size', 'select', '["XS", "S", "M", "L", "XL", "XXL", "XXXL", "Універсальний"]', 70, 1, 1, NOW(), NOW()),
(71, 'Матеріал тканини', 'fabric', 'select', '["Cordura", "Нейлон", "Поліестер", "Ripstop", "Бавовна", "Змішаний"]', 71, 1, 1, NOW(), NOW()),
(72, 'MOLLE-сумісність', 'molle', 'select', '["Так", "Ні"]', 72, 1, 1, NOW(), NOW()),
(73, 'Сезон', 'season', 'select', '["Літо", "Демісезон", "Зима", "Всесезонний"]', 73, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `slug` = VALUES(`slug`), `type` = VALUES(`type`), `options` = VALUES(`options`), `sort_order` = VALUES(`sort_order`);

SELECT '✓ Атрибути створено для всіх категорій товарів' AS Status;

-- ==========================================
-- ЧАСТИНА 4: SEO ОПТИМІЗАЦІЯ
-- ==========================================

-- SEO для основних категорій
UPDATE `categories` SET
    `meta_title` = 'Приводи для страйкболу — купити AEG, GBB, пружинні приводи в Україні',
    `meta_description` = 'Великий вибір страйкбольних приводів: автомати M4/AK, пістолети-кулемети, снайперські гвинтівки, пістолети. Доставка по Україні, гарантія якості.',
    `meta_keywords` = 'приводи страйкбол, aeg, gbb, airsoft gun, купити привод'
WHERE `slug` = 'pryvody';

UPDATE `categories` SET
    `meta_title` = 'Боєприпаси для страйкболу — кулі BB, газ, гранати',
    `meta_description` = 'Кулі BB різної ваги (0.20-0.40г), трасерні та БІО кулі, газ Green Gas/CO2, димові гранати для страйкболу.',
    `meta_keywords` = 'кулі bb, боєприпаси airsoft, green gas, co2, bio bb'
WHERE `slug` = 'boieprypasy';

UPDATE `categories` SET
    `meta_title` = 'Апгрейд та тюнінг приводів — запчастини для страйкболу',
    `meta_description` = 'Внутрішній та зовнішній апгрейд для страйкбольних приводів: гірбокси, мотори, стволи, hop-up, MOSFET, цівки, приклади.',
    `meta_keywords` = 'апгрейд привода, тюнінг airsoft, mosfet, hop up, гірбокс'
WHERE `slug` = 'apgreid';

UPDATE `categories` SET
    `meta_title` = 'Магазини для страйкбольних приводів — Mid-Cap, Hi-Cap',
    `meta_description` = 'Магазини для M4, AK, MP5, G36 та інших платформ. Mid-Cap, Hi-Cap, Drum магазини різної ємності.',
    `meta_keywords` = 'магазини airsoft, mid cap, hi cap, магазини m4, магазини ak'
WHERE `slug` = 'magazyny';

UPDATE `categories` SET
    `meta_title` = 'Акумулятори та зарядні для страйкболу — LiPo, NiMH',
    `meta_description` = 'LiPo акумулятори 7.4V/11.1V, NiMH 8.4V/9.6V, розумні зарядні пристрої IMAX B6, LiPo-safe мішки.',
    `meta_keywords` = 'lipo акумулятор, nimh, зарядка lipo, imax b6'
WHERE `slug` = 'akumulyatory';

UPDATE `categories` SET
    `meta_title` = 'Оптика та прицільні пристрої — коліматори, оптичні приціли',
    `meta_description` = 'Коліматорні приціли Red Dot, оптичні приціли 1-4x/3-9x, LPVO, тактичні ліхтарі, лазерні цілевказівники для страйкболу.',
    `meta_keywords` = 'коліматор, red dot, оптичний приціл, lpvo, тактичний ліхтар'
WHERE `slug` = 'optyka';

UPDATE `categories` SET
    `meta_title` = 'Захисне спорядження — маски, окуляри, шоломи для страйкболу',
    `meta_description` = 'Балістичні окуляри, повнолицьові маски, тактичні шоломи FAST/MICH, наколінники, налокітники, рукавички для страйкболу.',
    `meta_keywords` = 'маска страйкбол, балістичні окуляри, шолом fast, захист'
WHERE `slug` = 'zakhyst';

UPDATE `categories` SET
    `meta_title` = 'Тактичне спорядження — плейт-керієри, підсумки, розвантажувальні системи',
    `meta_description` = 'Плейт-керієри JPC/CPC, чест-ріги, розвантажувальні жилети, підсумки MOLLE, тактичні пояси, ремені зброї.',
    `meta_keywords` = 'плейт керієр, chest rig, підсумки molle, розвантажувальний жилет'
WHERE `slug` = 'taktychne-sporyadzhennya';

UPDATE `categories` SET
    `meta_title` = 'Тактичний одяг та взуття — камуфляж, штани, куртки',
    `meta_description` = 'Камуфляжний одяг Мультикам, Піксель ЗСУ: куртки, штани, комплекти. Тактичні черевики, берці, термобілизна.',
    `meta_keywords` = 'камуфляж мультикам, тактичні штани, військові черевики, піксель зсу'
WHERE `slug` = 'odyag';

UPDATE `categories` SET
    `meta_title` = 'Рації та зв\'язок — Baofeng, гарнітури, PTT для страйкболу',
    `meta_description` = 'Рації Baofeng UV-5R, Kenwood, тактичні гарнітури Comtac/Sordin репліки, PTT кнопки, адаптери для шоломів.',
    `meta_keywords` = 'рація baofeng, тактична гарнітура, comtac, ptt кнопка'
WHERE `slug` = 'zvyazok';

UPDATE `categories` SET
    `meta_title` = 'Камуфляж та маскування — гіллі-костюми, маскувальні сітки',
    `meta_description` = 'Маскхалати гіллі, маскувальні сітки, камуфляжні стрічки та фарби, чохли на зброю для маскування.',
    `meta_keywords` = 'гіллі костюм, маскхалат, маскувальна сітка'
WHERE `slug` = 'kamuflyazh';

UPDATE `categories` SET
    `meta_title` = 'Інструменти та обслуговування — силікон, хронографи, чохли',
    `meta_description` = 'Силіконові мастила, мультитули, хронографи для заміру FPS, мішені, кейси та чохли для зброї.',
    `meta_keywords` = 'силікон для привода, хронограф, кейс для зброї, чохол'
WHERE `slug` = 'instrumenty';

-- Додаткові SEO сторінки
INSERT INTO `seo_pages` (`page_key`, `page_name`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `created_at`, `updated_at`) VALUES
('catalog', 'Каталог товарів', 'Каталог страйкбольного обладнання — Strikeball Shop', 'Повний каталог товарів для страйкболу: приводи, обладнання, одяг, тактика. Доставка по Україні.', 'каталог страйкбол, airsoft україна', 1, NOW(), NOW()),
('novynky', 'Новинки', 'Новинки страйкболу — Strikeball Shop', 'Нові надходження страйкбольного обладнання та приводів. Будьте в курсі останніх новинок!', 'новинки airsoft, нові приводи', 1, NOW(), NOW()),
('top-sales', 'ТОП продажів', 'ТОП продажів — найпопулярніші товари Strikeball Shop', 'Найпопулярніші товари для страйкболу за останній місяць. Перевірена якість!', 'топ продажів airsoft, популярні приводи', 1, NOW(), NOW()),
('sale', 'Акції та знижки', 'Акції та знижки на страйкбол — Strikeball Shop', 'Спеціальні пропозиції та знижки на страйкбольне обладнання. Вигідні ціни!', 'знижки airsoft, акції страйкбол, розпродаж', 1, NOW(), NOW()),
('beginner', 'Набори новачка', 'Набори для новачків — готові комплекти для страйкболу', 'Готові набори для новачків: привід + акумулятор + зарядка + маска + кулі. Різні цінові категорії.', 'набір новачка airsoft, стартовий комплект', 1, NOW(), NOW()),
('faq', 'Питання та відповіді', 'Часті питання — FAQ Strikeball Shop', 'Відповіді на часті питання про доставку, оплату, гарантію, підбір обладнання для страйкболу.', 'faq airsoft, питання страйкбол', 1, NOW(), NOW()),
('blog', 'Блог та гайди', 'Блог — статті та гайди про страйкбол', 'Корисні статті, гайди та огляди про страйкбол: як обрати привід, апгрейд для новачків, правила гри.', 'блог airsoft, гайди страйкбол, огляди приводів', 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `meta_title` = VALUES(`meta_title`),
    `meta_description` = VALUES(`meta_description`),
    `meta_keywords` = VALUES(`meta_keywords`),
    `updated_at` = NOW();

SELECT '✓ SEO оптимізація завершена' AS Status;

-- ==========================================
-- ФІНАЛЬНА СТАТИСТИКА
-- ==========================================

SET FOREIGN_KEY_CHECKS = 1;

SELECT '===========================================' AS '';
SELECT '✓✓✓ УСТАНОВКА ЗАВЕРШЕНА! ✓✓✓' AS '';
SELECT '===========================================' AS '';

SELECT COUNT(*) AS 'Всього категорій' FROM `categories`;
SELECT COUNT(*) AS 'Головних категорій' FROM `categories` WHERE `parent_id` IS NULL;
SELECT COUNT(*) AS 'Підкатегорій' FROM `categories` WHERE `parent_id` IS NOT NULL;
SELECT COUNT(*) AS 'Всього атрибутів' FROM `attributes`;
SELECT COUNT(*) AS 'SEO сторінок' FROM `seo_pages`;

SELECT '===========================================' AS '';
SELECT 'Структура магазину готова до використання!' AS '';
SELECT 'Наступні кроки:' AS '';
SELECT '1. Додайте бренди через адмін-панель' AS '';
SELECT '2. Прив\'яжіть атрибути до категорій' AS '';
SELECT '3. Почніть додавати товари!' AS '';
SELECT '===========================================' AS '';
