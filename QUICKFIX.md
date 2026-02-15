# 🚨 Быстрое исправление ошибки установки

## Проблема

Вы получили ошибки:
```
.env.hosting: No such file or directory
Class "Illuminate\Foundation\Application" not found
```

**Причина:** Файлы загружены напрямую из GitHub без подготовки.

---

## ✅ Решение 1: Правильный архив (РЕКОМЕНДУЕТСЯ)

### На локальной машине:

```bash
cd /home/user/shop

# Запустите скрипт подготовки
bash prepare-for-hosting.sh
```

Это создаст **готовый архив** со всеми зависимостями:
- `shop-hosting-ready.zip` (20-25 MB)

### На хостинге:

1. **Удалите** старые файлы из `public_html`
2. Загрузите `shop-hosting-ready.zip`
3. Распакуйте
4. Откройте `http://ваш-домен.com/setup.php`

---

## ✅ Решение 2: Через SSH (если есть доступ)

```bash
# Подключитесь к хостингу
ssh username@your-host.com

# Перейдите в директорию
cd ~/public_html/shop
# или
cd ~/spf.org.ua/shop

# Установите зависимости
composer install --no-dev --optimize-autoloader

# Создайте .env.hosting
cp .env.example .env.hosting

# Теперь откройте setup.php в браузере
```

---

## ✅ Решение 3: Вручную загрузить недостающие файлы

### Скачайте правильные файлы:

1. **Зависимости Composer:**
   ```bash
   # На локальной машине
   cd /home/user/shop
   composer install --no-dev
   zip -r vendor.zip vendor/
   ```

   Загрузите `vendor.zip` на хостинг и распакуйте в корень проекта.

2. **Файл .env.hosting:**

   Создайте файл `.env.hosting` на хостинге (через cPanel File Manager) со следующим содержимым:

```env
APP_NAME="Strikeball Shop"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=http://spf.org.ua

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database

NOVAPOSHTA_MODE=sandbox
MONO_MODE=sandbox
```

3. Откройте `setup.php` снова

---

## ✅ Решение 4: Используйте готовый архив из релиза

Если скрипт не работает, скачайте готовый архив:

```bash
# На локальной машине
cd /home/user/shop

# Простое создание архива с зависимостями
composer install --no-dev --optimize-autoloader
cp .env.example .env.hosting

# Создать архив
zip -r shop-complete.zip \
  app/ \
  bootstrap/ \
  config/ \
  database/ \
  public/ \
  resources/ \
  routes/ \
  storage/ \
  vendor/ \
  .env.hosting \
  .env.example \
  artisan \
  composer.json \
  composer.lock \
  -x "storage/logs/*" \
  -x "storage/framework/cache/*" \
  -x "storage/framework/sessions/*" \
  -x "storage/framework/views/*"
```

Загрузите `shop-complete.zip` на хостинг.

---

## 📋 Проверочный список

Перед запуском `setup.php` убедитесь что есть:

- ✅ Папка `vendor/` с файлом `autoload.php`
- ✅ Файл `.env.hosting` или `.env.example`
- ✅ Все папки Laravel (app, bootstrap, config, etc.)
- ✅ PHP 8.2+ на хостинге
- ✅ Создана база данных MySQL

---

## 🔍 Как проверить что всё на месте

Через cPanel File Manager проверьте структуру:

```
public_html/
├── vendor/
│   └── autoload.php  ← Должен быть!
├── .env.hosting      ← Должен быть!
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
│   └── setup.php
├── resources/
├── routes/
├── storage/
├── artisan
└── composer.json
```

---

## ❓ Какое решение выбрать?

- **Есть локальная машина?** → **Решение 1** (prepare-for-hosting.sh)
- **Есть SSH доступ?** → **Решение 2** (composer на хостинге)
- **Только cPanel?** → **Решение 3** или **4** (загрузить vendor вручную)

---

## 💡 После исправления

Когда всё заработает:

1. Завершите установку через `setup.php`
2. Удалите `public/setup.php` для безопасности
3. Смените пароль admin в админке

---

**Нужна помощь с конкретным решением?** Напишите какой вариант выбрали!
