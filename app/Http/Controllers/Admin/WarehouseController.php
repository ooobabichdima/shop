<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('admin.warehouses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:warehouses,code',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Warehouse::create($validated);

        return redirect()->route('admin.warehouses.index')
            ->with('success', 'Склад успішно створено!');
    }

    public function edit(Warehouse $warehouse)
    {
        return view('admin.warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:warehouses,code,' . $warehouse->id,
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $warehouse->update($validated);

        return redirect()->route('admin.warehouses.index')
            ->with('success', 'Склад успішно оновлено!');
    }

    public function destroy(Warehouse $warehouse)
    {
        $productsCount = $warehouse->products()->count();

        if ($productsCount > 0) {
            return back()->with('error', "Неможливо видалити склад. На ньому є {$productsCount} товарів.");
        }

        $warehouse->delete();
        return redirect()->route('admin.warehouses.index')
            ->with('success', 'Склад видалено успішно!');
    }
}
