<?php
/**
 * Автоматическая установка Strikeball Shop
 * Просто загрузите файлы на хостинг и откройте этот файл
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

$step = $_GET['step'] ?? 1;
$basePath = dirname(__DIR__);

// Проверка уже установленного
if (file_exists($basePath.'/.env') && filesize($basePath.'/.env') > 100 && $step == 1) {
    die('⚠️ Приложение уже установлено! <a href="/">Открыть магазин</a> | <a href="/admin">Админка</a>');
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Установка Strikeball Shop</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 700px; margin: 0 auto; background: white; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); overflow: hidden; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
        .header h1 { font-size: 28px; margin-bottom: 10px; }
        .content { padding: 30px; }
        .step { background: #f0f0f0; padding: 8px 16px; border-radius: 20px; display: inline-block; margin-bottom: 20px; font-weight: 600; }
        input, select { width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; margin-bottom: 15px; }
        input:focus { outline: none; border-color: #667eea; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: #333; }
        .btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 14px 28px; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; width: 100%; margin-top: 10px; text-decoration: none; display: inline-block; text-align: center; }
        .btn:hover { opacity: 0.9; }
        .success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .warning { background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .info { background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .code { background: #f5f5f5; padding: 10px; border-radius: 6px; font-family: monospace; margin: 10px 0; overflow-x: auto; }
        pre { background: #2d2d2d; color: #f8f8f2; padding: 15px; border-radius: 8px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛒 Strikeball Shop</h1>
            <p>Простая установка за 2 минуты</p>
        </div>
        <div class="content">
            <?php if ($step == 1): ?>
                <!-- Шаг 1: Проверка -->
                <div class="step">Шаг 1 из 3</div>
                <h2 style="margin-bottom: 20px;">Проверка системы</h2>

                <?php
                // Проверка Laravel зависимостей
                $vendorExists = file_exists($basePath.'/vendor/autoload.php');
                $laravelInstalled = false;

                if ($vendorExists) {
                    require_once $basePath.'/vendor/autoload.php';
                    $laravelInstalled = class_exists('Illuminate\Foundation\Application');
                }

                $checks = [
                    'PHP >= 8.2' => version_compare(PHP_VERSION, '8.2.0', '>='),
                    'PDO MySQL' => extension_loaded('pdo_mysql'),
                    'Mbstring' => extension_loaded('mbstring'),
                    'Папка vendor/' => $vendorExists,
                    'Laravel установлен' => $laravelInstalled,
                ];

                $allPassed = !in_array(false, $checks, true);
                ?>

                <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <?php foreach ($checks as $name => $passed): ?>
                        <div style="padding: 8px 0; border-bottom: 1px solid #eee;">
                            <?= $passed ? '✅' : '❌' ?> <?= $name ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (!$vendorExists || !$laravelInstalled): ?>
                    <div class="warning">
                        <h3>⚠️ <?= !$vendorExists ? 'Отсутствует папка vendor/' : 'Laravel зависимости неполные' ?></h3>

                        <p style="margin: 15px 0;"><strong>Решение 1: Через SSH</strong></p>
                        <pre>cd <?= $basePath ?>

# Удалите неполный vendor (если есть)
rm -rf vendor/

# Установите заново
composer install --no-dev --optimize-autoloader</pre>

                        <p style="margin: 15px 0;"><strong>Решение 2: Загрузить готовый vendor/</strong></p>
                        <p>1. На локальной машине запустите:</p>
                        <pre>cd /home/user/shop
composer install --no-dev --optimize-autoloader
zip -r vendor.zip vendor/</pre>

                        <p>2. Загрузите <code>vendor.zip</code> на хостинг</p>
                        <p>3. Распакуйте в <code><?= $basePath ?>/vendor/</code></p>
                        <p>4. Перезагрузите эту страницу</p>

                        <p style="margin: 15px 0;"><strong>Решение 3: Готовый архив</strong></p>
                        <p>Запустите локально скрипт подготовки:</p>
                        <pre>bash prepare-for-hosting.sh</pre>
                        <p>И загрузите созданный архив <code>shop-hosting-ready.zip</code></p>
                    </div>
                <?php endif; ?>

                <?php if ($allPassed): ?>
                    <div class="success">✅ Всё готово к установке!</div>
                    <a href="?step=2" class="btn">Продолжить →</a>
                <?php else: ?>
                    <div class="error">Исправьте ошибки выше и перезагрузите страницу.</div>
                <?php endif; ?>

            <?php elseif ($step == 2): ?>
                <!-- Шаг 2: База данных -->
                <div class="step">Шаг 2 из 3</div>
                <h2 style="margin-bottom: 20px;">Настройка базы данных</h2>

                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                    <?php
                    $dbHost = $_POST['db_host'] ?? 'localhost';
                    $dbName = $_POST['db_name'] ?? '';
                    $dbUser = $_POST['db_user'] ?? '';
                    $dbPass = $_POST['db_pass'] ?? '';
                    $appUrl = $_POST['app_url'] ?? '';

                    // Проверка БД
                    try {
                        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass, [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        ]);

                        // Создание .env с нуля
                        $envContent = "APP_NAME=\"Strikeball Shop\"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=Europe/Kyiv
APP_URL=$appUrl

DB_CONNECTION=mysql
DB_HOST=$dbHost
DB_PORT=3306
DB_DATABASE=$dbName
DB_USERNAME=$dbUser
DB_PASSWORD=$dbPass

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database
LOG_CHANNEL=stack

NOVAPOSHTA_MODE=sandbox
MONO_MODE=sandbox
";

                        file_put_contents($basePath.'/.env', $envContent);

                        echo '<div class="success">✅ База данных подключена!</div>';
                        echo '<a href="?step=3" class="btn">Установить приложение →</a>';
                    } catch (PDOException $e) {
                        echo '<div class="error">❌ Ошибка: ' . htmlspecialchars($e->getMessage()) . '</div>';
                        echo '<a href="?step=2" class="btn">← Попробовать снова</a>';
                    }
                    ?>
                <?php else: ?>
                    <div class="info">
                        <strong>📍 Где найти данные?</strong><br>
                        В cPanel → Базы данных MySQL → Создайте новую базу
                    </div>

                    <form method="POST">
                        <label>URL вашего сайта</label>
                        <input type="url" name="app_url" value="<?= 'http://'.$_SERVER['HTTP_HOST'] ?>" required>

                        <label>Хост БД</label>
                        <input type="text" name="db_host" value="localhost" required>

                        <label>Имя базы данных</label>
                        <input type="text" name="db_name" placeholder="strikeball_db" required>

                        <label>Пользователь БД</label>
                        <input type="text" name="db_user" placeholder="db_user" required>

                        <label>Пароль БД</label>
                        <input type="password" name="db_pass" required>

                        <button type="submit" class="btn">Подключить →</button>
                    </form>
                <?php endif; ?>

            <?php elseif ($step == 3): ?>
                <!-- Шаг 3: Установка -->
                <div class="step">Шаг 3 из 3</div>
                <h2 style="margin-bottom: 20px;">Установка</h2>

                <?php
                if (!file_exists($basePath.'/.env')) {
                    die('<div class="error">Файл .env не найден. <a href="?step=2">Вернитесь на шаг 2</a>.</div>');
                }

                if (!file_exists($basePath.'/vendor/autoload.php')) {
                    die('<div class="error">Отсутствуют зависимости Composer. <a href="?step=1">Вернитесь на шаг 1</a>.</div>');
                }

                try {
                    require $basePath.'/vendor/autoload.php';

                    // Проверка что Laravel установлен
                    if (!class_exists('Illuminate\Foundation\Application')) {
                        throw new Exception('Laravel зависимости неполные. Папка vendor/ повреждена или установлена не полностью. Удалите vendor/ и установите заново через: composer install --no-dev --optimize-autoloader');
                    }

                    $app = require_once $basePath.'/bootstrap/app.php';
                    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

                    echo '<div class="info">⏳ Установка...</div>';

                    // Генерация ключа
                    ob_start();
                    $kernel->call('key:generate', ['--force' => true]);
                    ob_get_clean();
                    echo '<div class="code">✅ Ключ сгенерирован</div>';

                    // Миграции
                    ob_start();
                    $kernel->call('migrate', ['--force' => true, '--seed' => true]);
                    ob_get_clean();
                    echo '<div class="code">✅ База данных создана (50+ товаров)</div>';

                    // Кеш
                    ob_start();
                    $kernel->call('config:cache');
                    $kernel->call('route:cache');
                    $kernel->call('view:cache');
                    ob_get_clean();
                    echo '<div class="code">✅ Кеш создан</div>';

                    echo '<div class="success">';
                    echo '<h2 style="margin-bottom: 15px;">🎉 Готово!</h2>';
                    echo '<p><strong>Админка:</strong> <a href="/admin">'.$_SERVER['HTTP_HOST'].'/admin</a></p>';
                    echo '<p><strong>Email:</strong> admin@example.com</p>';
                    echo '<p><strong>Пароль:</strong> password</p>';
                    echo '<p style="margin-top: 15px; color: #856404;">⚠️ Смените пароль после входа!</p>';
                    echo '</div>';

                    echo '<a href="/" class="btn" style="margin-bottom: 10px;">Открыть магазин</a>';
                    echo '<a href="/admin" class="btn">Войти в админку</a>';

                    echo '<div class="warning" style="margin-top: 20px;">';
                    echo '<strong>После установки:</strong><br>';
                    echo '1. Удалите файл <code>public/setup.php</code><br>';
                    echo '2. Смените пароль админа';
                    echo '</div>';

                } catch (Exception $e) {
                    echo '<div class="error">❌ Ошибка: ' . htmlspecialchars($e->getMessage()) . '</div>';
                    echo '<div class="code">' . htmlspecialchars($e->getTraceAsString()) . '</div>';
                }
                ?>

            <?php endif; ?>
        </div>
    </div>
</body>
</html>
