#!/bin/bash
# ==========================================
# Скрипт для создания полного дампа БД
# Включает структуру + все данные
# ==========================================

# Цвета для вывода
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${GREEN}=========================================="
echo "Создание полного дампа БД Strikeball Shop"
echo -e "==========================================${NC}"

# Читаем данные из .env
if [ ! -f .env ]; then
    echo -e "${RED}Ошибка: файл .env не найден${NC}"
    exit 1
fi

DB_HOST=$(grep DB_HOST .env | cut -d '=' -f2)
DB_PORT=$(grep DB_PORT .env | cut -d '=' -f2)
DB_DATABASE=$(grep DB_DATABASE .env | cut -d '=' -f2)
DB_USERNAME=$(grep DB_USERNAME .env | cut -d '=' -f2)
DB_PASSWORD=$(grep DB_PASSWORD .env | cut -d '=' -f2)

# Удаляем кавычки если есть
DB_HOST=$(echo $DB_HOST | tr -d '"')
DB_PORT=$(echo $DB_PORT | tr -d '"')
DB_DATABASE=$(echo $DB_DATABASE | tr -d '"')
DB_USERNAME=$(echo $DB_USERNAME | tr -d '"')
DB_PASSWORD=$(echo $DB_PASSWORD | tr -d '"')

echo -e "${YELLOW}База данных: ${DB_DATABASE}${NC}"
echo -e "${YELLOW}Хост: ${DB_HOST}${NC}"
echo -e "${YELLOW}Порт: ${DB_PORT}${NC}"
echo ""

# Имя файла дампа
DUMP_FILE="shop_full_dump_$(date +%Y%m%d_%H%M%S).sql"

echo -e "${GREEN}Создаю дамп...${NC}"

# Создаём полный дамп
mysqldump \
  --host="${DB_HOST}" \
  --port="${DB_PORT}" \
  --user="${DB_USERNAME}" \
  --password="${DB_PASSWORD}" \
  --databases "${DB_DATABASE}" \
  --add-drop-table \
  --add-locks \
  --extended-insert \
  --single-transaction \
  --quick \
  --routines \
  --triggers \
  > "${DUMP_FILE}"

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓ Дамп успешно создан: ${DUMP_FILE}${NC}"

    # Показываем размер файла
    SIZE=$(du -h "${DUMP_FILE}" | cut -f1)
    echo -e "${GREEN}✓ Размер файла: ${SIZE}${NC}"

    # Подсчитываем количество строк INSERT
    INSERTS=$(grep -c "INSERT INTO" "${DUMP_FILE}")
    echo -e "${GREEN}✓ Количество INSERT операций: ${INSERTS}${NC}"

    echo ""
    echo -e "${YELLOW}Для восстановления на другом сервере используйте:${NC}"
    echo "mysql -u USER -p DATABASE_NAME < ${DUMP_FILE}"
    echo ""
    echo -e "${GREEN}Готово!${NC}"
else
    echo -e "${RED}✗ Ошибка при создании дампа${NC}"
    exit 1
fi
