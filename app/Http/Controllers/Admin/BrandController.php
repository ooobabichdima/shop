<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $categories = Brand::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (Brand::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        Brand::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Бренд створено успішно!');
    }

    public function edit(Brand $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Brand $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $slug = Str::slug($request->name);
        if ($slug !== $category->slug) {
            $originalSlug = $slug;
            $count = 1;
            while (Brand::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Бренд оновлено успішно!');
    }

    public function destroy(Brand $category)
    {
        $productsCount = $category->products()->count();

        if ($productsCount > 0) {
            return back()->with('error', "Неможливо видалити бренд. У ній є {$productsCount} товарів.");
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Бренд видалено успішно!');
    }
}
