@extends('layouts.app')

@section('title', 'Оформлення замовлення - Strikeball Shop')

@section('content')
<div style="padding:20px 0;">
    <h1 style="margin-bottom:30px;">Оформлення замовлення</h1>

    <form method="POST" action="{{ route('checkout.submit') }}">
        @csrf
        <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;">
            <div>
                <div class="card" style="margin-bottom:20px;">
                    <h2 style="margin-bottom:16px;">Контактні дані</h2>
                    <div style="display:grid;gap:12px;">
                        <div>
                            <label style="display:block;margin-bottom:4px;">Ім'я *</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                                   style="width:100%;padding:12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);">
                            @error('customer_name')<div style="color:rgba(255,77,77,.9);font-size:14px;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label style="display:block;margin-bottom:4px;">Телефон *</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required
                                   style="width:100%;padding:12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);">
                            @error('phone')<div style="color:rgba(255,77,77,.9);font-size:14px;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label style="display:block;margin-bottom:4px;">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   style="width:100%;padding:12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);">
                            @error('email')<div style="color:rgba(255,77,77,.9);font-size:14px;margin-top:4px;">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-bottom:20px;">
                    <h2 style="margin-bottom:16px;">Доставка</h2>
                    <div style="display:grid;gap:12px;">
                        <label style="display:flex;align-items:center;gap:10px;padding:12px;border:1px solid rgba(255,255,255,.12);border-radius:12px;cursor:pointer;">
                            <input type="radio" name="shipping_provider" value="np" checked>
                            <span>Нова Пошта (100 грн)</span>
                        </label>
                        <label style="display:flex;align-items:center;gap:10px;padding:12px;border:1px solid rgba(255,255,255,.12);border-radius:12px;cursor:pointer;">
                            <input type="radio" name="shipping_provider" value="courier">
                            <span>Кур'єр (150 грн)</span>
                        </label>
                        <label style="display:flex;align-items:center;gap:10px;padding:12px;border:1px solid rgba(255,255,255,.12);border-radius:12px;cursor:pointer;">
                            <input type="radio" name="shipping_provider" value="pickup">
                            <span>Самовивіз (безкоштовно)</span>
                        </label>
                        <div>
                            <label style="display:block;margin-bottom:4px;">Адреса доставки</label>
                            <textarea name="shipping_address" rows="2"
                                      style="width:100%;padding:12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);">{{ old('shipping_address') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h2 style="margin-bottom:16px;">Оплата</h2>
                    <div style="display:grid;gap:12px;">
                        <label style="display:flex;align-items:center;gap:10px;padding:12px;border:1px solid rgba(255,255,255,.12);border-radius:12px;cursor:pointer;">
                            <input type="radio" name="payment_method" value="monobank" checked>
                            <span>Monobank (онлайн)</span>
                        </label>
                        <label style="display:flex;align-items:center;gap:10px;padding:12px;border:1px solid rgba(255,255,255,.12);border-radius:12px;cursor:pointer;">
                            <input type="radio" name="payment_method" value="cash">
                            <span>Готівкою при отриманні</span>
                        </label>
                    </div>
                </div>
            </div>

            <div>
                <div class="card">
                    <h2 style="margin-bottom:16px;">Ваше замовлення</h2>
                    @foreach($cartItems as $item)
                        <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid rgba(255,255,255,.1);">
                            <div>{{ $item['product']->name }} x{{ $item['quantity'] }}</div>
                            <div style="font-weight:700;">{{ number_format($item['subtotal'], 0) }} грн</div>
                        </div>
                    @endforeach
                    <div style="display:flex;justify-content:space-between;padding:12px 0;font-size:18px;font-weight:900;">
                        <div>Всього:</div>
                        <div>{{ number_format($subtotal, 0) }} грн</div>
                    </div>
                    <button type="submit" class="btn primary" style="width:100%;justify-content:center;margin-top:16px;">
                        Підтвердити замовлення
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
