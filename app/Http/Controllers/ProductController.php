<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::with([
            'category',
            'brand',
            'images',
            'attributes',
            'recommended.brand',
            'recommended.category',
        ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Увеличиваем просмотры
        $product->incrementViews();

        return view('pages.product', compact('product'));
    }
}
