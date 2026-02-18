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
        $brands = Brand::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
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

        return redirect()->route('admin.brands.index')->with('success', 'Бренд створено успішно!');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $slug = Str::slug($request->name);
        if ($slug !== $brand->slug) {
            $originalSlug = $slug;
            $count = 1;
            while (Brand::where('slug', $slug)->where('id', '!=', $brand->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        $brand->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Бренд оновлено успішно!');
    }

    public function destroy(Brand $brand)
    {
        $productsCount = $brand->products()->count();

        if ($productsCount > 0) {
            return back()->with('error', "Неможливо видалити бренд. У нього є {$productsCount} товарів.");
        }

        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Бренд видалено успішно!');
    }
}
