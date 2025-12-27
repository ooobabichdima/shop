@extends('layouts.app')

@section('title', 'Кошик - Strikeball Shop')

@section('content')
<div style="padding:20px 0;">
    <h1 style="margin-bottom:30px;">Кошик</h1>

    @if(empty($cart))
        <div class="card" style="text-align:center;padding:40px;">
            <p style="font-size:18px;color:rgba(255,255,255,.65);">Кошик порожній</p>
            <a href="{{ route('home') }}" class="btn primary" style="margin-top:20px;">До каталогу</a>
        </div>
    @else
        <div class="card" style="margin-bottom:20px;">
            @php $total = 0; @endphp
            @foreach($cart as $item)
                @if(isset($item['product']))
                    @php
                        $product = $item['product'];
                        $subtotal = $product->price * $item['quantity'];
                        $total += $subtotal;
                    @endphp
                    <div style="display:flex;gap:16px;padding:16px 0;border-bottom:1px solid rgba(255,255,255,.1);">
                        <div style="width:80px;height:80px;background:rgba(255,255,255,.05);border-radius:8px;"></div>
                        <div style="flex:1;">
                            <h3 style="margin:0 0 8px;">{{ $product->name }}</h3>
                            <div style="color:rgba(255,255,255,.65);font-size:14px;">{{ $product->sku }}</div>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px;">
                            <form method="POST" action="{{ route('cart.update') }}" style="margin:0;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $product->stock }}"
                                       onchange="this.form.submit()"
                                       style="width:60px;padding:8px;border-radius:8px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);">
                            </form>
                            <div style="font-weight:900;min-width:100px;text-align:right;">{{ number_format($subtotal, 0) }} грн</div>
                            <form method="POST" action="{{ route('cart.remove') }}" style="margin:0;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn" style="padding:8px;">Видалити</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach

            <div style="padding-top:20px;text-align:right;">
                <div style="font-size:24px;font-weight:900;margin-bottom:20px;">Всього: {{ number_format($total, 0) }} грн</div>
                <div style="display:flex;gap:12px;justify-content:flex-end;">
                    <form method="POST" action="{{ route('cart.clear') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn">Очистити кошик</button>
                    </form>
                    <a href="{{ route('checkout') }}" class="btn primary">Оформити замовлення</a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
