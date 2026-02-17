@extends('layouts.app')

@section('title', 'Оформлення замовлення - Strikeball Shop')

@section('content')
<style>
.checkout-layout{
    display:grid;
    grid-template-columns: 1.15fr .85fr;
    gap:16px;
    padding:10px 0 24px;
}
.checkout-section{
    padding:18px;
    margin-bottom:12px;
}
.checkout-section h2{
    margin:0 0 12px;
    font-size:clamp(20px,2.2vw,28px);
}
.fields{
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap:12px;
    margin-top:14px;
}
.field{
    display:grid;
    gap:6px;
}
.field label{
    font-size:13px;
    color:rgba(255,255,255,.78);
    font-weight:800;
}
.field input,
.field textarea{
    padding:12px;
    border-radius:14px;
    border:1px solid rgba(255,255,255,.12);
    background:rgba(255,255,255,.06);
    color:var(--text);
    outline:none;
    font-size:14px;
}
.field input::placeholder,
.field textarea::placeholder{
    color:rgba(255,255,255,.45);
}
.field textarea{
    min-height:90px;
    resize:vertical;
}
.choice{
    margin-top:12px;
    display:grid;
    gap:10px;
}
.opt{
    display:flex;
    justify-content:space-between;
    gap:12px;
    align-items:flex-start;
    padding:12px;
    border-radius:16px;
    border:1px solid rgba(255,255,255,.10);
    background:rgba(0,0,0,.14);
    cursor:pointer;
    transition:.12s ease;
}
.opt:hover{
    border-color:rgba(255,255,255,.18);
    background:rgba(255,255,255,.04);
}
.opt input[type="radio"]{
    accent-color:var(--accent);
    margin-top:2px;
}
.checkout-summary{
    padding:18px;
    position:sticky;
    top:80px;
}
.sum-box{
    margin-top:14px;
    padding:14px;
    border-radius:18px;
    border:1px solid rgba(255,255,255,.12);
    background:rgba(0,0,0,.16);
    display:grid;
    gap:10px;
}
.sum-line{
    display:flex;
    justify-content:space-between;
    gap:10px;
    color:rgba(255,255,255,.84);
    font-size:14px;
}
.sum-line span{
    color:var(--muted);
}
.sum-total{
    border-top:1px solid rgba(255,255,255,.10);
    padding-top:10px;
    margin-top:4px;
}
.sum-total b{
    font-size:20px;
}
.mini-item{
    display:flex;
    justify-content:space-between;
    gap:12px;
    align-items:flex-start;
    padding:10px 12px;
    border-radius:14px;
    border:1px solid rgba(255,255,255,.10);
    background:rgba(255,255,255,.05);
}
.mini-item b{
    font-size:13.5px;
}
.mini-item .muted2{
    font-size:12.5px;
}
.error-notice{
    display:none;
    padding:12px 14px;
    border-radius:14px;
    border:1px solid rgba(255,77,77,.25);
    background:rgba(255,77,77,.10);
    color:rgba(255,255,255,.88);
    font-size:13px;
    margin-bottom:12px;
}
@media (max-width: 980px){
    .checkout-layout{
        grid-template-columns: 1fr;
    }
    .checkout-summary{
        position:static;
    }
}
@media (max-width: 560px){
    .fields{
        grid-template-columns: 1fr;
    }
}
</style>

