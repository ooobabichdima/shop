<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('sort_order')->orderBy('name')->paginate(20);
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
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Категорію створено успішно!');
    }

    public function edit(Category $category)
    {
        $attributes = Attribute::where('is_active', true)->orderBy('name')->get();
        return view('admin.categories.edit', compact('category', 'attributes'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'attributes' => 'nullable|array',
            'attributes.*' => 'exists:attributes,id',
        ]);

        $slug = Str::slug($request->name);
        if ($slug !== $category->slug) {
            $originalSlug = $slug;
            $count = 1;
            while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
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

        // Sync attributes
        if ($request->has('attributes')) {
            $syncData = [];
            foreach ($request->attributes as $index => $attributeId) {
                $syncData[$attributeId] = ['sort_order' => $index];
            }
            $category->attributes()->sync($syncData);
        } else {
            $category->attributes()->detach();
        }

        return redirect()->route('admin.categories.index')->with('success', 'Категорію оновлено успішно!');
    }

    public function destroy(Category $category)
    {
        $productsCount = $category->products()->count();

        if ($productsCount > 0) {
            return back()->with('error', "Неможливо видалити категорію. У ній є {$productsCount} товарів.");
        }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Категорію видалено успішно!');
    }
}
