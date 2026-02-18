# Инструкция по созданию полного дампа БД

## Способ 1: Автоматический скрипт (рекомендуется)

```bash
cd /home/notari27/spf.org.ua/shop

# Сделать скрипт исполняемым
chmod +x create_full_dump.sh

# Запустить
./create_full_dump.sh
```

Скрипт создаст файл вида: `shop_full_dump_20240218_143022.sql`

---

## Способ 2: Ручная команда

Сначала узнайте данные подключения:
```bash
cd /home/notari27/spf.org.ua/shop
grep DB_ .env
```

Затем выполните (замените YOUR_USER, YOUR_PASS, YOUR_DB):
```bash
mysqldump \
  -u YOUR_USER \
  -pYOUR_PASS \
  YOUR_DB \
  --add-drop-table \
  --single-transaction \
  --routines \
  --triggers \
  > shop_full_dump.sql
```

**Пример:**
```bash
mysqldump -u notari27_shop -p notari27_shopdb > shop_full_dump.sql
# Введите пароль когда попросит
```

---

## Способ 3: Через phpMyAdmin

1. Откройте phpMyAdmin
2. Выберите вашу базу данных
3. Вкладка "Экспорт" (Export)
4. Метод экспорта: "Быстрый"
5. Формат: SQL
6. Нажмите "Вперёд"

---

## Восстановление дампа на новом сервере

```bash
# Создать БД (если нужно)
mysql -u root -p -e "CREATE DATABASE shop_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Залить дамп
mysql -u root -p shop_db < shop_full_dump.sql

# Или если дамп содержит CREATE DATABASE:
mysql -u root -p < shop_full_dump.sql
```

---

## Скачать дамп на локальную машину

```bash
# С продакшн сервера
scp notari27@web868:/home/notari27/spf.org.ua/shop/shop_full_dump.sql ~/Downloads/

# Или через rsync
rsync -avz notari27@web868:/home/notari27/spf.org.ua/shop/shop_full_dump.sql ~/Downloads/
```

---

## Проверка дампа

```bash
# Посмотреть размер
ls -lh shop_full_dump.sql

# Посмотреть первые строки
head -50 shop_full_dump.sql

# Посмотреть последние строки
tail -50 shop_full_dump.sql

# Подсчитать INSERT запросы
grep -c "INSERT INTO" shop_full_dump.sql

# Посмотреть какие таблицы есть в дампе
grep "CREATE TABLE" shop_full_dump.sql
```
