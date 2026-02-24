<?php

namespace App\Http\Controllers;

use App\Models\PickupLead;
use App\Models\Product;
use Illuminate\Http\Request;

class QuickOrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'phone' => 'required|string|min:10|max:20',
            'name' => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Create lead using existing PickupLead model
        PickupLead::create([
            'name' => $validated['name'] ?? 'Швидке замовлення',
            'phone' => $validated['phone'],
            'email' => '',
            'answers' => [
                'type' => 'quick_order',
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_sku' => $product->sku,
                'product_price' => $product->price,
            ],
            'status' => 'new',
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Замовлення прийнято! Ми зателефонуємо вам найближчим часом.',
            ]);
        }

        return back()->with('success', 'Замовлення прийнято! Ми зателефонуємо вам найближчим часом.');
    }
}
