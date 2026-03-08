<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session('wishlist', []);
        $products = Product::with(['category', 'brand', 'primaryImage'])
            ->whereIn('id', $wishlist)
            ->where('is_active', true)
            ->get();

        return view('pages.wishlist', compact('products'));
    }

    public function toggle(Request $request)
    {
        $productId = (int) $request->product_id;
        $wishlist = session('wishlist', []);

        if (in_array($productId, $wishlist)) {
            $wishlist = array_values(array_diff($wishlist, [$productId]));
            $added = false;
        } else {
            $wishlist[] = $productId;
            $added = true;
        }

        session(['wishlist' => $wishlist]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'added' => $added,
                'count' => count($wishlist),
            ]);
        }

        return back();
    }

    public function remove(Request $request)
    {
        $productId = (int) $request->product_id;
        $wishlist = session('wishlist', []);
        $wishlist = array_values(array_diff($wishlist, [$productId]));
        session(['wishlist' => $wishlist]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'count' => count($wishlist)]);
        }

        return back()->with('success', 'Товар видалено з обраного');
    }
}
