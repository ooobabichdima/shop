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
        pre { background: #000; padding: 10px; border-radius: 5px; overflow-x: auto; white-space: pre-wrap; word-wrap: break-word; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px; border-bottom: 1px solid #444; }
        td:first-child { font-weight: bold; width: 200px; }
        code { background: #000; padding: 2px 6px; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>🔍 Laravel Debug Information</h1>

    <div class="section">
        <h2>Environment</h2>
        <table>
            <tr>
                <td>APP_ENV</td>
                <td>{{ env('APP_ENV', 'not set') }}</td>
            </tr>
            <tr>
                <td>APP_DEBUG</td>
                <td class="{{ env('APP_DEBUG') ? 'success' : 'error' }}">
                    {{ env('APP_DEBUG') ? 'true' : 'false' }}
                </td>
            </tr>
            <tr>
                <td>DB_CONNECTION</td>
                <td>{{ env('DB_CONNECTION', 'not set') }}</td>
            </tr>
            <tr>
                <td>DB_DATABASE</td>
                <td>{{ env('DB_DATABASE', 'not set') }}</td>
            </tr>
            <tr>
                <td>Laravel Version</td>
                <td>{{ app()->version() }}</td>
            </tr>
            <tr>
                <td>PHP Version</td>
                <td>{{ PHP_VERSION }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Database Connection</h2>
        @php
        try {
            \Illuminate\Support\Facades\DB::connection()->getPdo();
            echo '<p class="success">✓ Database connection successful</p>';

            // Check if products table exists
            $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
            echo '<p>Tables found: ' . count($tables) . '</p>';

            // Check products table structure
            if (\Illuminate\Support\Facades\Schema::hasTable('products')) {
                echo '<p class="success">✓ Products table exists</p>';
                $columns = \Illuminate\Support\Facades\DB::select('DESCRIBE products');
                echo '<h3>Products table columns:</h3><pre>';
                foreach ($columns as $column) {
                    $marker = '';
                    if ($column->Field === 'tuning_kits') {
                        $marker = ' ← NEW COLUMN';
                    }
                    echo $column->Field . ' - ' . $column->Type . $marker . "\n";
                }
                echo '</pre>';

                // Check if tuning_kits column exists
                if (\Illuminate\Support\Facades\Schema::hasColumn('products', 'tuning_kits')) {
                    echo '<p class="success">✓ tuning_kits column exists</p>';
                } else {
                    echo '<p class="error">✗ tuning_kits column MISSING - run migration!</p>';
                    echo '<p style="margin-top:10px;">Run this command:</p>';
                    echo '<pre>php artisan migrate --force</pre>';
                }
            } else {
                echo '<p class="error">✗ Products table does not exist</p>';
                echo '<p>Run migrations first:</p>';
                echo '<pre>php artisan migrate --force</pre>';
            }
        } catch (\Exception $e) {
            echo '<p class="error">✗ Database connection failed</p>';
            echo '<pre>' . htmlspecialchars($e->getMessage()) . '</pre>';
        }
        @endphp
    </div>

    <div class="section">
        <h2>Products Check</h2>
        @php
        try {
            $product = \App\Models\Product::first();
            if ($product) {
                echo '<p class="success">✓ Found product: ' . htmlspecialchars($product->name) . '</p>';
                echo '<p>Product ID: ' . $product->id . ' | SKU: ' . $product->sku . '</p>';

                echo '<h3>Product Attributes:</h3>';
                echo '<table>';
                echo '<tr><td>Name</td><td>' . htmlspecialchars($product->name) . '</td></tr>';
                echo '<tr><td>Price</td><td>' . number_format($product->price, 0) . ' грн</td></tr>';
                echo '<tr><td>Stock</td><td>' . $product->stock . '</td></tr>';
                echo '<tr><td>Category</td><td>' . ($product->category ? $product->category->name : 'N/A') . '</td></tr>';
                echo '<tr><td>Brand</td><td>' . ($product->brand ? $product->brand->name : 'N/A') . '</td></tr>';
                echo '</table>';

                echo '<h3>Tuning Kits:</h3>';
                if (isset($product->tuning_kits)) {
                    if (is_array($product->tuning_kits) && count($product->tuning_kits) > 0) {
                        echo '<p class="success">✓ Found ' . count($product->tuning_kits) . ' tuning kits</p>';
                        echo '<pre>';
                        foreach ($product->tuning_kits as $index => $kit) {
                            echo ($index + 1) . ". " . ($kit['name'] ?? 'No name') . " - " . ($kit['price'] ?? 0) . " грн\n";
                        }
                        echo '</pre>';
                    } else {
                        echo '<p class="warning">⚠ tuning_kits is empty array</p>';
                    }
                } else {
                    echo '<p class="warning">⚠ tuning_kits attribute not set (this is OK if column was just added)</p>';
                }

                echo '<h3>Recommended Products:</h3>';
                if ($product->recommended) {
                    $count = $product->recommended->count();
                    if ($count > 0) {
                        echo '<p class="success">✓ Found ' . $count . ' recommended products</p>';
                        echo '<pre>';
                        foreach ($product->recommended as $rec) {
                            echo "- " . htmlspecialchars($rec->name) . " (" . number_format($rec->price, 0) . " грн)\n";
                        }
                        echo '</pre>';
                    } else {
                        echo '<p class="warning">⚠ No recommended products linked</p>';
                    }
                } else {
                    echo '<p class="warning">⚠ Recommended products relationship not loaded</p>';
                }
            } else {
                echo '<p class="error">✗ No products found in database</p>';
                echo '<p>Run seeder to add products:</p>';
                echo '<pre>php artisan db:seed --force</pre>';
            }
        } catch (\Exception $e) {
            echo '<p class="error">✗ Error loading product</p>';
            echo '<pre>' . htmlspecialchars($e->getMessage()) . '</pre>';
            echo '<details><summary>Stack trace</summary><pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre></details>';
        }
        @endphp
    </div>

    <div class="section">
        <h2>Migrations Status</h2>
        @php
        try {
            $migrations = \Illuminate\Support\Facades\DB::table('migrations')->orderBy('id', 'desc')->limit(10)->get();
            if ($migrations->count() > 0) {
                echo '<p class="success">✓ Found ' . $migrations->count() . ' recent migrations</p>';
                echo '<table>';
                echo '<tr><th>Migration</th><th>Batch</th></tr>';
                foreach ($migrations as $migration) {
                    echo '<tr><td>' . htmlspecialchars($migration->migration) . '</td><td>' . $migration->batch . '</td></tr>';
                }
                echo '</table>';
            } else {
                echo '<p class="warning">⚠ No migrations found</p>';
            }
        } catch (\Exception $e) {
            echo '<p class="error">✗ Could not check migrations</p>';
            echo '<pre>' . htmlspecialchars($e->getMessage()) . '</pre>';
        }
        @endphp
    </div>

    <div class="section">
        <h2>Recent Error Log (last 30 lines)</h2>
        @php
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            $lines = file($logFile);
            $recentLines = array_slice($lines, -30);
            if (count($recentLines) > 0) {
                echo '<pre>' . htmlspecialchars(implode('', $recentLines)) . '</pre>';
            } else {
                echo '<p class="success">✓ No errors logged</p>';
            }
        } else {
            echo '<p class="warning">⚠ No log file found (this is OK)</p>';
        }
        @endphp
    </div>

    <div class="section">
        <h2>Quick Actions</h2>
        <p>
            <a href="/" style="color: #58ff7a; text-decoration: none; border: 1px solid #58ff7a; padding: 8px 12px; border-radius: 5px; display: inline-block; margin: 5px;">
                → Homepage
            </a>
            <a href="/product/aeg-m4-ris-cqb-cyma" style="color: #58ff7a; text-decoration: none; border: 1px solid #58ff7a; padding: 8px 12px; border-radius: 5px; display: inline-block; margin: 5px;">
                → Test Product Page
            </a>
            <a href="/admin/products" style="color: #58ff7a; text-decoration: none; border: 1px solid #58ff7a; padding: 8px 12px; border-radius: 5px; display: inline-block; margin: 5px;">
                → Admin Products
            </a>
        </p>
    </div>

    <div class="section">
        <h2>Commands to Fix Issues</h2>
        <h3>If tuning_kits column is missing:</h3>
        <pre>cd /home/user/shop
php artisan migrate --force</pre>

        <h3>If no products found:</h3>
        <pre>cd /home/user/shop
php artisan db:seed --force</pre>

        <h3>Clear all caches:</h3>
        <pre>cd /home/user/shop
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear</pre>
    </div>
</body>
</html>