<div style="padding:20px 0;">
    <div class="crumbs" style="padding:8px 0 16px; color:rgba(255,255,255,.62); font-size:13px;">
        <a href="{{ route('home') }}" style="color:rgba(255,255,255,.72);">Головна</a> /
        <a href="{{ route('cart') }}" style="color:rgba(255,255,255,.72);">Кошик</a> /
        <span>Оформлення</span>
    </div>

    <div style="display:flex; justify-content:space-between; align-items:flex-end; gap:14px; flex-wrap:wrap; margin-bottom:20px;">
        <div>
            <h1 style="margin:0 0 8px; font-size:clamp(24px,2.8vw,38px);">Оформлення замовлення</h1>
            <div style="color:var(--muted); font-size:14px;">Заповни контакти, обери доставку та оплату — і підтверджуй замовлення</div>
        </div>
        <span class="pill" id="deliveryPill" style="padding:8px 12px; border-radius:999px; background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.10); font-size:13px;">
            Доставка: НП
        </span>
    </div>

    <div class="error-notice" id="errorNotice"></div>

    <form method="POST" action="{{ route('checkout.submit') }}" id="checkoutForm">
        @csrf
        <div class="checkout-layout">
            <!-- LEFT: Form -->
            <div>
                <div class="card checkout-section">
                    <h2>Контактні дані</h2>
                    <div class="fields">
                        <div class="field">
                            <label for="customer_name">Ім'я та прізвище *</label>
                            <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required
                                placeholder="Наприклад: Дмитро Бабич">
                            @error('customer_name')
                                <div style="color:rgba(255,77,77,.95);font-size:12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="phone">Телефон *</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                                placeholder="+38 (0__) ___ __ __" inputmode="tel">
                            @error('phone')
                                <div style="color:rgba(255,77,77,.95);font-size:12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="you@mail.com" inputmode="email">
                            @error('email')
                                <div style="color:rgba(255,77,77,.95);font-size:12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="comment">Коментар</label>
                            <input type="text" id="comment" name="comment" value="{{ old('comment') }}"
                                placeholder="Наприклад: передзвонити після 18:00">
                        </div>
                    </div>
                </div>

                <div class="card checkout-section">
                    <h2>Доставка</h2>
                    <div style="color:var(--muted2); font-size:13px; margin-top:6px;">
                        Обери зручний спосіб доставки
                    </div>

                    <div class="choice">
                        <label class="opt">
                            <div>
                                <b>Нова Пошта (відділення)</b>
                                <div class="muted2">120 грн • 1–3 дні</div>
                            </div>
                            <input type="radio" name="shipping_provider" value="np" data-cost="120" checked>
                        </label>
                        <label class="opt">
                            <div>
                                <b>Кур'єр по місту</b>
                                <div class="muted2">180 грн • протягом дня</div>
                            </div>
                            <input type="radio" name="shipping_provider" value="courier" data-cost="180">
                        </label>
                        <label class="opt">
                            <div>
                                <b>Самовивіз</b>
                                <div class="muted2">0 грн • сьогодні</div>
                            </div>
                            <input type="radio" name="shipping_provider" value="pickup" data-cost="0">
                        </label>
                    </div>

                    <div class="fields">
                        <div class="field">
                            <label for="city">Місто *</label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}" required
                                placeholder="Київ">
                            @error('city')
                                <div style="color:rgba(255,77,77,.95);font-size:12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="address">Адреса / відділення *</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}" required
                                placeholder="НП відділення №__ або вулиця, будинок">
                            @error('address')
                                <div style="color:rgba(255,77,77,.95);font-size:12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="field" style="grid-column:1/-1;">
                            <label for="delivery_note">Примітка до доставки</label>
                            <textarea id="delivery_note" name="delivery_note" placeholder="Код дверей, поверх, орієнтир (якщо кур'єр)">{{ old('delivery_note') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card checkout-section">
                    <h2>Оплата</h2>
                    <div class="choice">
                        <label class="opt">
                            <div>
                                <b>Карткою онлайн</b>
                                <div class="muted2">Monobank / Приват24</div>
                            </div>
                            <input type="radio" name="payment_method" value="card" checked>
                        </label>
                        <label class="opt">
                            <div>
                                <b>Накладений платіж</b>
                                <div class="muted2">Оплата при отриманні</div>
                            </div>
                            <input type="radio" name="payment_method" value="cod">
                        </label>
                        <label class="opt">
                            <div>
                                <b>Безготівковий для юр. осіб</b>
                                <div class="muted2">Рахунок + реквізити</div>
                            </div>
                            <input type="radio" name="payment_method" value="invoice">
                        </label>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Summary -->
            <aside class="card checkout-summary">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; margin-bottom:14px;">
                    <div>
                        <b style="font-size:16px;">Ваше замовлення</b>
                        <div style="color:var(--muted2); font-size:13px; margin-top:4px;">Перевір позиції та підсумок</div>
                    </div>
                    <span class="pill" id="itemsPill">
                        {{ count($cartItems) }} {{ count($cartItems) == 1 ? 'позиція' : 'позицій' }}
                    </span>
                </div>

                <div class="sum-box" id="miniItems">
                    @foreach($cartItems as $item)
                        <div class="mini-item">
                            <div>
                                <b>{{ $item['product']->name }}</b>
                                <div class="muted2">{{ $item['quantity'] }} шт • {{ number_format($item['product']->price, 0, '', ' ') }} грн / шт</div>
                            </div>
                            <b>{{ number_format($item['subtotal'], 0, '', ' ') }} грн</b>
                        </div>
                    @endforeach
                </div>

                <div class="sum-box">
                    <div class="sum-line">
                        <span>Товари</span>
                        <b id="sumSubtotal">{{ number_format($subtotal, 0, '', ' ') }} грн</b>
                    </div>
                    <div class="sum-line">
                        <span>Знижка</span>
                        <b id="sumDiscount">0 грн</b>
                    </div>
                    <div class="sum-line">
                        <span>Доставка</span>
                        <b id="sumShipping">120 грн</b>
                    </div>
                    <div class="sum-line sum-total">
                        <span style="font-size:16px; color:var(--text);">До оплати</span>
                        <b id="sumTotal" style="font-size:20px;">{{ number_format($subtotal + 120, 0, '', ' ') }} грн</b>
                    </div>
                </div>

                <div class="sum-box">
                    <b>Промокод</b>
                    <div style="display:flex; gap:10px; margin-top:8px; flex-wrap:wrap;">
                        <input type="text" id="promoInput" name="promo_code" placeholder="START10" style="flex:1; min-width:140px; padding:12px; border-radius:14px; border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.06); color:var(--text); outline:none;">
                        <button type="button" class="btn small" id="applyPromo">Застосувати</button>
                    </div>
                    <div class="muted2" id="promoHint" style="margin-top:8px; font-size:12.5px;">
                        Якщо пусто — знижка не застосовується
                    </div>
                </div>

                <div style="display:grid; gap:10px; margin-top:12px;">
                    <button type="submit" class="btn primary" style="width:100%; justify-content:center;">
                        Підтвердити замовлення
                    </button>
                </div>

                <div style="color:var(--muted2); margin-top:12px; font-size:12px;">
                    Натискаючи "Підтвердити замовлення", ви погоджуєтесь з офертою та політикою конфіденційності.
                </div>
            </aside>
        </div>
    </form>
</div>

<script>
(function(){
    const SHIPPING_COSTS = {
        np: 120,
        courier: 180,
        pickup: 0
    };

    const PROMOS = {
        "START10": {type:"percent", value:10, label:"Знижка 10% на товари"},
        "STARTER": {type:"percent", value:10, label:"Знижка 10% на товари"},
        "BBS50": {type:"fixed", value:50, label:"−50 грн на замовлення"},
    };

    let currentPromo = null;
    let currentShipping = 'np';
    const subtotal = {{ $subtotal }};

    const elDiscount = document.getElementById('sumDiscount');
    const elShipping = document.getElementById('sumShipping');
    const elTotal = document.getElementById('sumTotal');
    const elDeliveryPill = document.getElementById('deliveryPill');
    const promoInput = document.getElementById('promoInput');
    const promoHint = document.getElementById('promoHint');

    const fmt = (n) => Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g,' ') + ' грн';

    function calculateDiscount(){
        if(!currentPromo) return 0;
        if(currentPromo.type === "percent"){
            return Math.round(subtotal * (currentPromo.value / 100));
        }
        if(currentPromo.type === "fixed"){
            return Math.min(currentPromo.value, subtotal);
        }
        return 0;
    }

    function updateSummary(){
        const discount = calculateDiscount();
        const shipping = SHIPPING_COSTS[currentShipping];
        const total = Math.max(0, subtotal - discount + shipping);

        elDiscount.textContent = fmt(discount);
        elShipping.textContent = fmt(shipping);
        elTotal.textContent = fmt(total);

        const shipLabels = {
            np: "НП",
            courier: "Кур'єр",
            pickup: "Самовивіз"
        };
        elDeliveryPill.textContent = `Доставка: ${shipLabels[currentShipping]}`;
    }

    // Shipping change
    document.querySelectorAll('input[name="shipping_provider"]').forEach(radio => {
        radio.addEventListener('change', () => {
            currentShipping = radio.value;
            updateSummary();
        });
    });

    // Promo code
    document.getElementById('applyPromo').addEventListener('click', () => {
        const code = promoInput.value.trim().toUpperCase();

        if(!code){
            currentPromo = null;
            promoHint.textContent = 'Промокод не вказано — знижка не застосовується';
            promoHint.style.color = 'var(--muted2)';
            updateSummary();
            return;
        }

        if(PROMOS[code]){
            currentPromo = PROMOS[code];
            promoHint.textContent = `${code}: ${currentPromo.label}`;
            promoHint.style.color = 'rgba(88,255,122,.92)';
            updateSummary();
        }else{
            currentPromo = null;
            promoHint.textContent = `Промокод "${code}" не знайдено`;
            promoHint.style.color = 'rgba(255,77,77,.92)';
            updateSummary();
        }
    });

    updateSummary();
})();
</script>
@endsection
