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
            ->firstOrFail();

        $query = Product::with(['category', 'brand', 'primaryImage', 'attributes'])
            ->where('category_id', $category->id)
            ->where('is_active', true);

        // Фильтр по цене
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        // Фильтр по наличию
        if ($request->filled('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // Фильтр по бренду
        if ($request->filled('brand')) {
            $query->whereIn('brand_id', (array) $request->brand);
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

        // Get all brands that have products in this category
        $brands = Brand::whereHas('products', function($q) use ($category) {
            $q->where('category_id', $category->id)
              ->where('is_active', true);
        })->where('is_active', true)->orderBy('name')->get();

        $attributes = Attribute::where('is_filterable', true)
            ->orderBy('sort_order')
            ->get();

        // Total products count
        $totalProducts = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->count();

        return view('pages.catalog', compact('category', 'products', 'attributes', 'brands', 'totalProducts'));
    }
}
