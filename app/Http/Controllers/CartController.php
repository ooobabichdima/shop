<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $productIds = array_column($cart, 'id');
        $products = Product::with(['primaryImage', 'brand'])
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        // Обогащаем данные корзины
        foreach ($cart as $key => $item) {
            if (isset($products[$item['id']])) {
                $cart[$key]['product'] = $products[$item['id']];
            }
        }

        return view('pages.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_active || !$product->isInStock()) {
            return back()->with('error', 'Товар недоступен');
        }

        $cart = session()->get('cart', []);

        // Проверяем, есть ли товар в корзине
        $found = false;
        foreach ($cart as $key => $item) {
            if ($item['id'] == $product->id) {
                $cart[$key]['quantity'] = min($cart[$key]['quantity'] + $request->quantity, $product->stock);
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'id' => $product->id,
                'quantity' => min($request->quantity, $product->stock),
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Товар додано до кошика');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0|max:99',
        ]);

        $cart = session()->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $request->product_id) {
                if ($request->quantity == 0) {
                    unset($cart[$key]);
                } else {
                    $cart[$key]['quantity'] = $request->quantity;
                }
                break;
            }
        }

        session()->put('cart', array_values($cart));

        return back()->with('success', 'Кошик оновлено');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = session()->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $request->product_id) {
                unset($cart[$key]);
                break;
            }
        }

        session()->put('cart', array_values($cart));

        return back()->with('success', 'Товар видалено з кошика');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Кошик очищено');
    }
}
