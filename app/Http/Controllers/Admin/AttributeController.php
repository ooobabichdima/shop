<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::with('categories')->orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:text,select,checkbox,range',
            'options' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_filterable' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $count = 1;
        while (Attribute::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Parse options if provided
        if (!empty($validated['options'])) {
            $options = array_filter(array_map('trim', explode("\n", $validated['options'])));
            $validated['options'] = $options;
        } else {
            $validated['options'] = null;
        }

        Attribute::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'type' => $validated['type'],
            'options' => $validated['options'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_filterable' => $request->has('is_filterable'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.attributes.index')->with('success', 'Атрибут створено успішно!');
    }

    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(Request $request, Attribute $attribute)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:text,select,checkbox,range',
            'options' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_filterable' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if (!empty($validated['options'])) {
            $options = array_filter(array_map('trim', explode("\n", $validated['options'])));
            $validated['options'] = $options;
        } else {
            $validated['options'] = null;
        }

        $attribute->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'options' => $validated['options'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_filterable' => $request->has('is_filterable'),
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Атрибут оновлено успішно!');
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return back()->with('success', 'Атрибут видалено успішно!');
    }
}
