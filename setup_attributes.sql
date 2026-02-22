-- ==========================================
-- АТРИБУТИ ТА ФІЛЬТРИ
-- ==========================================

-- ==========================================
-- ГЛОБАЛЬНІ АТРИБУТИ (для всіх категорій)
-- ==========================================

INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
-- Бренд
(1, 'Бренд', 'brand', 'select', '["Tokyo Marui", "G&G", "Cyma", "Specna Arms", "VFC", "E&L", "LCT", "ASG", "WE", "KWA", "Novritsch", "Modify", "Maple Leaf", "Prometheus", "FMA", "TMC", "Emerson", "Element", "WELL", "Double Eagle", "Nuprol", "Evolution", "Ares", "ICS", "Classic Army", "King Arms", "SRC", "JG", "BOLT", "GHK"]', 1, 1, 1, NOW(), NOW()),
-- Країна виробника
(2, 'Країна виробника', 'country', 'select', '["Тайвань", "Китай", "Японія", "Гонконг", "Південна Корея", "США", "Інше"]', 2, 1, 1, NOW(), NOW()),
-- Колір/Камуфляж (універсальний)
(3, 'Колір / Камуфляж', 'color-camo', 'select', '["Чорний", "Tan/Coyote/Пісочний", "Олива (OD Green)", "Ranger Green", "Мультикам", "Піксель ЗСУ", "Flecktarn", "A-TACS", "Жаба (Kryptek)", "Woodland", "Desert", "Сірий", "Білий"]', 3, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `type` = VALUES(`type`),
    `options` = VALUES(`options`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- АТРИБУТИ ДЛЯ ПРИВОДІВ
-- ==========================================

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
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `type` = VALUES(`type`),
    `options` = VALUES(`options`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- АТРИБУТИ ДЛЯ БОЄПРИПАСІВ
-- ==========================================

INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(20, 'Вага кулі', 'bb-weight', 'select', '["0.20г", "0.23г", "0.25г", "0.28г", "0.30г", "0.32г", "0.36г", "0.40г", "0.43г", "0.45г", "0.48г"]', 20, 1, 1, NOW(), NOW()),
(21, 'Тип кулі', 'bb-type', 'select', '["Звичайні", "БІО (біорозкладні)", "Трасерні", "Поліровані"]', 21, 1, 1, NOW(), NOW()),
(22, 'Колір кулі', 'bb-color', 'select', '["Білі", "Чорні", "Зелені (трасерні)", "Червоні (трасерні)"]', 22, 1, 1, NOW(), NOW()),
(23, 'Кількість в упаковці', 'bb-quantity', 'select', '["500", "1000", "2000", "2500", "3000", "4000", "5000", "Мішок (25кг)"]', 23, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `type` = VALUES(`type`),
    `options` = VALUES(`options`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- АТРИБУТИ ДЛЯ АПГРЕЙДУ
-- ==========================================

INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(30, 'Сумісність (гірбокс)', 'gearbox-version', 'select', '["V2 (M4/M16)", "V3 (AK)", "V6 (P90)", "V7 (M14)", "V8 (SVD)", "Універсальний"]', 30, 1, 1, NOW(), NOW()),
(31, 'Тип деталі', 'part-type', 'select', '["Ствол внутрішній", "Пружина", "Мотор", "Hop-Up", "Електроніка/MOSFET", "Шестерні", "Поршень", "Циліндр", "Нозль", "Гірбокс", "Бушинг/підшипники"]', 31, 1, 1, NOW(), NOW()),
(32, 'Діаметр ствола', 'barrel-diameter', 'select', '["6.01мм", "6.03мм", "6.05мм", "6.08мм"]', 32, 1, 1, NOW(), NOW()),
(33, 'Матеріал деталі', 'part-material', 'select', '["Сталь", "Алюміній", "Латунь", "Полікарбонат", "Пластик", "Карбон"]', 33, 1, 1, NOW(), NOW()),
(34, 'Тип мотора', 'motor-type', 'select', '["High Speed", "High Torque", "Balanced", "Long", "Short"]', 34, 1, 1, NOW(), NOW()),
(35, 'Сила пружини', 'spring-power', 'select', '["M90", "M100", "M110", "M120", "M130", "M140", "M150", "M160", "M170", "M190"]', 35, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `type` = VALUES(`type`),
    `options` = VALUES(`options`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- АТРИБУТИ ДЛЯ МАГАЗИНІВ
-- ==========================================

INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(40, 'Платформа магазину', 'mag-platform', 'select', '["M4/M16/AR-15", "AK-47/74", "G36", "MP5", "SCAR", "P90", "UMP", "Пістолетний", "Снайперський"]', 40, 1, 1, NOW(), NOW()),
(41, 'Тип магазину', 'mag-type', 'select', '["Mid-Cap (70-150 куль)", "Hi-Cap (300+ куль)", "Low-Cap (30-50 куль)", "Drum/Бункерний (500+ куль)", "Real-Cap"]', 41, 1, 1, NOW(), NOW()),
(42, 'Ємність магазину', 'mag-capacity', 'select', '["30-50 куль", "70-100 куль", "120-150 куль", "300-400 куль", "500+ куль"]', 42, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `type` = VALUES(`type`),
    `options` = VALUES(`options`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- АТРИБУТИ ДЛЯ АКУМУЛЯТОРІВ
-- ==========================================

INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(50, 'Тип акумулятора', 'akb-type', 'select', '["LiPo", "NiMH", "Li-Ion"]', 50, 1, 1, NOW(), NOW()),
(51, 'Напруга', 'voltage', 'select', '["7.4V (2S)", "11.1V (3S)", "8.4V", "9.6V", "14.8V (4S)"]', 51, 1, 1, NOW(), NOW()),
(52, 'Ємність (mAh)', 'capacity', 'select', '["< 1000mAh", "1000-1500mAh", "1500-2000mAh", "2000-3000mAh", "3000+ mAh"]', 52, 1, 1, NOW(), NOW()),
(53, 'Форм-фактор', 'akb-form', 'select', '["Stick (паличка)", "Butterfly (метелик)", "PEQ box", "Crane stock", "Nunchuck", "Mini", "Large"]', 53, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `type` = VALUES(`type`),
    `options` = VALUES(`options`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- АТРИБУТИ ДЛЯ ОПТИКИ
-- ==========================================

INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(60, 'Тип прицілу', 'sight-type', 'select', '["Коліматорний (Red Dot)", "Оптичний", "LPVO (зі змінною кратністю)", "Голографічний", "Лазерний цілевказівник", "Ліхтар"]', 60, 1, 1, NOW(), NOW()),
(61, 'Кратність', 'magnification', 'select', '["1x", "1-4x", "1-6x", "1-8x", "3-9x", "4x", "Фіксована", "Змінна"]', 61, 1, 1, NOW(), NOW()),
(62, 'Тип кріплення', 'mount-type', 'select', '["Weaver/Picatinny 20мм", "Dovetail 11мм", "Вбудоване"]', 62, 1, 1, NOW(), NOW()),
(63, 'Підсвітка сітки', 'reticle-light', 'select', '["Червона", "Зелена", "Червона+Зелена", "Без підсвітки"]', 63, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `type` = VALUES(`type`),
    `options` = VALUES(`options`),
    `sort_order` = VALUES(`sort_order`);

-- ==========================================
-- АТРИБУТИ ДЛЯ ЕКІПІРУВАННЯ ТА ОДЯГУ
-- ==========================================

INSERT INTO `attributes` (`id`, `name`, `slug`, `type`, `options`, `sort_order`, `is_filterable`, `is_active`, `created_at`, `updated_at`) VALUES
(70, 'Розмір', 'size', 'select', '["XS", "S", "M", "L", "XL", "XXL", "XXXL", "Універсальний"]', 70, 1, 1, NOW(), NOW()),
(71, 'Матеріал тканини', 'fabric', 'select', '["Cordura", "Нейлон", "Поліестер", "Ripstop", "Бавовна", "Змішаний"]', 71, 1, 1, NOW(), NOW()),
(72, 'MOLLE-сумісність', 'molle', 'select', '["Так", "Ні"]', 72, 1, 1, NOW(), NOW()),
(73, 'Сезон', 'season', 'select', '["Літо", "Демісезон", "Зима", "Всесезонний"]', 73, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `slug` = VALUES(`slug`),
    `type` = VALUES(`type`),
    `options` = VALUES(`options`),
    `sort_order` = VALUES(`sort_order`);

SELECT '✓ Створено атрибути для всіх категорій товарів' AS Status;
SELECT '✓ Глобальні, Приводи, Боєприпаси, Апгрейд, Магазини, Акумулятори, Оптика, Екіпірування' AS Info;
