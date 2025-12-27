#!/bin/bash

# Скрипт автоматической установки Strikeball Shop на VPS
# Использование: bash install-vps.sh

set -e  # Остановка при ошибке

echo "╔════════════════════════════════════════════╗"
echo "║   Установка Strikeball Shop на VPS        ║"
echo "╚════════════════════════════════════════════╝"
echo ""

# Проверка прав sudo
if [ "$EUID" -ne 0 ]; then
    echo "⚠️  Запустите скрипт с правами sudo:"
    echo "   sudo bash install-vps.sh"
    exit 1
fi

echo "📦 Обновление системы..."
apt update && apt upgrade -y

echo "🔧 Установка необходимых пакетов..."
apt install -y apt-transport-https ca-certificates curl software-properties-common git ufw

echo "🐳 Установка Docker..."
if ! command -v docker &> /dev/null; then
    curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
    echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null
    apt update
    apt install -y docker-ce docker-ce-cli containerd.io docker-compose-plugin
    echo "✅ Docker установлен"
else
    echo "✅ Docker уже установлен"
fi

echo "🔥 Настройка Firewall..."
ufw --force enable
ufw allow OpenSSH
ufw allow 80/tcp
ufw allow 443/tcp
echo "✅ Firewall настроен"

echo "📂 Создание директории проекта..."
mkdir -p /var/www
cd /var/www

# Проверка, есть ли уже проект
if [ -d "shop" ]; then
    echo "⚠️  Директория shop уже существует."
    read -p "Удалить и переустановить? (y/n): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        rm -rf shop
    else
        echo "❌ Установка прервана"
        exit 1
    fi
fi

echo "📥 Клонирование репозитория..."
echo "ℹ️  Введите URL репозитория (или нажмите Enter для локальной копии):"
read REPO_URL

if [ -z "$REPO_URL" ]; then
    echo "⚠️  URL не указан. Скопируйте проект вручную в /var/www/shop"
    exit 1
else
    git clone -b claude/build-ecommerce-store-eM4Yh "$REPO_URL" shop
fi

cd shop

echo "⚙️  Настройка окружения..."
if [ ! -f .env ]; then
    cp .env.example .env

    # Генерация случайного пароля для БД
    DB_PASSWORD=$(openssl rand -base64 32 | tr -d "=+/" | cut -c1-25)
    sed -i "s/DB_PASSWORD=secret/DB_PASSWORD=$DB_PASSWORD/g" .env

    echo "✅ .env создан"
    echo "📝 Пароль БД: $DB_PASSWORD (сохраните его!)"
else
    echo "⚠️  .env уже существует, пропускаем"
fi

echo "🚀 Запуск Docker контейнеров..."
docker compose up -d

echo "⏳ Ожидание запуска MySQL (30 сек)..."
sleep 30

echo "📦 Установка Composer зависимостей..."
docker compose exec -T php composer install --no-dev --optimize-autoloader

echo "🔑 Генерация ключа приложения..."
docker compose exec -T php php artisan key:generate --force

echo "🗄️  Выполнение миграций..."
docker compose exec -T php php artisan migrate --force

echo "🌱 Заполнение БД тестовыми данными..."
docker compose exec -T php php artisan db:seed --force

echo "🎨 Оптимизация кеша..."
docker compose exec -T php php artisan config:cache
docker compose exec -T php php artisan route:cache
docker compose exec -T php php artisan view:cache

echo "🔐 Установка прав доступа..."
docker compose exec -T php chown -R www-data:www-data storage bootstrap/cache
docker compose exec -T php chmod -R 775 storage bootstrap/cache

echo ""
echo "╔════════════════════════════════════════════╗"
echo "║          ✅ Установка завершена!           ║"
echo "╚════════════════════════════════════════════╝"
echo ""
echo "🌐 Откройте в браузере:"
echo "   Frontend: http://$(curl -s ifconfig.me)"
echo "   Admin:    http://$(curl -s ifconfig.me)/admin"
echo ""
echo "🔑 Тестовые учетные данные:"
echo "   Admin:    admin@example.com / password"
echo "   Customer: customer@example.com / password"
echo ""
echo "📝 Пароль БД: $DB_PASSWORD"
echo ""
echo "📖 Подробная документация: /var/www/shop/DEPLOY.md"
echo ""
echo "⚡ Следующие шаги:"
echo "   1. Настройте домен и DNS (если есть)"
echo "   2. Установите SSL: sudo certbot --nginx -d your-domain.com"
echo "   3. Измените пароли в .env для production"
echo "   4. Смените пароль admin пользователя"
echo ""
