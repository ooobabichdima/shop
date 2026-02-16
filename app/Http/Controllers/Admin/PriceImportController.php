<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PriceImportController extends Controller
{
    public function index()
    {
        return view('admin.import.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx|max:10240', // 10MB max
            'format' => 'required|in:csv,excel',
        ]);

        $file = $request->file('file');
        $format = $request->format;

        try {
            if ($format === 'csv') {
                $result = $this->processCsv($file);
            } else {
                return back()->with('error', 'Excel імпорт буде доданий пізніше. Використовуйте CSV формат.');
            }

            return back()->with('success',
                "Імпорт завершено успішно! " .
                "Оновлено: {$result['updated']}, " .
                "Створено: {$result['created']}, " .
                "Пропущено: {$result['skipped']}, " .
                "Помилок: {$result['errors']}"
            )->with('import_log', $result['log']);

        } catch (\Exception $e) {
            return back()->with('error', 'Помилка імпорту: ' . $e->getMessage());
        }
    }

    protected function processCsv($file)
    {
        $updated = 0;
        $created = 0;
        $skipped = 0;
        $errors = 0;
        $log = [];

        $handle = fopen($file->getRealPath(), 'r');

        // Read header row
        $header = fgetcsv($handle, 1000, ';');

        if (!$header) {
            fclose($handle);
            throw new \Exception('Файл порожній або має невірний формат');
        }

        // Expected columns: SKU, Name, Price, Old Price, Stock, Category, Brand
        $expectedColumns = ['sku', 'name', 'price', 'old_price', 'stock', 'category', 'brand'];

        $row = 1;
        while (($data = fgetcsv($handle, 1000, ';')) !== false) {
            $row++;

            if (count($data) < 3) {
                $log[] = "Рядок {$row}: Недостатньо колонок";
                $skipped++;
                continue;
            }

            // Map data to columns
            $sku = trim($data[0] ?? '');
            $name = trim($data[1] ?? '');
            $price = trim($data[2] ?? '');
            $oldPrice = trim($data[3] ?? '') ?: null;
            $stock = trim($data[4] ?? '') ?: 0;
            $categoryName = trim($data[5] ?? '');
            $brandName = trim($data[6] ?? '');

            // Validate required fields
            if (empty($sku) || empty($name) || empty($price)) {
                $log[] = "Рядок {$row}: Пропущено (відсутні обов'язкові поля)";
                $skipped++;
                continue;
            }

            // Validate price
            if (!is_numeric($price) || $price < 0) {
                $log[] = "Рядок {$row}: Невірна ціна '{$price}'";
                $errors++;
                continue;
            }

            // Find or create category
            $category = null;
            if (!empty($categoryName)) {
                $category = Category::firstOrCreate(
                    ['name' => $categoryName],
                    [
                        'slug' => Str::slug($categoryName),
                        'is_active' => true,
                    ]
                );
            }

            // Find or create brand
            $brand = null;
            if (!empty($brandName)) {
                $brand = Brand::firstOrCreate(
                    ['name' => $brandName],
                    [
                        'slug' => Str::slug($brandName),
                        'is_active' => true,
                    ]
                );
            }

            // Find existing product by SKU
            $product = Product::where('sku', $sku)->first();

            if ($product) {
                // Update existing product
                $product->update([
                    'name' => $name,
                    'price' => $price,
                    'old_price' => $oldPrice && is_numeric($oldPrice) ? $oldPrice : null,
                    'stock' => is_numeric($stock) ? (int)$stock : 0,
                    'category_id' => $category ? $category->id : $product->category_id,
                    'brand_id' => $brand ? $brand->id : $product->brand_id,
                ]);
                $log[] = "Рядок {$row}: Оновлено товар '{$name}' (SKU: {$sku})";
                $updated++;
            } else {
                // Create new product
                if (!$category) {
                    // Default category if not specified
                    $category = Category::first();
                    if (!$category) {
                        $log[] = "Рядок {$row}: Пропущено (відсутня категорія)";
                        $errors++;
                        continue;
                    }
                }

                $slug = Str::slug($name);
                $originalSlug = $slug;
                $count = 1;
                while (Product::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }

                Product::create([
                    'sku' => $sku,
                    'name' => $name,
                    'slug' => $slug,
                    'price' => $price,
                    'old_price' => $oldPrice && is_numeric($oldPrice) ? $oldPrice : null,
                    'stock' => is_numeric($stock) ? (int)$stock : 0,
                    'category_id' => $category->id,
                    'brand_id' => $brand ? $brand->id : null,
                    'is_active' => true,
                ]);
                $log[] = "Рядок {$row}: Створено новий товар '{$name}' (SKU: {$sku})";
                $created++;
            }
        }

        fclose($handle);

        return [
            'updated' => $updated,
            'created' => $created,
            'skipped' => $skipped,
            'errors' => $errors,
            'log' => $log,
        ];
    }
}
