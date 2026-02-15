# 🚀 Простая установка на обычный хостинг

## За 5 минут без Docker и командной строки!

---

## Требования к хостингу

✅ **PHP 8.2+**
✅ **MySQL 5.7+**
✅ **100 MB свободного места**
✅ **Доступ к cPanel или FTP**

**Подходящие хостинги:** Hostinger, Bluehost, SiteGround, A2 Hosting, или любой с PHP 8.2

---

## Шаг 1: Подготовка файлов

### Вариант A: Скачать готовый архив

```bash
# На локальной машине
cd /home/user/shop

# Установить зависимости
composer install --no-dev --optimize-autoloader

# Создать архив для загрузки
tar -czf shop-ready.tar.gz \
  --exclude='.git' \
  --exclude='node_modules' \
  --exclude='docker' \
  --exclude='docker-compose.yml' \
  --exclude='tests' \
  .
```

Файл `shop-ready.tar.gz` готов к загрузке!

### Вариант B: Скачать через Git

```bash
git clone -b claude/build-ecommerce-store-eM4Yh https://github.com/ooobabichdima/shop.git
cd shop
composer install --no-dev --optimize-autoloader
zip -r shop-ready.zip . -x "*.git*" "node_modules/*" "docker/*"
```

---

## Шаг 2: Загрузка на хостинг

### Через cPanel (рекомендуется):

1. Войдите в **cPanel**
2. Откройте **Менеджер файлов** (File Manager)
3. Перейдите в `public_html` (или корневую директорию сайта)
4. Нажмите **Загрузить** (Upload)
5. Загрузите `shop-ready.tar.gz` или `shop-ready.zip`
6. Кликните правой кнопкой → **Извлечь** (Extract)
7. Переместите все файлы из папки `shop` в корень `public_html`

### Через FTP (FileZilla, WinSCP):

1. Подключитесь к FTP
2. Перейдите в `public_html` или `www`
3. Загрузите все файлы из локальной папки `shop`
4. Подождите завершения загрузки (5-10 минут)

---

## Шаг 3: Настройка корневой директории

**ВАЖНО:** Laravel использует папку `public` как корень сайта.

### В cPanel:

1. Перейдите в **Domains** → **Domains**
2. Найдите свой домен
3. Кликните **Manage**
4. В поле **Document Root** укажите: `/public_html/public` (или `/home/username/public_html/public`)
5. Сохраните

**Альтернатива:** Переместите содержимое папки `public` в корень:

```
public_html/
  ├── index.php (из папки public)
  ├── setup.php (из папки public)
  └── app/ (оставьте как есть)
```

И в `index.php` измените пути:
```php
// Было:
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// Стало:
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
```

---

## Шаг 4: Создание базы данных

### В cPanel:

1. **MySQL Database Wizard** или **MySQL Databases**
2. Создайте новую БД:
   - Имя: `strikeball_db` (или любое)
3. Создайте пользователя:
   - Имя: `strikeball_user`
   - Пароль: (создайте сильный)
4. Назначьте **ВСЕ ПРИВИЛЕГИИ** пользователю для этой БД
5. **Запомните** эти данные!

---

## Шаг 5: Автоматическая установка

1. Откройте в браузере:
   ```
   http://your-domain.com/setup.php
   ```

2. Следуйте инструкциям на экране:
   - **Шаг 1**: Проверка системы (автоматически)
   - **Шаг 2**: Введите данные БД
   - **Шаг 3**: Подождите установки

3. Готово! 🎉

---

## Шаг 6: Вход в админку

После установки:

**URL:** `http://your-domain.com/admin`

**Логин:**
- Email: `admin@example.com`
- Password: `password`

**⚠️ ВАЖНО: Сразу смените пароль!**

---

## Шаг 7: Безопасность

После установки **обязательно**:

1. **Удалите `setup.php`:**
   ```
   Удалите файл public/setup.php через cPanel или FTP
   ```

2. **Установите права доступа:**
   ```
   storage/ - 775
   bootstrap/cache/ - 775
   ```

3. **Смените пароль admin:**
   - Войдите в админку
   - Измените пароль

4. **Настройте .env:**
   ```
   APP_DEBUG=false
   APP_ENV=production
   ```

---

## Настройка .htaccess (если нужно)

Если сайт не открывается, создайте `.htaccess` в папке `public`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Redirect to public folder
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L]

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)/$ /$1 [L,R=301]

    # Handle Front Controller
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## Устранение проблем

### Белый экран / Ошибка 500

1. Проверьте права доступа:
   ```
   storage/ - 775
   bootstrap/cache/ - 775
   ```

2. Включите отображение ошибок:
   ```php
   // В public/index.php добавьте в начало:
   ini_set('display_errors', 1);
   error_reporting(E_ALL);
   ```

3. Проверьте логи:
   ```
   storage/logs/laravel.log
   ```

### Ошибка "No application encryption key"

```bash
php artisan key:generate
```

Или вручную в `.env`:
```
APP_KEY=base64:СЛУЧАЙНАЯ_СТРОКА_32_СИМВОЛА
```

### Ошибка подключения к БД

Проверьте `.env`:
```env
DB_HOST=localhost  # Иногда нужно указать 127.0.0.1
DB_DATABASE=правильное_имя
DB_USERNAME=правильный_user
DB_PASSWORD=правильный_пароль
```

### Composer не установлен

**Вариант 1:** Установите зависимости локально, потом загрузите:
```bash
composer install --no-dev --optimize-autoloader
# Загрузите папку vendor на хостинг
```

**Вариант 2:** Используйте SSH на хостинге:
```bash
ssh username@your-host.com
cd public_html
composer install --no-dev --optimize-autoloader
```

---

## Обновление сайта

1. Скачайте новые файлы из GitHub
2. Загрузите на хостинг (кроме `.env` и `vendor/`)
3. Выполните через SSH или встроенный Terminal:
   ```bash
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## FAQ

**Q: Нужен ли Composer на хостинге?**
A: Нет, если вы загрузите папку `vendor` с уже установленными зависимостями.

**Q: Работает ли на shared hosting?**
A: Да, если есть PHP 8.2+ и MySQL.

**Q: Нужен ли Redis?**
A: Нет, используется file драйвер для кеша.

**Q: Как загрузить изображения товаров?**
A: Через админку или в папку `storage/app/public/`

**Q: Как настроить email?**
A: В `.env` укажите SMTP данные вашего хостинга.

---

## Готово! 🎉

Ваш магазин работает на:
- **Магазин:** http://your-domain.com
- **Админка:** http://your-domain.com/admin

**Следующие шаги:**
1. Смените пароль админа
2. Получите API ключи (Nova Poshta, Monobank)
3. Загрузите реальные изображения товаров
4. Настройте домен и SSL

---

**Нужна помощь?** Проверьте логи в `storage/logs/laravel.log`
