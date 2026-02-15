#!/bin/bash

# Скрипт подготовки проекта для загрузки на обычный хостинг
# Использование: bash prepare-for-hosting.sh

set -e

echo "╔════════════════════════════════════════════╗"
echo "║  Подготовка для обычного хостинга         ║"
echo "╚════════════════════════════════════════════╝"
echo ""

# Проверка наличия Composer
if ! command -v composer &> /dev/null; then
    echo "❌ Composer не найден. Установите: https://getcomposer.org/"
    exit 1
fi

echo "📦 Установка зависимостей Composer..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "🧹 Очистка кеша..."
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true

echo "📝 Создание .env.production (если нет)..."
if [ ! -f .env.production ]; then
    cp .env.example .env.production
    echo "✓ Файл .env.production создан"
else
    echo "✓ Файл .env.production уже существует"
fi

echo "📂 Создание архива для загрузки..."

# Создаем временную директорию
TEMP_DIR="shop-hosting-$(date +%Y%m%d-%H%M%S)"
mkdir -p "../$TEMP_DIR"

echo "📋 Копирование файлов..."

# Копируем все нужные файлы
rsync -a --exclude='node_modules' \
         --exclude='.git' \
         --exclude='docker' \
         --exclude='docker-compose.yml' \
         --exclude='tests' \
         --exclude='.env' \
         --exclude='*.log' \
         --exclude='storage/logs/*' \
         --exclude='storage/framework/cache/*' \
         --exclude='storage/framework/sessions/*' \
         --exclude='storage/framework/views/*' \
         ./ "../$TEMP_DIR/"

# Создаем нужные директории
mkdir -p "../$TEMP_DIR/storage/logs"
mkdir -p "../$TEMP_DIR/storage/framework/cache"
mkdir -p "../$TEMP_DIR/storage/framework/sessions"
mkdir -p "../$TEMP_DIR/storage/framework/views"
mkdir -p "../$TEMP_DIR/bootstrap/cache"

# Создаем .gitkeep файлы
touch "../$TEMP_DIR/storage/logs/.gitkeep"
touch "../$TEMP_DIR/storage/framework/cache/.gitkeep"
touch "../$TEMP_DIR/storage/framework/sessions/.gitkeep"
touch "../$TEMP_DIR/storage/framework/views/.gitkeep"

echo "🗜️  Создание ZIP архива..."
cd ..
zip -rq "shop-hosting-ready.zip" "$TEMP_DIR" -x "*.DS_Store"

# Также создаем tar.gz для Linux серверов
tar -czf "shop-hosting-ready.tar.gz" "$TEMP_DIR"

echo "🧹 Очистка временных файлов..."
rm -rf "$TEMP_DIR"

echo ""
echo "╔════════════════════════════════════════════╗"
echo "║           ✅ Готово!                       ║"
echo "╚════════════════════════════════════════════╝"
echo ""
echo "📦 Созданы архивы:"
echo "   - shop-hosting-ready.zip (для Windows)"
echo "   - shop-hosting-ready.tar.gz (для Linux)"
echo ""
echo "📁 Размер: $(du -h shop-hosting-ready.zip | cut -f1)"
echo ""
echo "🚀 Следующие шаги:"
echo "   1. Загрузите архив на хостинг через cPanel/FTP"
echo "   2. Распакуйте в public_html/"
echo "   3. Создайте базу данных MySQL"
echo "   4. Откройте http://ваш-домен.com/setup.php"
echo "   5. Следуйте инструкциям установщика"
echo ""
echo "📖 Подробная инструкция: SIMPLE-HOSTING-GUIDE.md"
echo ""
