@extends('layouts.app')

@section('title', 'Оплата (Demo) - Strikeball Shop')

@section('content')
<div style="padding:40px 0;">
    <div class="card" style="max-width:500px;margin:0 auto;text-align:center;">
        <div style="background:rgba(255,204,0,.1);padding:12px;border-radius:12px;border:1px solid rgba(255,204,0,.3);margin-bottom:24px;">
            <strong>DEMO РЕЖИМ</strong> - тестовий платіж
        </div>

        <h1 style="margin-bottom:16px;">Оплата замовлення</h1>
        <p style="font-size:18px;color:rgba(255,255,255,.65);margin-bottom:24px;">
            Замовлення: <strong>#{{ $payment->order->number }}</strong>
        </p>

        <div style="font-size:48px;font-weight:900;margin-bottom:24px;">
            {{ number_format($payment->amount, 2) }} {{ $payment->currency }}
        </div>

        <form method="POST" action="{{ route('payment.monobank.demo.confirm', $payment) }}">
            @csrf
            <button type="submit" class="btn primary" style="width:100%;justify-content:center;">
                Підтвердити оплату (DEMO)
            </button>
        </form>

        <p style="margin-top:16px;font-size:14px;color:rgba(255,255,255,.45);">
            У продакшені тут буде реальна оплата через Monobank
        </p>
    </div>
</div>
@endsection
