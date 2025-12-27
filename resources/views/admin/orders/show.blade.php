@extends('layouts.app')

@section('title', 'Замовлення ' . $order->number . ' - Адмін')

@section('content')
<div style="padding:20px 0;">
    <h1 style="margin-bottom:30px;">Замовлення {{ $order->number }}</h1>

    <div class="card" style="margin-bottom:20px;">
        <h2 style="margin-bottom:16px;">Інформація</h2>
        <div style="display:grid;gap:8px;">
            <div><strong>Клієнт:</strong> {{ $order->customer_name }}</div>
            <div><strong>Телефон:</strong> {{ $order->phone }}</div>
            @if($order->email)<div><strong>Email:</strong> {{ $order->email }}</div>@endif
            <div><strong>Статус:</strong> {{ $order->status }}</div>
            <div><strong>Сума:</strong> {{ number_format($order->total, 0) }} грн</div>
        </div>

        <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="margin-top:16px;">
            @csrf
            <select name="status" style="padding:8px;border-radius:8px;background:rgba(255,255,255,.06);color:var(--text);border:1px solid rgba(255,255,255,.14);">
                <option value="new" @if($order->status === 'new') selected @endif>Новий</option>
                <option value="confirmed" @if($order->status === 'confirmed') selected @endif>Підтверджений</option>
                <option value="paid" @if($order->status === 'paid') selected @endif>Оплачений</option>
                <option value="shipped" @if($order->status === 'shipped') selected @endif>Відправлений</option>
                <option value="delivered" @if($order->status === 'delivered') selected @endif>Доставлений</option>
                <option value="canceled" @if($order->status === 'canceled') selected @endif>Скасований</option>
            </select>
            <button type="submit" class="btn primary" style="margin-left:10px;">Оновити</button>
        </form>
    </div>

    <div class="card">
        <h2 style="margin-bottom:16px;">Товари</h2>
        @foreach($order->items as $item)
            <div style="padding:12px 0;border-bottom:1px solid rgba(255,255,255,.1);">
                <div style="font-weight:700;">{{ $item->name_snapshot }}</div>
                <div style="color:rgba(255,255,255,.65);font-size:14px;">
                    {{ $item->price_snapshot }} грн x {{ $item->quantity }} = {{ number_format($item->subtotal, 0) }} грн
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
