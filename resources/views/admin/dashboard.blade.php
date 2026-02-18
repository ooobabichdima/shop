@extends('layouts.admin')

@section('title', 'Панель управління - Адмін')

@section('content')
<div style="padding:20px 0;">
    <h1 style="margin-bottom:30px;">Адмін панель</h1>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:30px;">
        <div class="card">
            <div style="font-size:32px;font-weight:900;margin-bottom:8px;">{{ $stats['orders_today'] }}</div>
            <div style="color:rgba(255,255,255,.65);">Замовлень сьогодні</div>
        </div>
        <div class="card">
            <div style="font-size:32px;font-weight:900;margin-bottom:8px;">{{ number_format($stats['revenue_today'], 0) }} грн</div>
            <div style="color:rgba(255,255,255,.65);">Виручка сьогодні</div>
        </div>
        <div class="card">
            <div style="font-size:32px;font-weight:900;margin-bottom:8px;">{{ $stats['orders_week'] }}</div>
            <div style="color:rgba(255,255,255,.65);">Замовлень за тиждень</div>
        </div>
        <div class="card">
            <div style="font-size:32px;font-weight:900;margin-bottom:8px;">{{ $stats['orders_new'] }}</div>
            <div style="color:rgba(255,255,255,.65);">Нові замовлення</div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
        <div class="card">
            <h2 style="margin-bottom:16px;">Останні замовлення</h2>
            @foreach($recentOrders as $order)
                <div style="padding:12px 0;border-bottom:1px solid rgba(255,255,255,.1);">
                    <div style="display:flex;justify-content:space-between;margin-bottom:4px;">
                        <a href="{{ route('admin.orders.show', $order) }}" style="font-weight:700;color:inherit;">{{ $order->number }}</a>
                        <span style="font-weight:900;">{{ number_format($order->total, 0) }} грн</span>
                    </div>
                    <div style="color:rgba(255,255,255,.65);font-size:14px;">
                        {{ $order->customer_name }} • {{ $order->status }}
                    </div>
                </div>
            @endforeach
            <a href="{{ route('admin.orders.index') }}" class="btn" style="margin-top:16px;width:100%;justify-content:center;">
                Всі замовлення
            </a>
        </div>

        <div class="card">
            <h2 style="margin-bottom:16px;">Топ товари</h2>
            @foreach($topProducts->take(5) as $product)
                <div style="padding:12px 0;border-bottom:1px solid rgba(255,255,255,.1);">
                    <div style="font-weight:700;margin-bottom:4px;">{{ $product->name }}</div>
                    <div style="color:rgba(255,255,255,.65);font-size:14px;">
                        Продано: {{ $product->total_sold ?? 0 }} шт
                    </div>
                </div>
            @endforeach
            <a href="{{ route('admin.products.index') }}" class="btn" style="margin-top:16px;width:100%;justify-content:center;">
                Всі товари
            </a>
        </div>
    </div>
</div>
@endsection
