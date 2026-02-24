<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->with(['children' => function($q) {
                $q->where('is_active', true)->orderBy('sort_order');
            }])
            ->firstOrFail();

        // Get all category IDs (current + all children)
        $categoryIds = [$category->id];
        if ($category->children) {
            $categoryIds = array_merge($categoryIds, $category->children->pluck('id')->toArray());
        }

        $query = Product::with(['category', 'brand', 'primaryImage', 'attributes', 'warehouses'])
            ->whereIn('category_id', $categoryIds)
            ->where('is_active', true);

        // Фильтр по цене
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        // Фільтр по наявності (використовуємо склади)
        if ($request->filled('in_stock')) {
            $query->whereHas('warehouses', function($q) {
                $q->whereRaw('product_warehouse.quantity > product_warehouse.reserved');
            });
        }

        // Фільтр "тільки під замовлення"
        if ($request->filled('on_order')) {
            $query->whereDoesntHave('warehouses', function($q) {
                $q->whereRaw('product_warehouse.quantity > product_warehouse.reserved');
            });
        }

        // Фильтр по бренду
        if ($request->filled('brand')) {
            $query->whereIn('brand_id', (array) $request->brand);
        }

        // Фильтр по атрибутам
        if ($request->filled('attr')) {
            foreach ($request->attr as $attrId => $values) {
                if (!empty($values)) {
                    $query->whereHas('attributeValues', function($q) use ($attrId, $values) {
                        $q->where('attribute_id', $attrId)
                          ->whereIn('value_string', (array)$values);
                    });
                }
            }
        }

        // Сортировка
        $sort = $request->get('sort', 'popular');
        match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'newest' => $query->orderBy('created_at', 'desc'),
            'rating' => $query->orderBy('rating', 'desc'),
            default => $query->orderBy('views', 'desc'),
        };

        $products = $query->paginate(12);

        // Get all brands that have products in these categories
        $brands = Brand::whereHas('products', function($q) use ($categoryIds) {
            $q->whereIn('category_id', $categoryIds)
              ->where('is_active', true);
        })->where('is_active', true)->orderBy('name')->get();

        // Get attributes for this category
        $attributes = $category->attributes()
            ->where('is_filterable', true)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Total products count
        $totalProducts = Product::whereIn('category_id', $categoryIds)
            ->where('is_active', true)
            ->count();

        return view('pages.catalog', compact('category', 'products', 'attributes', 'brands', 'totalProducts'));
    }
}
