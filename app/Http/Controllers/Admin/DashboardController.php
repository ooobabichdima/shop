<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Статистика
        $stats = [
            'orders_today' => Order::whereDate('created_at', today())->count(),
            'orders_week' => Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'revenue_today' => Order::whereDate('created_at', today())->sum('total'),
            'revenue_week' => Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total'),
            'orders_new' => Order::where('status', 'new')->count(),
            'orders_paid' => Order::where('status', 'paid')->count(),
            'orders_unpaid' => Order::whereNotIn('status', ['paid', 'canceled'])->count(),
        ];

        // Топ товары
        $topProducts = Product::withCount([
            'orderItems as total_sold' => function ($query) {
                $query->select(DB::raw('SUM(quantity)'));
            }
        ])
            ->orderBy('total_sold', 'desc')
            ->take(10)
            ->get();

        // Последние заказы
        $recentOrders = Order::with(['items', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'topProducts', 'recentOrders'));
    }
}
