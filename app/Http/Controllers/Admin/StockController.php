<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['warehouses', 'category', 'brand']);

        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by stock status
        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'in_stock') {
                $query->whereHas('warehouses', function($q) {
                    $q->whereRaw('quantity > reserved');
                });
            } elseif ($request->stock_status === 'low_stock') {
                $query->whereHas('warehouses', function($q) {
                    $q->whereRaw('(quantity - reserved) > 0 AND (quantity - reserved) < 5');
                });
            } elseif ($request->stock_status === 'out_of_stock') {
                $query->whereDoesntHave('warehouses', function($q) {
                    $q->whereRaw('quantity > reserved');
                });
            }
        }

        $products = $query->paginate(50);
        $warehouses = Warehouse::where('is_active', true)->orderBy('sort_order')->get();
        $categories = \App\Models\Category::whereNull('parent_id')->orderBy('name')->get();

        return view('admin.stock.index', compact('products', 'warehouses', 'categories'));
    }

    public function edit(Product $product)
    {
        $product->load('warehouses');
        $warehouses = Warehouse::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.stock.edit', compact('product', 'warehouses'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'warehouses' => 'required|array',
            'warehouses.*.warehouse_id' => 'required|exists:warehouses,id',
            'warehouses.*.quantity' => 'required|integer|min:0',
            'warehouses.*.reserved' => 'nullable|integer|min:0',
        ]);

        // Sync stock data
        $syncData = [];
        foreach ($validated['warehouses'] as $warehouseData) {
            $syncData[$warehouseData['warehouse_id']] = [
                'quantity' => $warehouseData['quantity'],
                'reserved' => $warehouseData['reserved'] ?? 0,
            ];
        }

        $product->warehouses()->sync($syncData);

        return redirect()->route('admin.stock.index')
            ->with('success', 'Залишки товару успішно оновлено!');
    }

    // Quick update via AJAX
    public function quickUpdate(Request $request, Product $product, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
            'reserved' => 'nullable|integer|min:0',
        ]);

        $product->warehouses()->syncWithoutDetaching([
            $warehouse->id => [
                'quantity' => $validated['quantity'],
                'reserved' => $validated['reserved'] ?? 0,
            ]
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Залишки оновлено',
        ]);
    }
}
