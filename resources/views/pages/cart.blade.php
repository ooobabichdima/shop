@extends('layouts.app')

@section('title', 'Кошик - Strikeball Shop')

@section('content')
<style>
.cart-layout{
    display:grid;
    grid-template-columns: 1.35fr .65fr;
    gap:16px;
    padding:10px 0 22px;
}
.cart-list{padding:20px;}
.cart-item{
    display:grid;
    grid-template-columns: 80px 1fr auto;
    gap:14px;
    padding:14px;
    border-radius:18px;
    border:1px solid rgba(255,255,255,.10);
    background:rgba(0,0,0,.16);
    align-items:center;
    margin-bottom:12px;
}
.cart-thumb{
    width:80px;
    height:80px;
    border-radius:16px;
    border:1px solid rgba(255,255,255,.12);
    background:
        radial-gradient(40px 40px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
        linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
    display:grid;
    place-items:center;
    overflow:hidden;
}
.cart-thumb img{
    width:100%;
    height:100%;
    object-fit:cover;
}
.cart-info{
    display:flex;
    flex-direction:column;
    gap:8px;
}
.cart-title{
    font-weight:950;
    font-size:15px;
}
.cart-meta{
    color:var(--muted);
    font-size:13px;
}
.cart-right{
    display:grid;
    gap:10px;
    justify-items:end;
}
.cart-price{
    font-weight:950;
    font-size:18px;
}
.mini-qty{
    display:flex;
    align-items:center;
    gap:6px;
    border:1px solid rgba(255,255,255,.14);
    background:rgba(255,255,255,.06);
    padding:6px;
    border-radius:12px;
}
.mini-qty button{
    width:28px;
    height:28px;
    border-radius:10px;
    border:1px solid rgba(255,255,255,.12);
    background:rgba(0,0,0,.18);
    color:var(--text);
    cursor:pointer;
    transition:.12s ease;
}
.mini-qty button:hover{
    background:rgba(255,255,255,.08);
}
.mini-qty input{
    width:44px;
    text-align:center;
    border:none;
    outline:none;
    background:transparent;
    color:var(--text);
    font-weight:950;
}
.link-danger{
    color:rgba(255,77,77,.92);
    font-weight:900;
    font-size:13px;
    cursor:pointer;
}
.link-danger:hover{
    text-decoration:underline;
}
.summary{
    padding:20px;
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
.promo-input{
    flex:1;
    min-width:140px;
    padding:12px;
    border-radius:14px;
    border:1px solid rgba(255,255,255,.12);
    background:rgba(255,255,255,.06);
    color:var(--text);
    outline:none;
}
.promo-input::placeholder{
    color:rgba(255,255,255,.45);
}
.delivery-option{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:10px 12px;
    border-radius:14px;
    border:1px solid rgba(255,255,255,.10);
    background:rgba(0,0,0,.14);
    cursor:pointer;
    transition:.12s ease;
}
.delivery-option:hover{
    background:rgba(255,255,255,.04);
}
.delivery-option input[type="radio"]{
    accent-color:var(--accent);
}
@media (max-width: 980px){
    .cart-layout{
        grid-template-columns: 1fr;
    }
    .summary{
        position:static;
    }
}
@media (max-width: 560px){
    .cart-item{
        grid-template-columns: 64px 1fr;
        gap:10px;
    }
    .cart-right{
        grid-column: 1 / -1;
        justify-items:start;
        grid-template-columns: 1fr auto;
        width:100%;
    }
}
</style>

<div style="padding:20px 0;">
    <div class="crumbs" style="padding:8px 0 16px; color:rgba(255,255,255,.62); font-size:13px;">
        <a href="{{ route('home') }}" style="color:rgba(255,255,255,.72);">Головна</a> / <span>Кошик</span>
    </div>

    <div style="display:flex; justify-content:space-between; align-items:flex-end; gap:14px; flex-wrap:wrap; margin-bottom:20px;">
        <div>
            <h1 style="margin:0 0 8px; font-size:clamp(24px,2.8vw,38px);">Кошик</h1>
            <div style="color:var(--muted); font-size:14px;">Перевір кількість товарів — підсумок оновиться автоматично</div>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <span class="pill" id="itemsPill" style="padding:8px 12px; border-radius:999px; background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.10); font-size:13px;">
                {{ count($cart) }} {{ count($cart) == 1 ? 'позиція' : 'позицій' }}
            </span>
            <a href="{{ route('home') }}" class="btn small">Продовжити покупки</a>
        </div>
    </div>

    @if(empty($cart))
        <div class="card" style="text-align:center; padding:60px 20px;">
            <div style="font-size:64px; opacity:.3; margin-bottom:20px;">🛒</div>
            <h3 style="margin:0 0 10px;">Кошик порожній</h3>
            <p style="color:var(--muted); margin:0 0 24px;">Додай товари з каталогу</p>
            <a href="{{ route('home') }}" class="btn primary">До каталогу</a>
        </div>
    @else
        <div class="cart-layout">
            <!-- LEFT: Cart Items -->
            <div class="card cart-list">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; flex-wrap:wrap;">
                    <div>
                        <b style="font-size:16px;">Товари в кошику</b>
                        <div style="color:var(--muted2); font-size:13px; margin-top:4px;">Змінюй кількість за допомогою кнопок +/−</div>
                    </div>
                    <form method="POST" action="{{ route('cart.clear') }}" style="margin:0;" onsubmit="return confirm('Очистити кошик?')">
                        @csrf
                        <button type="submit" class="btn small">Очистити кошик</button>
                    </form>
                </div>

                <div id="cartItems">
                    @php $subtotal = 0; @endphp
                    @foreach($cart as $index => $item)
                        @if(isset($item['product']))
                            @php
                                $product = $item['product'];
                                $itemTotal = $product->price * $item['quantity'];
                                $subtotal += $itemTotal;
                            @endphp
                            <div class="cart-item" data-id="{{ $product->id }}" data-price="{{ $product->price }}">
                                <div class="cart-thumb">
                                    @if($product->primaryImage)
                                        <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" alt="{{ $product->name }}">
                                    @else
                                        <svg width="40" height="40" viewBox="0 0 120 120" fill="none">
                                            <path d="M20 70c20-18 40-26 80-30l5 10-70 16-6 10-9 2Z" stroke="rgba(255,255,255,.9)" stroke-width="4" stroke-linejoin="round"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="cart-info">
                                    <div class="cart-title">{{ $product->name }}</div>
                                    <div class="cart-meta">
                                        SKU: {{ $product->sku }} •
                                        <span style="color:rgba(255,255,255,.45);">Ціна за шт.</span>
                                        <b>{{ number_format($product->price, 0, '', ' ') }} грн</b>
                                        @if($product->old_price && $product->old_price > $product->price)
                                            <span style="color:rgba(255,255,255,.45); text-decoration:line-through; margin-left:4px;">{{ number_format($product->old_price, 0, '', ' ') }} грн</span>
                                        @endif
                                    </div>
                                    <div class="mini-qty">
                                        <button type="button" class="qty-minus">−</button>
                                        <input type="text" class="qty-input" value="{{ $item['quantity'] }}" data-product-id="{{ $product->id }}" readonly>
                                        <button type="button" class="qty-plus">+</button>
                                    </div>
                                </div>
                                <div class="cart-right">
                                    <div class="cart-price item-total">{{ number_format($itemTotal, 0, '', ' ') }} грн</div>
                                    <form method="POST" action="{{ route('cart.remove') }}" style="margin:0;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="link-danger" style="border:none; background:none;">Видалити</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="sum-box">
                    <b>Підказка</b>
                    <div style="color:var(--muted); font-size:13px;">
                        Новачкам рекомендуємо: 2–3 магазини, акумулятор LiPo 7.4V + розумне зарядний пристрій, кулі 0.25–0.28г.
                    </div>
                </div>
            </div>

            <!-- RIGHT: Summary -->
            <aside class="card summary">
                <div style="margin-bottom:14px;">
                    <b style="font-size:16px;">Підсумок замовлення</b>
                    <div style="color:var(--muted2); font-size:13px; margin-top:4px;">Сума оновлюється автоматично</div>
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
                        <input type="text" class="promo-input" id="promoInput" placeholder="Наприклад: START10">
                        <button type="button" class="btn small" id="applyPromo">Застосувати</button>
                    </div>
                    <div id="promoNotice" style="display:none; padding:10px 12px; border-radius:14px; font-size:13px; margin-top:8px;"></div>
                </div>

                <div class="sum-box">
                    <b>Спосіб доставки</b>
                    <div style="color:var(--muted2); font-size:13px; margin-top:4px;">Обери зручний спосіб</div>
                    <div style="display:grid; gap:10px; margin-top:10px;">
                        <label class="delivery-option">
                            <span>Нова Пошта (відділення)</span>
                            <input type="radio" name="shipping" value="np" checked>
                        </label>
                        <label class="delivery-option">
                            <span>Кур'єр по місту</span>
                            <input type="radio" name="shipping" value="courier">
                        </label>
                        <label class="delivery-option">
                            <span>Самовивіз</span>
                            <input type="radio" name="shipping" value="pickup">
                        </label>
                    </div>
                </div>

                <a href="{{ route('checkout') }}" class="btn primary" style="width:100%; justify-content:center; margin-top:10px;">
                    Перейти до оформлення
                </a>

                <div style="color:var(--muted2); margin-top:12px; font-size:12px;">
                    Натискаючи "Оформлення", ти приймаєш умови договору публічної оферти та політики конфіденційності.
                </div>
            </aside>
        </div>
    @endif
</div>

<script>
(function(){
    const cartItems = document.getElementById('cartItems');
    if(!cartItems) return;

    const elSubtotal = document.getElementById('sumSubtotal');
    const elDiscount = document.getElementById('sumDiscount');
    const elShipping = document.getElementById('sumShipping');
    const elTotal = document.getElementById('sumTotal');
    const elPill = document.getElementById('itemsPill');

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

    const fmt = (n) => Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g,' ') + ' грн';

    function calculateSubtotal(){
        let total = 0;
        document.querySelectorAll('.cart-item').forEach(item => {
            const price = parseFloat(item.dataset.price);
            const qty = parseInt(item.querySelector('.qty-input').value);
            total += price * qty;
        });
        return total;
    }

    function calculateDiscount(subtotal){
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
        const subtotal = calculateSubtotal();
        const discount = calculateDiscount(subtotal);
        const shipping = SHIPPING_COSTS[currentShipping];
        const total = Math.max(0, subtotal - discount + shipping);

        elSubtotal.textContent = fmt(subtotal);
        elDiscount.textContent = fmt(discount);
        elShipping.textContent = fmt(shipping);
        elTotal.textContent = fmt(total);

        const itemCount = document.querySelectorAll('.cart-item').length;
        elPill.textContent = `${itemCount} ${itemCount === 1 ? 'позиція' : 'позицій'}`;
    }

    // Quantity controls
    document.querySelectorAll('.cart-item').forEach(item => {
        const input = item.querySelector('.qty-input');
        const plusBtn = item.querySelector('.qty-plus');
        const minusBtn = item.querySelector('.qty-minus');
        const itemTotalEl = item.querySelector('.item-total');
        const price = parseFloat(item.dataset.price);
        const productId = input.dataset.productId;

        function updateItemQty(newQty){
            newQty = Math.max(1, Math.min(99, newQty));
            input.value = newQty;
            itemTotalEl.textContent = fmt(price * newQty);
            updateSummary();

            // Update on server
            fetch('{{ route("cart.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: newQty
                })
            });
        }

        plusBtn.addEventListener('click', () => updateItemQty(parseInt(input.value) + 1));
        minusBtn.addEventListener('click', () => updateItemQty(parseInt(input.value) - 1));
    });

    // Promo code
    const promoInput = document.getElementById('promoInput');
    const promoNotice = document.getElementById('promoNotice');
    const applyPromoBtn = document.getElementById('applyPromo');

    applyPromoBtn.addEventListener('click', () => {
        const code = promoInput.value.trim().toUpperCase();

        if(!code){
            currentPromo = null;
            promoNotice.style.display = 'none';
            updateSummary();
            return;
        }

        if(PROMOS[code]){
            currentPromo = PROMOS[code];
            promoNotice.style.display = 'block';
            promoNotice.style.border = '1px solid rgba(88,255,122,.25)';
            promoNotice.style.background = 'rgba(88,255,122,.10)';
            promoNotice.style.color = 'rgba(255,255,255,.88)';
            promoNotice.textContent = `${code}: ${currentPromo.label}`;
            updateSummary();
        }else{
            currentPromo = null;
            promoNotice.style.display = 'block';
            promoNotice.style.border = '1px solid rgba(255,77,77,.25)';
            promoNotice.style.background = 'rgba(255,77,77,.10)';
            promoNotice.style.color = 'rgba(255,255,255,.88)';
            promoNotice.textContent = `Промокод "${code}" не знайдено`;
            updateSummary();
        }
    });

    // Shipping
    document.querySelectorAll('input[name="shipping"]').forEach(radio => {
        radio.addEventListener('change', () => {
            currentShipping = radio.value;
            updateSummary();
        });
    });

    updateSummary();
})();
</script>
@endsection
