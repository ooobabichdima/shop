<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create customer user
        User::create([
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        // Create brands
        $cyma = Brand::create(['name' => 'CYMA', 'slug' => 'cyma', 'is_active' => true]);
        $gg = Brand::create(['name' => 'G&G', 'slug' => 'gg', 'is_active' => true]);
        $tm = Brand::create(['name' => 'Tokyo Marui', 'slug' => 'tokyo-marui', 'is_active' => true]);
        $specna = Brand::create(['name' => 'Specna Arms', 'slug' => 'specna-arms', 'is_active' => true]);
        $asahi = Brand::create(['name' => 'ASG', 'slug' => 'asg', 'is_active' => true]);

        // Create categories
        $drives = Category::create(['name' => 'Приводи', 'slug' => 'drives', 'sort_order' => 1]);
        $magazines = Category::create(['name' => 'Магазини', 'slug' => 'magazines', 'sort_order' => 2]);
        $bbs = Category::create(['name' => 'Кульки (BBs)', 'slug' => 'bbs', 'sort_order' => 3]);
        $batteries = Category::create(['name' => 'Акумулятори', 'slug' => 'batteries', 'sort_order' => 4]);
        $chargers = Category::create(['name' => 'Зарядки', 'slug' => 'chargers', 'sort_order' => 5]);
        $protection = Category::create(['name' => 'Захист', 'slug' => 'protection', 'sort_order' => 6]);
        $tuning = Category::create(['name' => 'Тюнінг', 'slug' => 'tuning', 'sort_order' => 7]);

        // Create attributes
        Attribute::create(['code' => 'platform', 'name' => 'Платформа', 'type' => 'string', 'is_filterable' => true]);
        Attribute::create(['code' => 'fps', 'name' => 'FPS', 'type' => 'number', 'is_filterable' => true]);
        Attribute::create(['code' => 'type', 'name' => 'Тип', 'type' => 'string', 'is_filterable' => true]);
        Attribute::create(['code' => 'material', 'name' => 'Матеріал', 'type' => 'string', 'is_filterable' => true]);
        Attribute::create(['code' => 'capacity', 'name' => 'Ємність', 'type' => 'number', 'is_filterable' => true]);
        Attribute::create(['code' => 'voltage', 'name' => 'Напруга', 'type' => 'string', 'is_filterable' => true]);

        // === ПРИВОДИ (15 товарів) ===
        $products = [];

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $cyma->id,
            'name' => 'AEG M4 RIS CQB (CYMA CM.513)',
            'slug' => 'aeg-m4-ris-cqb-cyma',
            'sku' => 'DRV-M4-001',
            'description' => 'Компактний M4 для CQB. Надійний металевий гірбокс, регульований приклад, планки RIS.',
            'price' => 9990,
            'old_price' => 10990,
            'stock' => 12,
            'is_active' => true,
            'is_featured' => true,
            'is_new' => false,
            'rating' => 4.8,
            'reviews_count' => 126,
            'specs' => ['fps' => '100-110 м/с', 'length' => '680-750 мм', 'weight' => '2.6 кг'],
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $gg->id,
            'name' => 'AEG M4 Raider (G&G CM16)',
            'slug' => 'aeg-m4-raider-gg',
            'sku' => 'DRV-M4-002',
            'description' => 'Популярна модель від G&G. Полімерний корпус, легка, точна. Ідеально для новачків.',
            'price' => 11500,
            'stock' => 8,
            'is_active' => true,
            'is_featured' => true,
            'is_new' => false,
            'rating' => 4.9,
            'reviews_count' => 204,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $tm->id,
            'name' => 'AEG AK-74M (Tokyo Marui)',
            'slug' => 'aeg-ak74m-tm',
            'sku' => 'DRV-AK-001',
            'description' => 'Класична AK-74M від Tokyo Marui. Преміум якість, стабільна компресія, легендарна надійність.',
            'price' => 15900,
            'old_price' => 17500,
            'stock' => 5,
            'is_active' => true,
            'is_featured' => false,
            'is_new' => true,
            'rating' => 5.0,
            'reviews_count' => 89,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $specna->id,
            'name' => 'AEG SA-H01 (Specna Arms)',
            'slug' => 'aeg-sah01-specna',
            'sku' => 'DRV-M4-003',
            'description' => 'Specna Arms EDGE серія. Вбудований MOSFET, швидкісна пружина M100, відмінний baсhout.',
            'price' => 13200,
            'stock' => 10,
            'is_active' => true,
            'is_featured' => true,
            'is_new' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $cyma->id,
            'name' => 'AEG MP5A5 (CYMA CM.041)',
            'slug' => 'aeg-mp5a5-cyma',
            'sku' => 'DRV-MP5-001',
            'description' => 'Легендарний MP5. Компакт, зручний для CQB, металевий корпус.',
            'price' => 8800,
            'stock' => 15,
            'is_active' => true,
            'is_featured' => false,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $asahi->id,
            'name' => 'GBB Glock 17 (ASG)',
            'slug' => 'gbb-glock17-asg',
            'sku' => 'DRV-PIST-001',
            'description' => 'Gas Blowback пістолет. Реалістична віддача, металеві деталі.',
            'price' => 5500,
            'stock' => 22,
            'is_active' => true,
            'is_new' => false,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $gg->id,
            'name' => 'AEG SR-25 DMR (G&G)',
            'slug' => 'aeg-sr25-dmr-gg',
            'sku' => 'DRV-DMR-001',
            'description' => 'Снайперська платформа SR-25. Довгий ствол, точність, для дальнього бою.',
            'price' => 17900,
            'stock' => 3,
            'is_active' => true,
            'is_new' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $cyma->id,
            'name' => 'AEG AKS-74U (CYMA CM.045)',
            'slug' => 'aeg-aks74u-cyma',
            'sku' => 'DRV-AK-002',
            'description' => 'Короткоствольна AK. Компакт для CQB, металевий корпус, швидкість до 100 м/с.',
            'price' => 8500,
            'stock' => 18,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $tm->id,
            'name' => 'GBB M1911 MEU (Tokyo Marui)',
            'slug' => 'gbb-m1911-tm',
            'sku' => 'DRV-PIST-002',
            'description' => 'Класичний 1911 від Tokyo Marui. Преміум GBB, стабільна віддача.',
            'price' => 6800,
            'stock' => 14,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $specna->id,
            'name' => 'AEG SA-C10 CORE (Specna Arms)',
            'slug' => 'aeg-sac10-specna',
            'sku' => 'DRV-M4-004',
            'description' => 'Бюджетна серія CORE. Хороша база для апгрейду, полімерний корпус.',
            'price' => 7900,
            'stock' => 25,
            'is_active' => true,
            'is_featured' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $gg->id,
            'name' => 'AEG M4 CQB-R (G&G CM16)',
            'slug' => 'aeg-m4-cqbr-gg',
            'sku' => 'DRV-M4-005',
            'description' => 'CQB версія з коротким стволом. RIS планки, регульований приклад.',
            'price' => 10900,
            'stock' => 9,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $cyma->id,
            'name' => 'AEG PKM (CYMA)',
            'slug' => 'aeg-pkm-cyma',
            'sku' => 'DRV-LMG-001',
            'description' => 'Кулемет PKM. Коробчатий магазин 2500 куль, важкий, для підтримки.',
            'price' => 14500,
            'stock' => 2,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $asahi->id,
            'name' => 'AEG Scorpion EVO 3 (ASG)',
            'slug' => 'aeg-scorpion-evo3-asg',
            'sku' => 'DRV-SMG-001',
            'description' => 'SMG Scorpion EVO 3. Висока швидкострільність, компактний, для CQB.',
            'price' => 16900,
            'stock' => 4,
            'is_active' => true,
            'is_new' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $tm->id,
            'name' => 'AEG M4A1 MWS (Tokyo Marui)',
            'slug' => 'aeg-m4a1-mws-tm',
            'sku' => 'DRV-M4-006',
            'description' => 'Топова модель M4A1. Реалістичний blowback, преміум якість.',
            'price' => 19900,
            'stock' => 3,
            'is_active' => true,
            'is_featured' => true,
            'is_new' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $drives->id,
            'brand_id' => $gg->id,
            'name' => 'AEG ARP-9 (G&G)',
            'slug' => 'aeg-arp9-gg',
            'sku' => 'DRV-SMG-002',
            'description' => 'Короткий AR платформа. 9mm магазини, MOSFET, легкий.',
            'price' => 12500,
            'stock' => 7,
            'is_active' => true,
        ]);

        // === МАГАЗИНИ (10 товарів) ===
        $products[] = Product::create([
            'category_id' => $magazines->id,
            'brand_id' => $cyma->id,
            'name' => 'Магазин M4 Mid-cap 140bb (CYMA)',
            'slug' => 'mag-m4-midcap-140-cyma',
            'sku' => 'MAG-M4-001',
            'description' => 'Mid-cap на 140 куль. Не гремить, стабільна подача.',
            'price' => 390,
            'stock' => 120,
            'is_active' => true,
            'is_featured' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $magazines->id,
            'brand_id' => $gg->id,
            'name' => 'Магазин M4 Hi-cap 300bb (G&G)',
            'slug' => 'mag-m4-hicap-300-gg',
            'sku' => 'MAG-M4-002',
            'description' => 'Hi-cap на 300 куль. Заводський механізм.',
            'price' => 450,
            'stock' => 85,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $magazines->id,
            'brand_id' => $cyma->id,
            'name' => 'Магазин AK Mid-cap 150bb (CYMA)',
            'slug' => 'mag-ak-midcap-150-cyma',
            'sku' => 'MAG-AK-001',
            'description' => 'Mid-cap для AK платформи. 150 куль.',
            'price' => 410,
            'stock' => 95,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $magazines->id,
            'brand_id' => $asahi->id,
            'name' => 'Магазин Glock 50bb (ASG)',
            'slug' => 'mag-glock-50-asg',
            'sku' => 'MAG-PIST-001',
            'description' => 'Gas магазин для Glock. 50 куль.',
            'price' => 890,
            'stock' => 45,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $magazines->id,
            'brand_id' => $specna->id,
            'name' => 'Магазин M4 Flash 360bb (Specna)',
            'slug' => 'mag-m4-flash-360-specna',
            'sku' => 'MAG-M4-003',
            'description' => 'Flash-mag на 360 куль. Швидка подача.',
            'price' => 750,
            'stock' => 60,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $magazines->id,
            'brand_id' => $cyma->id,
            'name' => 'Магазин MP5 Hi-cap 200bb (CYMA)',
            'slug' => 'mag-mp5-hicap-200-cyma',
            'sku' => 'MAG-MP5-001',
            'description' => 'Hi-cap для MP5. 200 куль.',
            'price' => 420,
            'stock' => 70,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $magazines->id,
            'brand_id' => $tm->id,
            'name' => 'Магазин M1911 Gas 26bb (Tokyo Marui)',
            'slug' => 'mag-m1911-gas-26-tm',
            'sku' => 'MAG-PIST-002',
            'description' => 'Gas магазин для M1911. 26 куль.',
            'price' => 1050,
            'stock' => 30,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $magazines->id,
            'brand_id' => $gg->id,
            'name' => 'Магазин ARP-9 60bb (G&G)',
            'slug' => 'mag-arp9-60-gg',
            'sku' => 'MAG-SMG-001',
            'description' => 'Mid-cap для ARP-9. 60 куль.',
            'price' => 480,
            'stock' => 50,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $magazines->id,
            'brand_id' => $cyma->id,
            'name' => 'Барабан PKM 2500bb (CYMA)',
            'slug' => 'mag-pkm-drum-2500-cyma',
            'sku' => 'MAG-LMG-001',
            'description' => 'Коробчатий барабан для PKM. 2500 куль.',
            'price' => 1890,
            'stock' => 8,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $magazines->id,
            'brand_id' => $asahi->id,
            'name' => 'Магазин Scorpion EVO 75bb (ASG)',
            'slug' => 'mag-scorpion-75-asg',
            'sku' => 'MAG-SMG-002',
            'description' => 'Mid-cap для Scorpion EVO. 75 куль.',
            'price' => 650,
            'stock' => 40,
            'is_active' => true,
        ]);

        // === КУЛЬКИ (5 товарів) ===
        $products[] = Product::create([
            'category_id' => $bbs->id,
            'brand_id' => null,
            'name' => 'Кульки 0.20г (1кг)',
            'slug' => 'bbs-020g-1kg',
            'sku' => 'BBS-020-1',
            'description' => 'Універсальні кульки 0.20г. Білі, поліровані. 1 кг (5000 шт).',
            'price' => 290,
            'stock' => 200,
            'is_active' => true,
            'is_featured' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $bbs->id,
            'brand_id' => null,
            'name' => 'Кульки 0.25г (1кг)',
            'slug' => 'bbs-025g-1kg',
            'sku' => 'BBS-025-1',
            'description' => 'Оптимальні для CQB. 0.25г. Білі, точність. 1 кг (4000 шт).',
            'price' => 390,
            'stock' => 180,
            'is_active' => true,
            'is_featured' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $bbs->id,
            'brand_id' => null,
            'name' => 'Кульки 0.28г (1кг)',
            'slug' => 'bbs-028g-1kg',
            'sku' => 'BBS-028-1',
            'description' => 'Для дальнього бою. 0.28г. Важчі, стабільніша траєкторія.',
            'price' => 450,
            'stock' => 140,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $bbs->id,
            'brand_id' => null,
            'name' => 'Кульки 0.30г BIO (1кг)',
            'slug' => 'bbs-030g-bio-1kg',
            'sku' => 'BBS-030-BIO',
            'description' => 'Біорозкладні кульки 0.30г. Екологічні. Для лісу.',
            'price' => 590,
            'stock' => 90,
            'is_active' => true,
            'is_new' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $bbs->id,
            'brand_id' => null,
            'name' => 'Кульки 0.32г Sniper (500г)',
            'slug' => 'bbs-032g-sniper-500g',
            'sku' => 'BBS-032-SNP',
            'description' => 'Снайперські кульки 0.32г. Преміум якість, полірування.',
            'price' => 480,
            'stock' => 65,
            'is_active' => true,
        ]);

        // === АКУМУЛЯТОРИ (5 товарів) ===
        $products[] = Product::create([
            'category_id' => $batteries->id,
            'brand_id' => null,
            'name' => 'LiPo 7.4V 1200mAh (T-Dean)',
            'slug' => 'lipo-74v-1200-tdean',
            'sku' => 'BAT-LIPO-001',
            'description' => 'LiPo батарея 7.4V 1200mAh. Роз\'єм T-Dean. Для CQB.',
            'price' => 790,
            'stock' => 55,
            'is_active' => true,
            'is_featured' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $batteries->id,
            'brand_id' => null,
            'name' => 'LiPo 11.1V 1500mAh (T-Dean)',
            'slug' => 'lipo-111v-1500-tdean',
            'sku' => 'BAT-LIPO-002',
            'description' => 'LiPo 11.1V 1500mAh. Висока швидкострільність. T-Dean.',
            'price' => 990,
            'stock' => 42,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $batteries->id,
            'brand_id' => null,
            'name' => 'NiMh 8.4V 1600mAh (Tamiya)',
            'slug' => 'nimh-84v-1600-tamiya',
            'sku' => 'BAT-NIMH-001',
            'description' => 'NiMh батарея 8.4V 1600mAh. Tamiya. Безпечна.',
            'price' => 550,
            'stock' => 70,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $batteries->id,
            'brand_id' => null,
            'name' => 'LiPo 7.4V 2000mAh Compact',
            'slug' => 'lipo-74v-2000-compact',
            'sku' => 'BAT-LIPO-003',
            'description' => 'Компактна LiPo 7.4V 2000mAh. Довга робота.',
            'price' => 890,
            'stock' => 38,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $batteries->id,
            'brand_id' => null,
            'name' => 'LiPo 11.1V 2200mAh Crane Stock',
            'slug' => 'lipo-111v-2200-crane',
            'sku' => 'BAT-LIPO-004',
            'description' => 'LiPo 11.1V 2200mAh для Crane stock. Висока ємність.',
            'price' => 1190,
            'stock' => 25,
            'is_active' => true,
            'is_new' => true,
        ]);

        // === ЗАРЯДКИ (3 товари) ===
        $products[] = Product::create([
            'category_id' => $chargers->id,
            'brand_id' => null,
            'name' => 'Зарядка Smart LiPo/Li-Ion',
            'slug' => 'charger-smart-lipo',
            'sku' => 'CHG-SMART-001',
            'description' => 'Smart зарядка для LiPo/Li-Ion. Балансування, захист від перезарядки.',
            'price' => 1290,
            'stock' => 48,
            'is_active' => true,
            'is_featured' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $chargers->id,
            'brand_id' => null,
            'name' => 'Зарядка NiMh/NiCd Standard',
            'slug' => 'charger-nimh-standard',
            'sku' => 'CHG-NIMH-001',
            'description' => 'Стандартна зарядка для NiMh/NiCd. Проста, надійна.',
            'price' => 490,
            'stock' => 65,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $chargers->id,
            'brand_id' => null,
            'name' => 'Зарядка Universal Multi-type',
            'slug' => 'charger-universal',
            'sku' => 'CHG-UNI-001',
            'description' => 'Універсальна зарядка. LiPo, NiMh, NiCd. LCD дисплей.',
            'price' => 1890,
            'stock' => 22,
            'is_active' => true,
            'is_new' => true,
        ]);

        // === ЗАХИСТ (5 товарів) ===
        $products[] = Product::create([
            'category_id' => $protection->id,
            'brand_id' => null,
            'name' => 'Окуляри захисні (прозорі)',
            'slug' => 'goggles-clear',
            'sku' => 'PROT-GOGG-001',
            'description' => 'Захисні окуляри з полікарбонату. Прозорі лінзи, анти-фог.',
            'price' => 590,
            'stock' => 110,
            'is_active' => true,
            'is_featured' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $protection->id,
            'brand_id' => null,
            'name' => 'Маска Mesh (повнолицьова)',
            'slug' => 'mask-mesh-full',
            'sku' => 'PROT-MASK-001',
            'description' => 'Металева mesh маска. Повнолицьова, захист обличчя.',
            'price' => 890,
            'stock' => 75,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $protection->id,
            'brand_id' => null,
            'name' => 'Шолом Fast Tactical',
            'slug' => 'helmet-fast',
            'sku' => 'PROT-HELM-001',
            'description' => 'Тактичний шолом Fast. ABS пластик, регульований.',
            'price' => 1490,
            'stock' => 32,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $protection->id,
            'brand_id' => null,
            'name' => 'Рукавички тактичні (full finger)',
            'slug' => 'gloves-tactical-full',
            'sku' => 'PROT-GLOV-001',
            'description' => 'Тактичні рукавички full finger. Захист кісточок.',
            'price' => 690,
            'stock' => 95,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $protection->id,
            'brand_id' => null,
            'name' => 'Плитоноска (універсальна)',
            'slug' => 'plate-carrier-universal',
            'sku' => 'PROT-PLAT-001',
            'description' => 'Універсальна плитоноска. MOLLE система, регульована.',
            'price' => 2790,
            'stock' => 18,
            'is_active' => true,
        ]);

        // === ТЮНІНГ (7 товарів) ===
        $products[] = Product::create([
            'category_id' => $tuning->id,
            'brand_id' => null,
            'name' => 'Резинка Hop-Up (універсальна)',
            'slug' => 'hopup-rubber-universal',
            'sku' => 'TUN-HOP-001',
            'description' => 'Універсальна резинка hop-up. Покращує стабільність.',
            'price' => 280,
            'stock' => 150,
            'is_active' => true,
            'is_featured' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $tuning->id,
            'brand_id' => null,
            'name' => 'Нуб Hop-Up (твердий)',
            'slug' => 'hopup-nub-hard',
            'sku' => 'TUN-NUB-001',
            'description' => 'Твердий нуб для hop-up. Підвищує точність.',
            'price' => 190,
            'stock' => 120,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $tuning->id,
            'brand_id' => null,
            'name' => 'Набір шестерень (High Speed)',
            'slug' => 'gears-highspeed',
            'sku' => 'TUN-GEAR-001',
            'description' => 'High Speed шестерні. Підвищена швидкострільність.',
            'price' => 1290,
            'stock' => 35,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $tuning->id,
            'brand_id' => null,
            'name' => 'Набір шестерень (High Torque)',
            'slug' => 'gears-hightorque',
            'sku' => 'TUN-GEAR-002',
            'description' => 'High Torque шестерні. Крутний момент, для важких пружин.',
            'price' => 1390,
            'stock' => 28,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $tuning->id,
            'brand_id' => null,
            'name' => 'Мотор High Torque (короткий)',
            'slug' => 'motor-hightorque-short',
            'sku' => 'TUN-MOT-001',
            'description' => 'High Torque мотор короткого типу. Потужний.',
            'price' => 1890,
            'stock' => 22,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $tuning->id,
            'brand_id' => null,
            'name' => 'MOSFET (базовий)',
            'slug' => 'mosfet-basic',
            'sku' => 'TUN-MOS-001',
            'description' => 'Базовий MOSFET. Захист контактів, збільшення ресурсу.',
            'price' => 890,
            'stock' => 45,
            'is_active' => true,
        ]);

        $products[] = Product::create([
            'category_id' => $tuning->id,
            'brand_id' => null,
            'name' => 'Стволик Tight Bore 6.03mm',
            'slug' => 'barrel-tightbore-603',
            'sku' => 'TUN-BAR-001',
            'description' => 'Tight bore стволик 6.03мм. Точність, дальність. 363мм.',
            'price' => 1590,
            'stock' => 18,
            'is_active' => true,
            'is_new' => true,
        ]);

        dump('Created ' . count($products) . ' products');

        // Create product relations (recommended & tuning kits)
        // Для першого приводу M4 додамо рекомендовані
        $m4Drive = $products[0]; // AEG M4 RIS CQB
        $m4Drive->recommended()->attach([
            $products[15]->id, // Магазин M4 Mid-cap
            $products[20]->id, // Кульки 0.25г
            $products[25]->id, // LiPo 7.4V
            $products[30]->id, // Зарядка Smart
            $products[33]->id, // Окуляри
        ]);

        // Додамо tuning kits
        $m4Drive->tuningKits()->attach([
            $products[40]->id, // Резинка hop-up
            $products[41]->id, // Нуб
            $products[42]->id, // Шестерні High Speed
        ]);
    }
}
