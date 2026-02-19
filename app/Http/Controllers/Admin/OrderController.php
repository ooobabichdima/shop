<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['items', 'user', 'payments']);

        // Фильтр по статусу
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Поиск
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('number', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'shipping_provider' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_ref' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string|max:500',
            'comment' => 'nullable|string',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Создаем заказ
        $order = Order::create([
            'number' => Order::generateOrderNumber(),
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'shipping_provider' => $validated['shipping_provider'],
            'shipping_city' => $validated['shipping_city'],
            'shipping_ref' => $validated['shipping_ref'] ?? null,
            'shipping_address' => $validated['shipping_address'] ?? null,
            'comment' => $validated['comment'] ?? null,
            'subtotal' => 0,
            'discount' => 0,
            'shipping_cost' => 0,
            'total' => 0,
            'status' => 'new',
        ]);

        // Добавляем товары
        $subtotal = 0;
        foreach ($validated['products'] as $productData) {
            $product = \App\Models\Product::find($productData['id']);
            $quantity = $productData['quantity'];
            $price = $product->price;

            $order->items()->create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_sku' => $product->sku,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $price * $quantity,
            ]);

            $subtotal += $price * $quantity;
        }

        // Обновляем сумму заказа
        $order->update([
            'subtotal' => $subtotal,
            'total' => $subtotal,
        ]);

        // Записываем в аудит
        AuditLog::create([
            'auditable_type' => Order::class,
            'auditable_id' => $order->id,
            'user_id' => auth()->id(),
            'event' => 'created',
            'old_values' => null,
            'new_values' => 'Manual order creation',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Замовлення створено успішно');
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user', 'payments', 'auditLogs.user']);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:new,confirmed,paid,shipped,delivered,canceled',
        ]);

        $oldStatus = $order->status;
        $order->update(['status' => $request->status]);

        // Записываем в аудит
        AuditLog::create([
            'auditable_type' => Order::class,
            'auditable_id' => $order->id,
            'user_id' => auth()->id(),
            'event' => 'status_changed',
            'old_values' => $oldStatus,
            'new_values' => $request->status,
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Статус оновлено');
    }
}
