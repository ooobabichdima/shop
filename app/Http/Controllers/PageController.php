<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lead;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function catalog()
    {
        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('pages.catalog-overview', compact('categories'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contacts()
    {
        return view('pages.contacts');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string',
        ]);

        Lead::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'type' => 'contact',
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        return back()->with('success', 'Ваше повідомлення відправлено! Ми зв\'яжемося з вами найближчим часом.');
    }

    public function delivery()
    {
        return view('pages.delivery');
    }

    public function payment()
    {
        return view('pages.payment');
    }

    public function warranty()
    {
        return view('pages.warranty');
    }

    public function returns()
    {
        return view('pages.returns');
    }

    public function offer()
    {
        return view('pages.offer');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function usedMarket()
    {
        return view('pages.used-market');
    }

    public function submitUsedItem(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'item_name' => 'required|string|max:255',
            'item_description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:excellent,good,fair,parts',
            'photos' => 'nullable|string',
        ]);

        Lead::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'type' => 'used_item',
            'message' => "Товар: {$validated['item_name']}\n" .
                        "Опис: {$validated['item_description']}\n" .
                        "Ціна: {$validated['price']} грн\n" .
                        "Стан: {$validated['condition']}\n" .
                        "Фото: {$validated['photos']}",
            'status' => 'new',
        ]);

        return back()->with('success', 'Ваша заявка відправлена! Ми зв\'яжемося з вами найближчим часом.');
    }
}
