# Деплой на VPS - Пошаговая инструкция

## Требования к VPS

- Ubuntu 20.04/22.04 или Debian 11/12
- Минимум 2GB RAM
- 20GB свободного места
- SSH доступ с правами sudo

## Шаг 1: Подключение к VPS

```bash
ssh root@your-vps-ip
# или
ssh your-user@your-vps-ip
```

## Шаг 2: Установка Docker и Docker Compose

```bash
# Обновление системы
sudo apt update && sudo apt upgrade -y

# Установка необходимых пакетов
sudo apt install -y apt-transport-https ca-certificates curl software-properties-common git

# Добавление Docker GPG ключа
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

# Добавление Docker репозитория
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Установка Docker
sudo apt update
sudo apt install -y docker-ce docker-ce-cli containerd.io

# Установка Docker Compose V2
sudo apt install -y docker-compose-plugin

# Добавление пользователя в группу docker (если не root)
sudo usermod -aG docker $USER
newgrp docker

# Проверка установки
docker --version
docker compose version
```

## Шаг 3: Клонирование репозитория

```bash
# Создание директории для проекта
mkdir -p /var/www
cd /var/www

# Клонирование (замените на ваш репозиторий)
git clone -b claude/build-ecommerce-store-eM4Yh https://github.com/your-username/shop.git
cd shop

# Или если репозиторий приватный, настройте SSH ключи
```

## Шаг 4: Настройка окружения

```bash
# Копирование .env
cp .env.example .env

# Редактирование .env (используйте nano или vim)
nano .env
```

### Важные настройки для production в .env:

```env
APP_NAME="Strikeball Shop"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://your-domain.com

# Database (оставьте как есть для Docker)
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=strikeball
DB_USERNAME=strikeball
DB_PASSWORD=СОЗДАЙТЕ_СИЛЬНЫЙ_ПАРОЛЬ_ЗДЕСЬ

# Redis
REDIS_HOST=redis

# Для production - получите реальные ключи
NOVAPOSHTA_API_KEY=ваш_ключ_здесь
NOVAPOSHTA_MODE=production
# Или оставьте sandbox для тестирования:
# NOVAPOSHTA_MODE=sandbox

MONO_TOKEN=ваш_токен_здесь
MONO_MODE=production
# Или sandbox:
# MONO_MODE=sandbox
MONO_WEBHOOK_URL=http://your-domain.com/payment/monobank/webhook
```

**Сохраните файл**: `Ctrl+O`, `Enter`, `Ctrl+X`

## Шаг 5: Настройка Docker для production

Обновите `docker-compose.yml` для production:

```bash
nano docker-compose.yml
```

Измените порты nginx (если нужно):

```yaml
  nginx:
    ports:
      - "80:80"
      - "443:443"  # Если будете использовать SSL
```

## Шаг 6: Запуск приложения

```bash
# Запуск контейнеров
docker compose up -d

# Проверка статуса
docker compose ps

# Должны быть запущены: nginx, php, mysql, redis
```

## Шаг 7: Установка зависимостей и настройка Laravel

```bash
# Установка Composer зависимостей
docker compose exec php composer install --no-dev --optimize-autoloader

# Генерация ключа приложения
docker compose exec php php artisan key:generate

# Выполнение миграций
docker compose exec php php artisan migrate --force

# Заполнение БД тестовыми данными
docker compose exec php php artisan db:seed --force

# Очистка и оптимизация кеша
docker compose exec php php artisan config:cache
docker compose exec php php artisan route:cache
docker compose exec php php artisan view:cache

# Установка прав доступа
docker compose exec php chown -R www-data:www-data storage bootstrap/cache
docker compose exec php chmod -R 775 storage bootstrap/cache
```

## Шаг 8: Настройка Firewall (UFW)

```bash
# Разрешить SSH
sudo ufw allow OpenSSH

# Разрешить HTTP и HTTPS
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# Включить firewall
sudo ufw enable

# Проверить статус
sudo ufw status
```

## Шаг 9: Настройка доменного имени (опционально)

### Вариант 1: Использование поддомена

1. В DNS панели вашего домена добавьте A-запись:
```
Type: A
Name: shop (или @)
Value: YOUR_VPS_IP
TTL: 3600
```

2. Подождите 5-30 минут для распространения DNS

3. Проверьте:
```bash
ping your-domain.com
```

### Вариант 2: Настройка nginx напрямую на VPS (без Docker nginx)

Если хотите использовать системный nginx вместо Docker:

```bash
# Установка nginx на хост
sudo apt install -y nginx

# Создание конфига
sudo nano /etc/nginx/sites-available/shop
```

Добавьте конфигурацию:

```nginx
server {
    listen 80;
    server_name your-domain.com www.your-domain.com;

    location / {
        proxy_pass http://localhost:80;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

Активируйте конфиг:
```bash
sudo ln -s /etc/nginx/sites-available/shop /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

## Шаг 10: Настройка SSL (Let's Encrypt) - РЕКОМЕНДУЕТСЯ

```bash
# Установка Certbot
sudo apt install -y certbot python3-certbot-nginx

# Получение SSL сертификата
sudo certbot --nginx -d your-domain.com -d www.your-domain.com

# Автоматическое обновление (проверка)
sudo certbot renew --dry-run
```

Certbot автоматически настроит nginx для HTTPS и перенаправление с HTTP.

## Шаг 11: Мониторинг и логи

