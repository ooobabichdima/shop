<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['category', 'brand', 'primaryImage'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(8)
            ->get();

        $newProducts = Product::with(['category', 'brand', 'primaryImage'])
            ->where('is_active', true)
            ->where('is_new', true)
            ->take(8)
            ->get();

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        return view('pages.home', compact('featuredProducts', 'newProducts', 'categories'));
    }
}
