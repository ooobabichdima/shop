@extends('layouts.app')

@section('title', 'Замовлення оформлено - Strikeball Shop')

@section('content')
<div style="padding:40px 0;">
    <div class="card" style="max-width:600px;margin:0 auto;text-align:center;">
        <div style="font-size:64px;margin-bottom:20px;">✓</div>
        <h1 style="margin-bottom:16px;">Дякуємо за замовлення!</h1>
        <p style="font-size:18px;color:rgba(255,255,255,.65);margin-bottom:24px;">
            Замовлення <strong>#{{ $order->number }}</strong> успішно оформлено
        </p>
        <div style="background:rgba(255,255,255,.05);padding:16px;border-radius:12px;margin-bottom:24px;text-align:left;">
            <div style="margin-bottom:8px;"><strong>Сума:</strong> {{ number_format($order->total, 0) }} грн</div>
            <div style="margin-bottom:8px;"><strong>Статус:</strong> {{ $order->status }}</div>
            @if($order->isPaid())
                <div style="color:rgba(88,255,122,.9);"><strong>Оплата:</strong> Оплачено ✓</div>
            @else
                <div style="color:rgba(255,204,0,.9);"><strong>Оплата:</strong> Очікується</div>
            @endif
        </div>
        <a href="{{ route('home') }}" class="btn primary">Повернутися на головну</a>
    </div>
</div>
@endsection
