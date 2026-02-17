<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $products = Product::where('is_active', true)->orderBy('name')->get();

        return view('admin.products.create', compact('categories', 'brands', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'sku' => 'required|string|max:100|unique:products,sku',
            'description' => 'nullable|string',
            'youtube_url' => 'nullable|url',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'specs' => 'nullable|string',
            'tuning_kits' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'is_new' => 'boolean',
            'recommended_products' => 'nullable|array',
            'recommended_products.*' => 'exists:products,id',
        ]);

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        // Decode JSON fields
        if (!empty($validated['specs'])) {
            $specs = json_decode($validated['specs'], true);
            $validated['specs'] = $specs ?: null;
        }

        if (!empty($validated['tuning_kits'])) {
            $tuningKits = json_decode($validated['tuning_kits'], true);
            $validated['tuning_kits'] = $tuningKits ?: null;
        }

        $recommendedProducts = $validated['recommended_products'] ?? [];
        unset($validated['recommended_products']);

        $product = Product::create($validated);

        // Sync recommended products
        if (!empty($recommendedProducts)) {
            $syncData = [];
            foreach ($recommendedProducts as $index => $productId) {
                $syncData[$productId] = [
                    'type' => 'recommended',
                    'sort_order' => $index
                ];
            }
            $product->recommended()->sync($syncData);
        }

        return redirect()->route('admin.products.index')->with('success', 'Товар створено успішно');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $products = Product::where('is_active', true)->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'products'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'youtube_url' => 'nullable|url',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'specs' => 'nullable|string',
            'tuning_kits' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'is_new' => 'boolean',
            'recommended_products' => 'nullable|array',
            'recommended_products.*' => 'exists:products,id',
        ]);

        // Update slug if name changed
        if ($validated['name'] !== $product->name) {
            $validated['slug'] = Str::slug($validated['name']);

            // Ensure unique slug
            $originalSlug = $validated['slug'];
            $count = 1;
            while (Product::where('slug', $validated['slug'])->where('id', '!=', $product->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Decode JSON fields
        if (!empty($validated['specs'])) {
            $specs = json_decode($validated['specs'], true);
            $validated['specs'] = $specs ?: null;
        } else {
            $validated['specs'] = null;
        }

        if (!empty($validated['tuning_kits'])) {
            $tuningKits = json_decode($validated['tuning_kits'], true);
            $validated['tuning_kits'] = $tuningKits ?: null;
        } else {
            $validated['tuning_kits'] = null;
        }

        $recommendedProducts = $validated['recommended_products'] ?? [];
        unset($validated['recommended_products']);

        $product->update($validated);

        // Sync recommended products
        if (!empty($recommendedProducts)) {
            $syncData = [];
            foreach ($recommendedProducts as $index => $productId) {
                $syncData[$productId] = [
                    'type' => 'recommended',
                    'sort_order' => $index
                ];
            }
            $product->recommended()->sync($syncData);
        } else {
            $product->recommended()->detach();
        }

        return back()->with('success', 'Товар оновлено успішно');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Товар видалено успішно');
    }

    public function importData()
    {
        try {
            // Run database seeder
            Artisan::call('db:seed', ['--force' => true]);

            return back()->with('success', 'Дані успішно імпортовано! База даних заповнена тестовими даними.');
        } catch (\Exception $e) {
            return back()->with('error', 'Помилка імпорту: ' . $e->getMessage());
        }
    }
}
