# 🚀 Быстрый старт на VPS

## Вариант 1: Автоматическая установка (РЕКОМЕНДУЕТСЯ)

```bash
# 1. Подключитесь к VPS
ssh root@your-vps-ip

# 2. Скачайте и запустите скрипт установки
curl -o install-vps.sh https://raw.githubusercontent.com/your-repo/shop/claude/build-ecommerce-store-eM4Yh/install-vps.sh
chmod +x install-vps.sh
sudo bash install-vps.sh
```

Скрипт автоматически:
- ✅ Установит Docker и Docker Compose
- ✅ Настроит firewall
- ✅ Склонирует репозиторий
- ✅ Настроит .env
- ✅ Запустит контейнеры
- ✅ Выполнит миграции и сиды
- ✅ Оптимизирует кеш

**Время установки: ~5-10 минут**

После установки откройте в браузере: `http://your-vps-ip`

## Вариант 2: Ручная установка (для опытных)

```bash
# 1. Подключитесь к VPS
ssh root@your-vps-ip

# 2. Установите Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo apt install -y docker-compose-plugin

# 3. Клонируйте репозиторий
cd /var/www
git clone -b claude/build-ecommerce-store-eM4Yh https://github.com/your-repo/shop.git
cd shop

# 4. Настройте окружение
cp .env.example .env
nano .env  # Измените DB_PASSWORD и другие настройки

# 5. Запустите
docker compose up -d
docker compose exec php composer install --no-dev --optimize-autoloader
docker compose exec php php artisan key:generate
docker compose exec php php artisan migrate --seed --force
docker compose exec php php artisan config:cache

# 6. Откройте в браузере
http://your-vps-ip
```

## Доступ к приложению

- **Frontend**: `http://your-vps-ip`
- **Admin**: `http://your-vps-ip/admin`
  - Email: `admin@example.com`
  - Password: `password`

## Настройка домена (опционально)

1. Добавьте A-запись в DNS:
   ```
   Type: A
   Name: @ (или shop)
   Value: YOUR_VPS_IP
   ```

2. Установите SSL:
   ```bash
   sudo apt install -y certbot python3-certbot-nginx
   sudo certbot --nginx -d your-domain.com
   ```

3. Обновите .env:
   ```env
   APP_URL=https://your-domain.com
   ```

## Управление

```bash
# Просмотр логов
docker compose logs -f

# Перезапуск
docker compose restart

# Остановка
docker compose down

# Обновление проекта
git pull
docker compose exec php composer install --no-dev
docker compose exec php php artisan migrate --force
docker compose exec php php artisan config:cache
docker compose restart
```

## Проблемы?

Смотрите подробную документацию: [DEPLOY.md](DEPLOY.md)

## Следующие шаги

1. ✅ Измените пароли в админке
2. ✅ Настройте реальные API ключи (Nova Poshta, Monobank)
3. ✅ Загрузите изображения товаров
4. ✅ Настройте email уведомления
5. ✅ Включите HTTPS

---

**Нужна помощь?** Читайте [DEPLOY.md](DEPLOY.md) для подробных инструкций.
