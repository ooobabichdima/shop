#!/bin/bash

# Простой скрипт для создания архива с vendor/ для загрузки на хостинг
# Использование: bash create-vendor-archive.sh

set -e

echo "╔════════════════════════════════════════════╗"
echo "║  Создание vendor.zip для хостинга         ║"
echo "╚════════════════════════════════════════════╝"
echo ""

# Проверка наличия Composer
if ! command -v composer &> /dev/null; then
    echo "❌ Composer не найден. Установите: https://getcomposer.org/"
    exit 1
fi

echo "📦 Удаление старого vendor/ (если есть)..."
rm -rf vendor/ composer.lock

echo "📦 Установка зависимостей Laravel..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "✅ Проверка установки Laravel..."
if [ ! -f "vendor/autoload.php" ]; then
    echo "❌ Ошибка: vendor/autoload.php не создан"
    exit 1
fi

# Проверка что Laravel установлен
php -r "require 'vendor/autoload.php'; if (!class_exists('Illuminate\Foundation\Application')) { echo '❌ Laravel не установлен правильно\n'; exit(1); } echo '✅ Laravel установлен корректно\n';"

echo "🗜️  Создание архива vendor.zip..."
zip -rq vendor.zip vendor/

VENDOR_SIZE=$(du -h vendor.zip | cut -f1)

echo ""
echo "╔════════════════════════════════════════════╗"
echo "║           ✅ Готово!                       ║"
echo "╚════════════════════════════════════════════╝"
echo ""
echo "📦 Создан файл: vendor.zip"
echo "📁 Размер: $VENDOR_SIZE"
echo ""
echo "🚀 Следующие шаги:"
echo "   1. Загрузите vendor.zip на хостинг через cPanel File Manager"
echo "   2. Распакуйте в корень проекта (должна появиться папка vendor/)"
echo "   3. Откройте http://spf.org.ua/setup.php"
echo "   4. Теперь все проверки должны пройти ✅"
echo ""