```bash
# Просмотр логов контейнеров
docker compose logs -f

# Логи конкретного сервиса
docker compose logs -f php
docker compose logs -f nginx
docker compose logs -f mysql

# Логи Laravel
docker compose exec php tail -f storage/logs/laravel.log

# Статус контейнеров
docker compose ps

# Использование ресурсов
docker stats
```

## Шаг 12: Автоматический запуск при перезагрузке

Docker контейнеры уже настроены на автозапуск (restart: unless-stopped в docker-compose.yml).

Проверьте:
```bash
# Перезагрузите VPS
sudo reboot

# После перезагрузки проверьте
docker compose ps
```

## Шаг 13: Настройка очередей Laravel (опционально)

Для production рекомендуется использовать очереди:

```bash
# Создайте systemd сервис
sudo nano /etc/systemd/system/laravel-worker.service
```

Содержимое:
```ini
[Unit]
Description=Laravel Queue Worker
After=docker.service

[Service]
Type=simple
User=root
WorkingDirectory=/var/www/shop
ExecStart=/usr/bin/docker compose exec -T php php artisan queue:work --sleep=3 --tries=3 --max-time=3600
Restart=always

[Install]
WantedBy=multi-user.target
```

Активируйте:
```bash
sudo systemctl daemon-reload
sudo systemctl enable laravel-worker
sudo systemctl start laravel-worker
sudo systemctl status laravel-worker
```

## Шаг 14: Настройка планировщика Laravel (опционально)

```bash
# Добавьте в crontab
sudo crontab -e
```

Добавьте строку:
```
* * * * * cd /var/www/shop && /usr/bin/docker compose exec -T php php artisan schedule:run >> /dev/null 2>&1
```

## Проверка работы

1. Откройте в браузере: `http://your-vps-ip` или `http://your-domain.com`
2. Войдите в админку: `http://your-domain.com/admin`
   - Email: `admin@example.com`
   - Password: `password`

## Обновление приложения

```bash
cd /var/www/shop

# Получить последние изменения
git pull origin claude/build-ecommerce-store-eM4Yh

# Обновить зависимости
docker compose exec php composer install --no-dev --optimize-autoloader

# Выполнить миграции (если есть новые)
docker compose exec php php artisan migrate --force

# Очистить кеш
docker compose exec php php artisan config:clear
docker compose exec php php artisan cache:clear
docker compose exec php php artisan view:clear

# Пересоздать кеш
docker compose exec php php artisan config:cache
docker compose exec php php artisan route:cache
docker compose exec php php artisan view:cache

# Перезапустить контейнеры (если нужно)
docker compose restart
```

## Резервное копирование

### Бэкап базы данных:

```bash
# Создать бэкап
docker compose exec mysql mysqldump -u strikeball -p strikeball > backup-$(date +%Y%m%d-%H%M%S).sql

# Восстановить из бэкапа
docker compose exec -T mysql mysql -u strikeball -p strikeball < backup-20250101-120000.sql
```

### Автоматический бэкап (cron):

```bash
sudo nano /usr/local/bin/backup-shop.sh
```

Содержимое:
```bash
#!/bin/bash
BACKUP_DIR="/var/backups/shop"
mkdir -p $BACKUP_DIR
cd /var/www/shop
docker compose exec -T mysql mysqldump -u strikeball -pYOUR_PASSWORD strikeball | gzip > $BACKUP_DIR/db-$(date +%Y%m%d-%H%M%S).sql.gz

# Удалить бэкапы старше 7 дней
find $BACKUP_DIR -name "db-*.sql.gz" -mtime +7 -delete
```

Сделайте исполняемым и добавьте в cron:
```bash
sudo chmod +x /usr/local/bin/backup-shop.sh
sudo crontab -e
# Добавьте: 0 2 * * * /usr/local/bin/backup-shop.sh
```

## Устранение проблем

### Контейнеры не запускаются

```bash
# Проверить логи
docker compose logs

# Пересоздать контейнеры
docker compose down
docker compose up -d
```

### Ошибки прав доступа

```bash
docker compose exec php chown -R www-data:www-data storage bootstrap/cache
docker compose exec php chmod -R 775 storage bootstrap/cache
```

### Проблемы с БД

```bash
# Перезапустить MySQL
docker compose restart mysql

# Проверить подключение
docker compose exec php php artisan tinker
# В tinker: DB::connection()->getPdo();
```

### Память заканчивается

```bash
# Проверить использование
free -h
docker stats

# Увеличить swap (если RAM < 2GB)
sudo fallocate -l 2G /swapfile
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile
echo '/swapfile none swap sw 0 0' | sudo tee -a /etc/fstab
```

## Безопасность Production

1. **Смените пароли в .env**:
   - DB_PASSWORD
   - Измените пароли тестовых пользователей

2. **Отключите debug**:
   ```env
   APP_DEBUG=false
   ```

3. **Настройте HTTPS** (см. Шаг 10)

4. **Ограничьте доступ к /admin** (опционально):
   ```bash
   # Добавьте в nginx конфиг IP whitelist
   ```

5. **Регулярно обновляйте систему**:
   ```bash
   sudo apt update && sudo apt upgrade -y
   ```

## Готово! 🎉

Ваш магазин должен работать на:
- **HTTP**: `http://your-vps-ip` или `http://your-domain.com`
- **HTTPS**: `https://your-domain.com` (после настройки SSL)
- **Admin**: `https://your-domain.com/admin`

Если возникнут проблемы - проверьте логи и статус контейнеров!
