<!DOCTYPE html>
<html>
<head>
    <title>Debug Info</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #1a1a1a; color: #fff; }
        .section { margin: 20px 0; padding: 15px; background: #2a2a2a; border-radius: 8px; }
        h2 { color: #58ff7a; margin-top: 0; }
        .error { color: #ff4d4d; }
        .success { color: #58ff7a; }
        .warning { color: #ffcc00; }
        pre { background: #000; padding: 10px; border-radius: 5px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px; border-bottom: 1px solid #444; }
        td:first-child { font-weight: bold; width: 200px; }
    </style>
</head>
<body>
    <h1>🔍 Laravel Debug Information</h1>

    <div class="section">
        <h2>Environment</h2>
        <table>
            <tr>
                <td>APP_ENV</td>
                <td><?php echo env('APP_ENV', 'not set'); ?></td>
            </tr>
            <tr>
                <td>APP_DEBUG</td>
                <td class="<?php echo env('APP_DEBUG') ? 'success' : 'error'; ?>">
                    <?php echo env('APP_DEBUG') ? 'true' : 'false'; ?>
                </td>
            </tr>
            <tr>
                <td>DB_CONNECTION</td>
                <td><?php echo env('DB_CONNECTION', 'not set'); ?></td>
            </tr>
            <tr>
                <td>DB_DATABASE</td>
                <td><?php echo env('DB_DATABASE', 'not set'); ?></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Database Connection</h2>
        <?php
        try {
            DB::connection()->getPdo();
            echo '<p class="success">✓ Database connection successful</p>';

            // Check if products table exists
            $tables = DB::select('SHOW TABLES');
            echo '<p>Tables found: ' . count($tables) . '</p>';

            // Check products table structure
            if (Schema::hasTable('products')) {
                echo '<p class="success">✓ Products table exists</p>';
                $columns = DB::select('DESCRIBE products');
                echo '<h3>Products table columns:</h3><pre>';
                foreach ($columns as $column) {
                    echo $column->Field . ' - ' . $column->Type . "\n";
                }
                echo '</pre>';

                // Check if tuning_kits column exists
                if (Schema::hasColumn('products', 'tuning_kits')) {
                    echo '<p class="success">✓ tuning_kits column exists</p>';
                } else {
                    echo '<p class="error">✗ tuning_kits column MISSING - run migration!</p>';
                }
            } else {
                echo '<p class="error">✗ Products table does not exist</p>';
            }
        } catch (\Exception $e) {
            echo '<p class="error">✗ Database connection failed: ' . $e->getMessage() . '</p>';
        }
        ?>
    </div>

    <div class="section">
        <h2>Products Check</h2>
        <?php
        try {
            $product = App\Models\Product::first();
            if ($product) {
                echo '<p class="success">✓ Found product: ' . $product->name . '</p>';
                echo '<h3>Product attributes:</h3>';
                echo '<pre>';
                print_r($product->getAttributes());
                echo '</pre>';

                echo '<h3>Tuning Kits:</h3>';
                if (isset($product->tuning_kits)) {
                    echo '<pre>';
                    print_r($product->tuning_kits);
                    echo '</pre>';
                } else {
                    echo '<p class="warning">⚠ tuning_kits attribute not accessible</p>';
                }

                echo '<h3>Recommended Products:</h3>';
                if ($product->recommended) {
                    echo '<p class="success">✓ Found ' . $product->recommended->count() . ' recommended products</p>';
                } else {
                    echo '<p class="warning">⚠ No recommended products</p>';
                }
            } else {
                echo '<p class="error">✗ No products found in database</p>';
            }
        } catch (\Exception $e) {
            echo '<p class="error">✗ Error loading product: ' . $e->getMessage() . '</p>';
            echo '<pre>' . $e->getTraceAsString() . '</pre>';
        }
        ?>
    </div>

    <div class="section">
        <h2>Recent Error Log</h2>
        <?php
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            $lines = file($logFile);
            $recentLines = array_slice($lines, -50);
            echo '<pre>' . htmlspecialchars(implode('', $recentLines)) . '</pre>';
        } else {
            echo '<p class="warning">⚠ No log file found</p>';
        }
        ?>
    </div>

    <div class="section">
        <h2>Actions</h2>
        <p><a href="/product/aeg-m4-ris-cqb-cyma" style="color: #58ff7a;">→ Try to view product page</a></p>
        <p><a href="/" style="color: #58ff7a;">→ Go to homepage</a></p>
    </div>
</body>
</html>
