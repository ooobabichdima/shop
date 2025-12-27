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
