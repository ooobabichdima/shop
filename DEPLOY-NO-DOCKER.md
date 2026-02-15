# Установка на обычный хостинг БЕЗ Docker

## Требования
- Ubuntu 20.04/22.04 или Debian
- SSH доступ
- Права sudo

## Шаг 1: Установка LEMP (Linux, Nginx, MySQL, PHP)

```bash
# Обновление системы
sudo apt update && sudo apt upgrade -y

# Установка Nginx
sudo apt install -y nginx

# Установка MySQL
sudo apt install -y mysql-server
sudo mysql_secure_installation

# Установка PHP 8.2 и расширений
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml \
    php8.2-bcmath php8.2-gd php8.2-zip php8.2-curl php8.2-intl php8.2-redis

# Установка Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Установка Git
sudo apt install -y git unzip
```

## Шаг 2: Создание БД

```bash
# Войти в MySQL
sudo mysql

# В консоли MySQL:
CREATE DATABASE strikeball CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'strikeball'@'localhost' IDENTIFIED BY 'СИЛЬНЫЙ_ПАРОЛЬ';
GRANT ALL PRIVILEGES ON strikeball.* TO 'strikeball'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

## Шаг 3: Клонирование проекта

```bash
# Создать директорию
sudo mkdir -p /var/www
cd /var/www

# Клонировать
sudo git clone -b claude/build-ecommerce-store-eM4Yh https://github.com/ooobabichdima/shop.git
cd shop

# Права доступа
sudo chown -R www-data:www-data /var/www/shop
sudo chmod -R 755 /var/www/shop
```

## Шаг 4: Настройка Laravel

```bash
cd /var/www/shop

# Установка зависимостей
composer install --no-dev --optimize-autoloader

# Создание .env
cp .env.example .env
nano .env
```

Измени в `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=http://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=strikeball
DB_USERNAME=strikeball
DB_PASSWORD=ТВОЙ_ПАРОЛЬ_ЗДЕСЬ

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=database

# Nova Poshta и Monobank (по желанию)
NOVAPOSHTA_MODE=sandbox
MONO_MODE=sandbox
```

Продолжи установку:

```bash
# Генерация ключа
php artisan key:generate

# Миграции
php artisan migrate --seed --force

# Кеш
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Права
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

## Шаг 5: Настройка Nginx

```bash
# Создать конфиг
sudo nano /etc/nginx/sites-available/strikeball
```

Содержимое:

```nginx
server {
    listen 80;
    server_name your-domain.com www.your-domain.com;  # Измени на свой домен или IP
    root /var/www/shop/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Активируй конфиг:

```bash
# Создать симлинк
sudo ln -s /etc/nginx/sites-available/strikeball /etc/nginx/sites-enabled/

# Удалить default (опционально)
sudo rm /etc/nginx/sites-enabled/default

# Проверить конфигурацию
sudo nginx -t

# Перезапустить Nginx
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm
```

## Шаг 6: Настройка Firewall

```bash
sudo ufw allow 'Nginx Full'
sudo ufw allow OpenSSH
sudo ufw enable
```

## Шаг 7: Установка SSL (Let's Encrypt)

```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d your-domain.com -d www.your-domain.com
```

## Готово! 🎉

Открой в браузере:
- http://your-domain.com (или http://your-ip)
- http://your-domain.com/admin

## Настройка Cron (для очередей и планировщика)

```bash
sudo crontab -e
```

Добавь:

```
* * * * * cd /var/www/shop && php artisan schedule:run >> /dev/null 2>&1
```

## Настройка Queue Worker (опционально)

```bash
sudo nano /etc/systemd/system/laravel-worker.service
```

Содержимое:

```ini
[Unit]
Description=Laravel Queue Worker
After=network.target

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /var/www/shop/artisan queue:work --sleep=3 --tries=3 --max-time=3600

[Install]
WantedBy=multi-user.target
```

Активируй:

```bash
sudo systemctl enable laravel-worker
sudo systemctl start laravel-worker
```

## Обновление проекта

```bash
cd /var/www/shop
git pull origin claude/build-ecommerce-store-eM4Yh
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
sudo systemctl restart php8.2-fpm
```

## Устранение проблем

**Ошибка 500:**
```bash
# Проверь логи
tail -f /var/www/shop/storage/logs/laravel.log
tail -f /var/log/nginx/error.log

# Проверь права
sudo chown -R www-data:www-data /var/www/shop/storage
sudo chmod -R 775 /var/www/shop/storage
```

**Белый экран:**
```bash
# Очисти кеш
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```
