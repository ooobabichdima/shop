@extends('layouts.app')

@section('title', $product->name . ' - Strikeball Shop')

@section('content')
@push('styles')
<style>
    .product-wrap{display:grid; grid-template-columns: 1.05fr .95fr; gap:16px; padding-bottom:18px}
    .gallery{padding:14px}
    .main-shot{
        height:360px; border-radius:18px; border:1px solid rgba(255,255,255,.12);
        background: radial-gradient(160px 160px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
                    linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
        display:grid; place-items:center; overflow:hidden; font-size:120px;
    }
    .thumbs{display:grid; grid-template-columns: repeat(4, 1fr); gap:10px; margin-top:12px}
    .thumb{
        height:72px; border-radius:14px; border:1px solid rgba(255,255,255,.12);
        background: rgba(0,0,0,.18); cursor:pointer; display:grid; place-items:center;
        transition:.12s ease; color:rgba(255,255,255,.80); font-weight:900;
    }
    .thumb:hover{background:rgba(255,255,255,.06); border-color:rgba(255,255,255,.22); transform:translateY(-1px)}
    .thumb.active{border-color:rgba(88,255,122,.35); background:rgba(88,255,122,.10)}
    .info{padding:16px}
    .info h1{margin:8px 0 8px; font-size:var(--h1); line-height:1.08}
    .rate{display:flex; align-items:center; gap:10px; flex-wrap:wrap; color:var(--muted); font-size:13px}
    .sku{padding:6px 10px; border-radius:999px; border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.05); color:rgba(255,255,255,.78)}
    .pricebox{
        margin-top:14px; padding:14px; border-radius:18px; border:1px solid rgba(255,255,255,.12);
        background: rgba(0,0,0,.18); display:flex; align-items:flex-start; justify-content:space-between;
        gap:12px; flex-wrap:wrap;
    }
    .price{font-weight:950; font-size:22px}
    .stock{color:rgba(255,255,255,.80); font-size:13px}
    .stock b{color:rgba(255,255,255,.95)}
    .qty{
        display:flex; align-items:center; gap:8px;
        border:1px solid rgba(255,255,255,.14); background:rgba(255,255,255,.06);
        padding:8px; border-radius:14px;
    }
    .qty button{width:34px;height:34px;border-radius:12px;border:1px solid rgba(255,255,255,.12);background:rgba(0,0,0,.18);color:var(--text);cursor:pointer}
    .qty input{width:52px;text-align:center;border:none;outline:none;background:transparent;color:var(--text);font-weight:900}
    .bullets{margin:12px 0 0; padding:0; list-style:none; display:grid; gap:8px}
    .bullets li{
        padding:10px 12px; border-radius:14px; border:1px solid rgba(255,255,255,.10);
        background:rgba(255,255,255,.05); color:rgba(255,255,255,.82); font-size:14px;
    }
    .bullets li small{display:block; color:var(--muted); margin-top:3px}
    .tabs{margin-top:16px; border-radius:var(--radius2); border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.04); overflow:hidden}
    .tabbar{
        display:flex; gap:8px; flex-wrap:wrap; padding:10px;
        border-bottom:1px solid rgba(255,255,255,.10); background: rgba(0,0,0,.14);
    }
    .tabbtn{
        padding:10px 12px; border-radius:14px; border:1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05); color:rgba(255,255,255,.85); cursor:pointer;
        font-weight:900; font-size:14px;
    }
    .tabbtn.active{background:rgba(88,255,122,.12); border-color:rgba(88,255,122,.30)}
    .tabpanel{padding:14px}
    .specs{display:grid; grid-template-columns: 1fr 1fr; gap:10px}
    .spec{
        padding:12px; border-radius:14px; border:1px solid rgba(255,255,255,.10);
        background:rgba(255,255,255,.05); display:flex; justify-content:space-between; gap:10px;
        color:rgba(255,255,255,.85); font-size:14px;
    }
    .spec span{color:var(--muted)}
    .related{display:grid; grid-template-columns: repeat(4,1fr); gap:16px; padding:24px 0}
    .p{
        border-radius:var(--radius); border:1px solid rgba(255,255,255,.12);
        background:rgba(255,255,255,.05); overflow:hidden; display:flex; flex-direction:column;
        box-shadow:0 10px 30px rgba(0,0,0,.30); transition:.12s ease;
    }
    .p:hover{transform:translateY(-2px); border-color:rgba(255,255,255,.22); background:rgba(255,255,255,.06)}
    .p .img{
        height:150px; display:grid; place-items:center;
        background: radial-gradient(120px 120px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
                    linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
        border-bottom:1px solid rgba(255,255,255,.10); font-size:48px;
    }
    .p .body{padding:12px}
    .p .title{font-weight:950; font-size:14.5px}
    .p .meta{margin-top:6px; color:var(--muted); font-size:12.5px}
    .p .foot{margin-top:auto; padding:12px; border-top:1px solid rgba(255,255,255,.10); display:flex; justify-content:space-between; align-items:center; gap:10px}
    @media (max-width: 980px){
        .product-wrap{grid-template-columns: 1fr}
        .related{grid-template-columns: repeat(2,1fr)}
    }
    @media (max-width: 560px){
        .thumbs{grid-template-columns: repeat(3, 1fr)}
        .specs{grid-template-columns: 1fr}
        .related{grid-template-columns: 1fr}
    }
</style>
@endpush

<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a> /
    <a href="#">Каталог</a> /
    <a href="{{ route('category.show', $product->category->slug) }}">{{ $product->category->name }}</a> /
    <span>{{ $product->name }}</span>
</div>

<section class="product-wrap">
    <!-- Gallery -->
    <div class="card gallery" aria-label="Галерея товару">
        <div class="row" style="justify-content:space-between; flex-wrap:wrap;">
            <span class="pill">
                @if($product->is_featured)★ Хіт • @endif
                @if($product->isInStock())В наявності @else Немає в наявності @endif
            </span>
            @if($product->brand)
                <span class="pill">{{ $product->brand->name }}</span>
            @endif
        </div>

        <div class="main-shot" id="mainShot" aria-label="Основне зображення">
            <span>📦</span>
        </div>

        <div class="thumbs" role="list" aria-label="Мініатюри">
            <button class="thumb active" data-shot="1" type="button" aria-label="Фото 1">1</button>
            <button class="thumb" data-shot="2" type="button" aria-label="Фото 2">2</button>
            <button class="thumb" data-shot="3" type="button" aria-label="Фото 3">3</button>
            <button class="thumb" data-shot="4" type="button" aria-label="Фото 4">4</button>
        </div>

        @if($product->description)
        <ul class="bullets" style="margin-top:12px;">
            <li><b>Опис</b> <small>{{ Str::limit($product->description, 120) }}</small></li>
            @if($product->brand)
            <li><b>Бренд</b> <small>{{ $product->brand->name }}</small></li>
            @endif
        </ul>
        @endif
    </div>

    <!-- Info -->
    <div class="card info" aria-label="Інформація про товар">
        <span class="pill">{{ $product->category->name }}</span>
        <h1>{{ $product->name }}</h1>

        <div class="rate">
            @if($product->rating)
                <span>
                    <span class="star">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= $product->rating ? '★' : '☆' }}
                        @endfor
                    </span>
                    <b>{{ number_format($product->rating, 1) }}</b>
                    @if($product->reviews_count)({{ $product->reviews_count }})@endif
                </span>
                <span class="muted2">•</span>
            @endif
            <span class="sku">SKU: {{ $product->sku }}</span>
            <span class="muted2">•</span>
            <span class="muted">Доставка 1–3 дні</span>
        </div>

        <form method="POST" action="{{ route('cart.add') }}" id="addToCartForm">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="pricebox">
                <div>
                    <div class="price">
                        {{ number_format($product->price, 0) }} грн
                        @if($product->old_price && $product->old_price > $product->price)
                            <span class="strike">{{ number_format($product->old_price, 0) }}</span>
                        @endif
                    </div>
                    <div class="stock">
                        Наявність: <b>{{ $product->isInStock() ? 'в наявності' : 'немає' }}</b>
                        @if($product->isInStock()) • Залишок: <b>{{ $product->stock }}</b>@endif
                    </div>
                </div>

                <div class="row" style="flex-wrap:wrap; justify-content:flex-end;">
                    <div class="qty" aria-label="Кількість">
                        <button type="button" id="minus" aria-label="Мінус">−</button>
                        <input id="qty" name="quantity" type="text" value="1" inputmode="numeric" />
                        <button type="button" id="plus" aria-label="Плюс">+</button>
                    </div>
                    <button class="btn primary" type="submit" @if(!$product->isInStock())disabled @endif>В кошик</button>
                </div>
            </div>
        </form>

        <div class="row" style="flex-wrap:wrap; margin-top:12px;">
            <a class="btn small" href="#tabs">Опис</a>
            <a class="btn small" href="#tabs">Характеристики</a>
        </div>

        <div class="tabs" id="tabs">
            <div class="tabbar" role="tablist" aria-label="Вкладки">
                <button class="tabbtn active" data-tab="desc" type="button" role="tab">Опис</button>
                <button class="tabbtn" data-tab="specs" type="button" role="tab">Характеристики</button>
            </div>

            <div class="tabpanel" data-panel="desc">
                @if($product->description)
                    <p style="margin:0 0 10px; color:rgba(255,255,255,.84);">
                        {{ $product->description }}
                    </p>
                @else
                    <p style="margin:0; color:var(--muted);">Опис товару відсутній.</p>
                @endif
            </div>

            <div class="tabpanel" data-panel="specs" style="display:none;">
                @if($product->specs && count($product->specs) > 0)
                    <div class="specs">
                        @foreach($product->specs as $key => $value)
                            <div class="spec">
                                <b>{{ ucfirst($key) }}</b>
                                <span>{{ $value }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="margin:0; color:var(--muted);">Характеристики не вказані.</p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
@if($product->recommended && $product->recommended->count() > 0)
<div class="section-title">
    <h2>Рекомендовані товари</h2>
    <p class="muted">Товари, які часто купують разом</p>
</div>

<div class="related">
    @foreach($product->recommended as $rec)
    <a href="{{ route('product.show', $rec->slug) }}" class="p" style="text-decoration:none;color:inherit;">
        <div class="img">
            <span>📦</span>
        </div>
        <div class="body">
            <div class="title">{{ $rec->name }}</div>
            <div class="meta">{{ $rec->brand ? $rec->brand->name : $rec->sku }}</div>
        </div>
        <div class="foot">
            <div style="font-weight:950;">{{ number_format($rec->price, 0) }} грн</div>
            <span class="btn small primary">Купити</span>
        </div>
    </a>
    @endforeach
</div>
@endif

@push('scripts')
<script>
    // Quantity controls
    const qtyInput = document.getElementById('qty');
    const minusBtn = document.getElementById('minus');
    const plusBtn = document.getElementById('plus');
    const maxStock = {{ $product->stock }};

    minusBtn?.addEventListener('click', () => {
        const val = parseInt(qtyInput.value) || 1;
        if (val > 1) qtyInput.value = val - 1;
    });

    plusBtn?.addEventListener('click', () => {
        const val = parseInt(qtyInput.value) || 1;
        if (val < maxStock) qtyInput.value = val + 1;
    });

    // Tabs
    document.querySelectorAll('.tabbtn').forEach(btn => {
        btn.addEventListener('click', () => {
            const tab = btn.dataset.tab;
            document.querySelectorAll('.tabbtn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tabpanel').forEach(p => p.style.display = 'none');
            btn.classList.add('active');
            document.querySelector(`[data-panel="${tab}"]`).style.display = 'block';
        });
    });

    // Thumbs
    document.querySelectorAll('.thumb').forEach(thumb => {
        thumb.addEventListener('click', () => {
            document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
        });
    });
</script>
@endpush
@endsection
