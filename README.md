# Strikeball Shop - E-commerce MVP

Рабочий интернет-магазин страйкбольного обладнання на Laravel 11 с интеграцией Новой Почты и Monobank.

## Стек технологий

- **Backend**: Laravel 11 (PHP 8.2)
- **Database**: MySQL 8.0
- **Cache/Queue**: Redis
- **Frontend**: Blade Templates + Alpine.js/Vanilla JS
- **Infrastructure**: Docker Compose

## Функциональность

### Frontend (Магазин)
- ✅ Главная страница с хитами и новинками
- ✅ Каталог товаров с фильтрацией и сортировкой
- ✅ Карточка товара с рекомендациями и тюнинг-китами
- ✅ Корзина (сессии)
- ✅ Оформление заказа с выбором доставки
- ✅ Интеграция Новой Почты (выбор города/отделения)
- ✅ Оплата через Monobank (sandbox режим)
- ✅ Промокоды (START10, BBS50)

### Admin/CRM
- ✅ Dashboard с метриками
- ✅ Управление заказами (статусы, история)
- ✅ Управление товарами (CRUD)
- ✅ Заявки "Помочь с подбором"
- ✅ Audit logs (история изменений)

### Интеграции
- ✅ **Nova Poshta API** - поиск городов и отделений (с кешированием)
- ✅ **Monobank Acquiring** - создание платежей и обработка webhook
- ✅ **Sandbox режимы** - для тестирования без реальных API ключей

## Быстрый старт

### Требования

- Docker и Docker Compose
- Git

### 1. Клонирование и установка

```bash
cd /home/user/shop
cp .env.example .env
```

### 2. Настройка .env

Файл `.env.example` уже содержит все необходимые переменные. Основные настройки:

```env
# Database
DB_CONNECTION=mysql
DB_HOST=mysql
DB_DATABASE=strikeball
DB_USERNAME=strikeball
DB_PASSWORD=secret

# Redis
REDIS_HOST=redis

# Nova Poshta (sandbox по умолчанию)
NOVAPOSHTA_API_KEY=
NOVAPOSHTA_MODE=sandbox
NOVAPOSHTA_CACHE_TTL=86400

# Monobank (sandbox по умолчанию)
MONO_TOKEN=
MONO_MODE=sandbox
```

**Sandbox режимы**:
- Когда `NOVAPOSHTA_MODE=sandbox` - используются тестовые данные вместо реального API
- Когда `MONO_MODE=sandbox` - платежи эмулируются локально без обращения к Monobank

### 3. Запуск через Docker

```bash
# Запустить контейнеры
docker-compose up -d

# Установить зависимости
docker-compose exec php composer install

# Сгенерировать ключ приложения
docker-compose exec php php artisan key:generate

# Выполнить миграции
docker-compose exec php php artisan migrate

# Заполнить БД тестовыми данными
docker-compose exec php php artisan db:seed
```

### 4. Доступ к приложению

- **Frontend**: http://localhost
- **Admin панель**: http://localhost/admin

**Тестовые учетные записи**:
- Admin: `admin@example.com` / `password`
- Customer: `customer@example.com` / `password`

## Структура проекта

```
shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin контроллеры
│   │   │   ├── Api/            # API контроллеры
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   └── ...
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php
│   │   └── Requests/
│   │       └── CheckoutRequest.php
│   ├── Models/                 # Eloquent модели
│   └── Services/               # Сервисы (NovaPoshtaService, MonobankService)
├── config/                     # Конфигурации
├── database/
│   ├── migrations/             # Миграции БД
│   └── seeders/                # Seeders (50+ товаров)
├── docker/                     # Docker конфигурация
├── resources/
│   └── views/                  # Blade шаблоны
│       ├── layouts/
│       ├── components/
│       ├── pages/
│       └── admin/
├── routes/                     # Маршруты (web, api, auth)
├── docker-compose.yml
└── README.md
```

## База данных

### Основные таблицы

