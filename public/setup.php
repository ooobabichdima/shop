<?php
/**
 * Автоматическая установка Strikeball Shop
 *
 * Использование:
 * 1. Загрузите все файлы на хостинг
 * 2. Откройте http://ваш-домен.com/setup.php в браузере
 * 3. Следуйте инструкциям
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Проверка уже установленного приложения
if (file_exists(__DIR__.'/../.env') && filesize(__DIR__.'/../.env') > 100) {
    die('⚠️ Приложение уже установлено! Удалите файл .env для переустановки.');
}

$step = $_GET['step'] ?? 1;
$basePath = dirname(__DIR__);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Установка Strikeball Shop</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, -apple-system, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); overflow: hidden; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
        .header h1 { font-size: 28px; margin-bottom: 10px; }
        .header p { opacity: 0.9; }
        .content { padding: 30px; }
        .step { background: #f0f0f0; padding: 8px 16px; border-radius: 20px; display: inline-block; margin-bottom: 20px; font-weight: 600; }
        input[type="text"], input[type="password"], input[type="url"] { width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; margin-bottom: 15px; }
        input:focus { outline: none; border-color: #667eea; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: #333; }
        .btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 14px 28px; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; width: 100%; margin-top: 10px; }
        .btn:hover { opacity: 0.9; }
        .success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .info { background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .checklist { list-style: none; }
        .checklist li { padding: 10px 0; border-bottom: 1px solid #eee; }
        .checklist li:before { content: "✓"; color: #28a745; font-weight: bold; margin-right: 10px; }
        .checklist li.error:before { content: "✗"; color: #dc3545; }
        .code { background: #f5f5f5; padding: 10px; border-radius: 6px; font-family: monospace; margin: 10px 0; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛒 Strikeball Shop</h1>
            <p>Автоматическая установка</p>
        </div>
        <div class="content">
            <?php if ($step == 1): ?>
                <!-- Шаг 1: Проверка системы -->
                <div class="step">Шаг 1 из 3</div>
                <h2 style="margin-bottom: 20px;">Проверка системы</h2>

                <?php
                $checks = [
                    'PHP >= 8.2' => version_compare(PHP_VERSION, '8.2.0', '>='),
                    'PDO Extension' => extension_loaded('pdo'),
                    'PDO MySQL' => extension_loaded('pdo_mysql'),
                    'Mbstring Extension' => extension_loaded('mbstring'),
                    'XML Extension' => extension_loaded('xml'),
                    'BCMath Extension' => extension_loaded('bcmath'),
                    'Writable storage/' => is_writable($basePath.'/storage'),
                    'Writable bootstrap/cache/' => is_writable($basePath.'/bootstrap/cache'),
                ];

                $allPassed = !in_array(false, $checks, true);
                ?>

                <ul class="checklist">
                    <?php foreach ($checks as $name => $passed): ?>
                        <li class="<?= $passed ? '' : 'error' ?>"><?= $name ?></li>
                    <?php endforeach; ?>
                </ul>

                <?php if ($allPassed): ?>
                    <div class="success">✓ Все проверки пройдены!</div>
                    <a href="?step=2"><button class="btn">Продолжить →</button></a>
                <?php else: ?>
                    <div class="error">⚠️ Некоторые требования не выполнены. Обратитесь к хостинг-провайдеру.</div>
                <?php endif; ?>

            <?php elseif ($step == 2): ?>
                <!-- Шаг 2: Настройка БД -->
                <div class="step">Шаг 2 из 3</div>
                <h2 style="margin-bottom: 20px;">Настройка базы данных</h2>

                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                    <?php
                    $dbHost = $_POST['db_host'] ?? 'localhost';
                    $dbName = $_POST['db_name'] ?? '';
                    $dbUser = $_POST['db_user'] ?? '';
                    $dbPass = $_POST['db_pass'] ?? '';
                    $appUrl = $_POST['app_url'] ?? '';

                    // Проверка подключения к БД
                    try {
                        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
                        $pdo = new PDO($dsn, $dbUser, $dbPass, [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        ]);

                        // Создание .env файла
                        $envContent = file_get_contents($basePath.'/.env.production');
                        $envContent = str_replace('your_database_name', $dbName, $envContent);
                        $envContent = str_replace('your_database_user', $dbUser, $envContent);
                        $envContent = str_replace('your_database_password', $dbPass, $envContent);
                        $envContent = str_replace('DB_HOST=localhost', "DB_HOST=$dbHost", $envContent);
                        $envContent = str_replace('http://yourdomain.com', $appUrl, $envContent);

                        file_put_contents($basePath.'/.env', $envContent);

                        echo '<div class="success">✓ База данных подключена успешно!</div>';
                        echo '<a href="?step=3"><button class="btn">Установить приложение →</button></a>';
                    } catch (PDOException $e) {
                        echo '<div class="error">❌ Ошибка подключения к БД: ' . htmlspecialchars($e->getMessage()) . '</div>';
                        echo '<a href="?step=2"><button class="btn">← Попробовать снова</button></a>';
                    }
                    ?>
                <?php else: ?>
                    <div class="info">
                        <strong>Где найти данные БД?</strong><br>
                        В панели хостинга (cPanel) → Базы данных MySQL<br>
                        Создайте новую базу, если её нет.
                    </div>

                    <form method="POST">
                        <label>URL сайта</label>
                        <input type="url" name="app_url" value="<?= 'http://'.$_SERVER['HTTP_HOST'] ?>" required>

                        <label>Хост БД (обычно localhost)</label>
                        <input type="text" name="db_host" value="localhost" required>

                        <label>Имя базы данных</label>
                        <input type="text" name="db_name" placeholder="strikeball_db" required>

                        <label>Пользователь БД</label>
                        <input type="text" name="db_user" placeholder="db_user" required>

                        <label>Пароль БД</label>
                        <input type="password" name="db_pass" placeholder="••••••••" required>

                        <button type="submit" class="btn">Проверить и продолжить →</button>
                    </form>
                <?php endif; ?>

            <?php elseif ($step == 3): ?>
                <!-- Шаг 3: Установка -->
                <div class="step">Шаг 3 из 3</div>
                <h2 style="margin-bottom: 20px;">Установка приложения</h2>

                <?php
                if (!file_exists($basePath.'/.env')) {
                    die('<div class="error">Файл .env не найден. Вернитесь на шаг 2.</div>');
                }

                // Загрузка Laravel для выполнения команд
                require $basePath.'/vendor/autoload.php';

                $app = require_once $basePath.'/bootstrap/app.php';
                $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

                echo '<div class="info">Выполняется установка...</div>';

                // Генерация ключа
                ob_start();
                $kernel->call('key:generate', ['--force' => true]);
                $output = ob_get_clean();
                echo '<div class="code">✓ APP_KEY сгенерирован</div>';

                // Миграции
                ob_start();
                $kernel->call('migrate', ['--force' => true, '--seed' => true]);
                $output = ob_get_clean();
                echo '<div class="code">✓ База данных создана и заполнена</div>';

                // Кеширование
                ob_start();
                $kernel->call('config:cache');
                $kernel->call('route:cache');
                $kernel->call('view:cache');
                ob_get_clean();
                echo '<div class="code">✓ Кеш создан</div>';

                echo '<div class="success">';
                echo '<h3>🎉 Установка завершена!</h3><br>';
                echo '<strong>Доступ к админке:</strong><br>';
                echo 'URL: <a href="/admin" target="_blank">'.($_SERVER['REQUEST_SCHEME'] ?? 'http').'://'.$_SERVER['HTTP_HOST'].'/admin</a><br>';
                echo 'Email: <code>admin@example.com</code><br>';
                echo 'Password: <code>password</code><br><br>';
                echo '<strong>⚠️ ВАЖНО: Смените пароль после входа!</strong>';
                echo '</div>';

                echo '<div style="margin-top: 20px;">';
                echo '<a href="/"><button class="btn">Открыть магазин →</button></a>';
                echo '<a href="/admin"><button class="btn" style="margin-top: 10px;">Войти в админку →</button></a>';
                echo '</div>';

                echo '<div class="info" style="margin-top: 20px;">';
                echo '<strong>После установки:</strong><br>';
                echo '1. Удалите файл <code>public/setup.php</code> для безопасности<br>';
                echo '2. Получите реальные API ключи (Nova Poshta, Monobank)<br>';
                echo '3. Загрузите изображения товаров';
                echo '</div>';
                ?>

            <?php endif; ?>
        </div>
    </div>
</body>
</html>
