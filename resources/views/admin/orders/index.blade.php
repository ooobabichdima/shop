@extends('layouts.admin')

@section('title', 'Замовлення - Адмін')

@section('content')
<div style="padding:20px 0;">
    <h1 style="margin-bottom:30px;">Замовлення</h1>

    <div class="card" style="padding:20px;">
        @if($orders->count() > 0)
            @foreach($orders as $order)
                <div style="display:flex;justify-content:space-between;align-items:center;padding:16px 0;border-bottom:1px solid rgba(255,255,255,.1);">
                    <div>
                        <a href="{{ route('admin.orders.show', $order) }}" style="font-weight:900;color:inherit;">{{ $order->number }}</a>
                        <div style="color:rgba(255,255,255,.65);font-size:14px;margin-top:4px;">
                            {{ $order->customer_name }} • {{ $order->phone }}
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-weight:900;margin-bottom:4px;">{{ number_format($order->total, 0) }} грн</div>
                        <div style="font-size:14px;">{{ $order->status }}</div>
                    </div>
                </div>
            @endforeach

            <div style="margin-top:20px;">
                {{ $orders->links() }}
            </div>
        @else
            <div style="text-align:center;padding:60px 20px;">
                <div style="font-size:64px;margin-bottom:20px;opacity:.3;">📦</div>
                <h3 style="margin:0 0 12px;color:var(--text);">Замовлень ще немає</h3>
                <p style="color:var(--muted);margin:0;">Коли клієнти зроблять замовлення, вони з'являться тут</p>
            </div>
        @endif
    </div>
</div>
@endsection