- `users` - пользователи (role: admin/customer)
- `categories` - категории товаров (иерархические)
- `brands` - бренды
- `products` - товары
- `product_images` - изображения товаров
- `attributes` - атрибуты (platform, fps, type, etc.)
- `product_attributes` - значения атрибутов
- `product_relations` - связи (recommended/tuning_kit)
- `orders` - заказы
- `order_items` - позиции заказов
- `payments` - платежи
- `pickup_leads` - заявки на подбор
- `audit_logs` - история изменений

### Seeders

При выполнении `php artisan db:seed` создаются:

- 2 пользователя (admin, customer)
- 5 брендов (CYMA, G&G, Tokyo Marui, Specna Arms, ASG)
- 7 категорий (Приводы, Магазины, Кульки, АКБ, Зарядки, Захист, Тюнінг)
- **50+ товаров** с реалистичными данными:
  - 15 приводов (M4, AK, MP5, пистолеты, DMR, LMG, SMG)
  - 10 магазинов (mid-cap, hi-cap, gas)
  - 5 типов куль (0.20-0.32г, bio)
  - 5 акумуляторів (LiPo, NiMh)
  - 3 зарядки
  - 5 защита (окуляри, маски, шлем, рукавички, плитоноска)
  - 7 тюнінг деталей (hop-up, нубы, шестерні, мотори, mosfet)

## API Endpoints

### Nova Poshta

```
GET /api/v1/novaposhta/cities?q={query}
GET /api/v1/novaposhta/warehouses?city_ref={ref}
```

### Payment Webhook

```
POST /payment/monobank/webhook
```

## Промокоды

В системе предустановлены два промокода:

- `START10` - скидка 10%
- `BBS50` - скидка 50 грн

## Тестирование платежей (Sandbox)

При режиме `MONO_MODE=sandbox`:

1. Оформите заказ и выберите оплату Monobank
2. Вы будете перенаправлены на страницу `/payment/monobank/demo/{payment}`
3. Нажмите "Підтвердити оплату (DEMO)"
4. Заказ будет помечен как оплаченный

## Команды разработки

```bash
# Миграции
docker-compose exec php php artisan migrate
docker-compose exec php php artisan migrate:fresh --seed

# Очистка кеша
docker-compose exec php php artisan cache:clear
docker-compose exec php php artisan config:clear
docker-compose exec php php artisan route:clear

# Логи
docker-compose exec php tail -f storage/logs/laravel.log

# Остановить контейнеры
docker-compose down

# Полная очистка (включая volumes)
docker-compose down -v
```

## Production режим

Для production:

1. Установите реальные API ключи в `.env`:
```env
NOVAPOSHTA_API_KEY=your_real_key
NOVAPOSHTA_MODE=production

MONO_TOKEN=your_real_token
MONO_MODE=production
```

2. Настройте webhook URL для Monobank
3. Включите очереди для фоновых задач:
```bash
php artisan queue:work
```

4. Настройте cron для планировщика Laravel:
```
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

## Расширение функциональности

### Добавление новых атрибутов

1. Создайте атрибут в `attributes` таблице
2. Присвойте значения через `product_attributes`
3. Добавьте фильтр в `CatalogController`

### Добавление способов доставки

Редактируйте метод `calculateShipping()` в `CheckoutController`:

```php
private function calculateShipping(string $provider): float
{
    return match ($provider) {
        'ukrposhta' => 80,
        'courier' => 150,
        'pickup' => 0,
        default => 100, // Nova Poshta
    };
}
```

### Добавление способов оплаты

1. Создайте сервис (по аналогии с `MonobankService`)
2. Добавьте метод в `PaymentController`
3. Обновите форму checkout

## Troubleshooting

### Проблемы с правами доступа

```bash
docker-compose exec php chmod -R 775 storage bootstrap/cache
docker-compose exec php chown -R www-data:www-data storage bootstrap/cache
```

### База данных не подключается

Проверьте, что контейнер MySQL запущен:
```bash
docker-compose ps
docker-compose logs mysql
```

### Redis ошибки

Убедитесь, что Redis контейнер работает:
```bash
docker-compose exec redis redis-cli ping
# Должно вернуть: PONG
```

## Лицензия

MIT

## Автор

Сгенерировано с помощью Claude Code для демонстрации полного стека e-commerce на Laravel 11.
