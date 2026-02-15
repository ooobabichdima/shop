# 🎯 Быстрая установка на хостинг

## Вариант 1: Автоматическая подготовка (РЕКОМЕНДУЕТСЯ)

```bash
# На локальной машине
cd /home/user/shop
bash prepare-for-hosting.sh
```

Скрипт создаст готовые архивы:
- ✅ `shop-hosting-ready.zip` (для Windows)
- ✅ `shop-hosting-ready.tar.gz` (для Linux)

## Вариант 2: Вручную

```bash
composer install --no-dev --optimize-autoloader
zip -r shop.zip . -x "*.git*" "node_modules/*" "docker/*" "tests/*"
```

---

## 📤 Загрузка на хостинг

### Через cPanel:

1. **File Manager** → `public_html`
2. Загрузите `shop-hosting-ready.zip`
3. Кликните правой кнопкой → **Extract**
4. Переместите файлы из папки в корень

### Через FTP:

1. Подключитесь через FileZilla/WinSCP
2. Загрузите все файлы в `public_html`

---

## 🗄️ Настройка БД

В cPanel → **MySQL Databases**:

1. Создайте базу: `strikeball_db`
2. Создайте пользователя: `db_user`
3. Назначьте все права

---

## 🚀 Установка

Откройте в браузере:

```
http://ваш-домен.com/setup.php
```

Следуйте инструкциям (3 простых шага).

---

## 🔐 Доступ

После установки:

- **Магазин:** http://ваш-домен.com
- **Админка:** http://ваш-домен.com/admin
  - Email: `admin@example.com`
  - Password: `password`

**⚠️ Сразу смените пароль!**

---

## ✅ После установки

1. Удалите `public/setup.php`
2. Смените пароль админа
3. Настройте API ключи в `.env`:
   - Nova Poshta: https://devcenter.novaposhta.ua/
   - Monobank: https://api.monobank.ua/

---

## 📖 Полная документация

- [Простая установка](SIMPLE-HOSTING-GUIDE.md) - пошаговая инструкция
- [README](README.md) - основная документация
- [Без Docker](DEPLOY-NO-DOCKER.md) - установка на VPS

---

## 🆘 Помощь

**Белый экран?**
```
Проверьте права: storage/ и bootstrap/cache/ должны быть 775
```

**Ошибка БД?**
```
Проверьте данные в .env
```

**Логи:**
```
storage/logs/laravel.log
```

---

**Готово!** Ваш магазин работает! 🎉
