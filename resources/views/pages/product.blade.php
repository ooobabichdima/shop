@extends('layouts.app')

@section('title', $product->name . ' - Strikeball Shop')
@section('description', Str::limit(strip_tags($product->description ?? 'Купити ' . $product->name . ' в інтернет-магазині Strikeball Shop. ' . ($product->isInStock() ? 'В наявності' : 'Під замовлення') . '. Ціна: ' . number_format($product->price, 0) . ' грн'), 160))
@section('keywords', $product->name . ', ' . $product->category->name . ', ' . ($product->brand ? $product->brand->name . ', ' : '') . 'страйкбол, airsoft, купити')
@section('canonical', route('product.show', $product->slug))

@section('og_type', 'product')
@section('og_title', $product->name . ' - ' . number_format($product->price, 0) . ' грн')
@section('og_description', Str::limit(strip_tags($product->description ?? 'Купити ' . $product->name), 200))
@section('og_image', $product->primaryImage ? asset('storage/' . $product->primaryImage->image_path) : asset('images/og-default.jpg'))

@push('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $product->name }}",
  "image": [
    @if($product->primaryImage)
    "{{ asset('storage/' . $product->primaryImage->image_path) }}"
    @endif
  ],
  "description": "{{ strip_tags($product->description ?? '') }}",
  "sku": "{{ $product->sku }}",
  "brand": {
    "@type": "Brand",
    "name": "{{ $product->brand->name ?? 'Strikeball Shop' }}"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ route('product.show', $product->slug) }}",
    "priceCurrency": "UAH",
    "price": "{{ $product->price }}",
    @if($product->old_price)
    "priceValidUntil": "{{ now()->addMonths(1)->format('Y-m-d') }}",
    @endif
    "availability": "{{ $product->isInStock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
    "itemCondition": "https://schema.org/NewCondition"
  }
  @if($product->rating)
  ,"aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "{{ $product->rating }}",
    "reviewCount": "{{ $product->reviews_count ?? 1 }}"
  }
  @endif
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Головна",
    "item": "{{ route('home') }}"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "{{ $product->category->name }}",
    "item": "{{ route('category.show', $product->category->slug) }}"
  },{
    "@type": "ListItem",
    "position": 3,
    "name": "{{ $product->name }}"
  }]
}
</script>
@endpush

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

    /* section titles */
    .section-title{display:flex; align-items:flex-end; justify-content:space-between; gap:16px; margin:18px 0 10px}
    .section-title h2{margin:0; font-size:var(--h2)}
    .section-title p{margin:0; color:var(--muted); font-size:14px}

    /* tuning kits */
    .kits{display:grid; grid-template-columns: 1fr; gap:12px; margin-bottom:18px}
    .kit{
        padding:14px; border-radius:18px; border:1px solid rgba(255,255,255,.12);
        background:rgba(255,255,255,.05); display:grid; gap:10px;
    }
    .kit:hover{border-color:rgba(255,255,255,.22); background:rgba(255,255,255,.06)}
    .kit-top{display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; align-items:flex-start}
    .kit-name{font-weight:950; font-size:15px}
    .kit-tag{
        display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:999px;
        border:1px solid rgba(255,255,255,.12); background:rgba(0,0,0,.18);
        color:rgba(255,255,255,.78); font-size:12px; font-weight:950;
    }
    .kit-list{margin:0; padding-left:18px; color:rgba(255,255,255,.82); font-size:14px}
    .kit-list li{margin:6px 0}
    .kit-foot{display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; align-items:center}
    .kit-price{font-weight:950; font-size:18px}
    .kit-note{color:rgba(255,255,255,.55); font-size:12.5px; max-width:70ch}
    .radio{
        display:flex; align-items:center; gap:10px; cursor:pointer; padding:10px 12px;
        border-radius:14px; border:1px solid rgba(255,255,255,.10); background:rgba(0,0,0,.14);
    }
    .radio:hover{border-color:rgba(255,255,255,.18); background:rgba(255,255,255,.04)}
    .radio input{width:16px; height:16px; accent-color: var(--accent)}

    /* bundle */
    .bundle{
        border-radius:var(--radius2); border:1px solid rgba(255,255,255,.12);
        background:rgba(255,255,255,.04); overflow:hidden; margin-bottom:18px;
    }
    .bundle-head{
        padding:12px 14px; border-bottom:1px solid rgba(255,255,255,.10);
        background:rgba(0,0,0,.14); display:flex; justify-content:space-between;
        gap:12px; flex-wrap:wrap; align-items:flex-end;
    }
    .bundle-head b{font-size:16px}
    .bundle-body{padding:14px; display:grid; gap:12px}
    .bundle-items{display:grid; grid-template-columns: repeat(2,1fr); gap:12px}
    .addon{
        padding:12px; border-radius:16px; border:1px solid rgba(255,255,255,.12);
        background:rgba(255,255,255,.05);
    }
    .addon:hover{border-color:rgba(255,255,255,.22); background:rgba(255,255,255,.06)}
    .addon-top{display:flex; gap:12px; align-items:flex-start}
    .addon-img{
        width:64px; height:64px; min-width:64px; border-radius:12px;
        border:1px solid rgba(255,255,255,.12);
        background:radial-gradient(30px 30px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
                   linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
        display:grid; place-items:center; overflow:hidden;
    }
    .addon-img img{width:100%; height:100%; object-fit:cover}
    .addon-info{flex:1; display:flex; flex-direction:column; gap:4px}
    .addon-title{font-weight:950; font-size:14px}
    .addon-meta{color:rgba(255,255,255,.60); font-size:12.5px}
    .addon-controls{display:flex; flex-direction:column; gap:8px; align-items:flex-end}
    .addon-check{display:flex; align-items:center; gap:10px}
    .addon-check input{width:16px; height:16px; accent-color: var(--accent)}
    .addon-price{font-weight:950}

    .addon-controls{display:flex; align-items:center; gap:10px; flex-wrap:wrap; justify-content:flex-end}
    .mini-qty{
        display:flex; align-items:center; gap:6px;
        border:1px solid rgba(255,255,255,.14);
        background:rgba(0,0,0,.16);
        padding:6px; border-radius:12px;
    }
    .mini-qty button{
        width:28px; height:28px; border-radius:10px;
        border:1px solid rgba(255,255,255,.12);
        background:rgba(255,255,255,.06);
        color:var(--text);
        cursor:pointer;
    }
    .mini-qty input{
        width:44px; text-align:center;
        border:none; outline:none; background:transparent; color:var(--text);
        font-weight:950;
    }
    .mini-qty[aria-disabled="true"]{opacity:.55}
    .mini-qty[aria-disabled="true"] button,
    .mini-qty[aria-disabled="true"] input{pointer-events:none}

    .bundle-total{
        padding:12px 14px; border-radius:18px; border:1px solid rgba(255,255,255,.12);
        background:rgba(0,0,0,.18); display:flex; justify-content:space-between;
        gap:12px; flex-wrap:wrap; align-items:center;
    }
    .bundle-total .sum{font-weight:950; font-size:18px}

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
        .bundle-items{grid-template-columns:1fr}
    }
</style>
@endpush

<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a>
    <span class="crumbs-sep">/</span>
    <a href="{{ route('catalog') }}">Каталог</a>
    <span class="crumbs-sep">/</span>
    <a href="{{ route('category.show', $product->category->slug) }}">{{ $product->category->name }}</a>
    <span class="crumbs-sep">/</span>
    <span>{{ $product->name }}</span>
</div>

<section class="product-wrap">
    <!-- Gallery -->
    <div class="card gallery" aria-label="Галерея товару">
        <div class="row" style="justify-content:space-between; flex-wrap:wrap;">
            <span class="pill">
                @if($product->is_featured)★ Хіт • @endif
{{ $product->stock_status }}
            </span>
            @if($product->brand)
                <span class="pill">{{ $product->brand->name }}</span>
            @endif
        </div>

        <div class="main-shot" id="mainShot" aria-label="Основне зображення">
            @if($product->getYoutubeVideoId())
                <div id="videoContainer" style="display:none;width:100%;height:100%;">
                    <iframe
                        id="youtubeFrame"
                        width="100%"
                        height="100%"
                        src="https://www.youtube.com/embed/{{ $product->getYoutubeVideoId() }}?rel=0"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        style="border-radius:18px;">
                    </iframe>
                </div>
            @endif
            <span id="placeholderIcon">📦</span>
        </div>

        <div class="thumbs" role="list" aria-label="Мініатюри">
            @if($product->getYoutubeVideoId())
            <button class="thumb active" data-shot="video" type="button" aria-label="Відео">
                <div style="position:relative;display:grid;place-items:center;width:100%;height:100%;">
                    <span style="font-size:24px;">▶</span>
                </div>
            </button>
            @endif
            <button class="thumb {{ !$product->getYoutubeVideoId() ? 'active' : '' }}" data-shot="1" type="button" aria-label="Фото 1">1</button>
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

        @if($product->variations->isNotEmpty())
        <div style="margin:16px 0;">
            <div style="font-size:13px;font-weight:700;color:var(--muted);margin-bottom:10px;">
                Доступні кольори:
            </div>
            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                <a href="{{ route('product.show', $product->slug) }}"
                    class="variation-card {{ !$product->color ? '' : 'active' }}"
                    style="display:flex;align-items:center;gap:8px;padding:8px 12px;border-radius:10px;
                    border:2px solid {{ !$product->color ? 'rgba(88,255,122,.4)' : 'rgba(255,255,255,.14)' }};
                    background:{{ !$product->color ? 'rgba(88,255,122,.10)' : 'rgba(255,255,255,.05)' }};
                    transition:.12s ease;text-decoration:none;">
                    @if($product->primaryImage)
                        <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}"
                            alt="{{ $product->name }}"
                            style="width:32px;height:32px;border-radius:6px;object-fit:cover;">
                    @endif
                    <div>
                        <div style="font-size:12px;font-weight:700;color:var(--text);">
                            {{ $product->color ?: 'Базовий' }}
                        </div>
                        <div style="font-size:11px;color:var(--muted);">
                            {{ number_format($product->price, 0, '', ' ') }} грн
                        </div>
                    </div>
                </a>
                @foreach($product->variations as $variation)
                <a href="{{ route('product.show', $variation->slug) }}"
                    style="display:flex;align-items:center;gap:8px;padding:8px 12px;border-radius:10px;
                    border:2px solid rgba(255,255,255,.14);background:rgba(255,255,255,.05);
                    transition:.12s ease;text-decoration:none;">
                    @if($variation->primaryImage)
                        <img src="{{ asset('storage/' . $variation->primaryImage->image_path) }}"
                            alt="{{ $variation->name }}"
                            style="width:32px;height:32px;border-radius:6px;object-fit:cover;">
                    @else
                        <div style="width:32px;height:32px;border-radius:6px;background:rgba(255,255,255,.08);
                            display:grid;place-items:center;font-size:14px;">📦</div>
                    @endif
                    <div>
                        <div style="font-size:12px;font-weight:700;color:var(--text);">
                            {{ $variation->color ?: $variation->name }}
                        </div>
                        <div style="font-size:11px;color:var(--muted);">
                            {{ number_format($variation->price, 0, '', ' ') }} грн
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

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
                        @php
                            $stockBadge = $product->stock_status_badge;
                            $availableStock = $product->available_stock;
                        @endphp
                        @if($stockBadge['class'] === 'in-stock')
                            <span style="color:var(--success);">{{ $stockBadge['text'] }}</span>
                            @if($availableStock > 0)
                                • Доступно: <b>{{ $availableStock }} шт</b>
                            @endif
                        @else
                            <span style="color:var(--accent);">{{ $stockBadge['text'] }}</span>
                            <span style="font-size:12px;color:var(--muted);"> • Термін: 3-7 днів</span>
                        @endif
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

        <div class="row" style="flex-wrap:wrap; margin-top:12px; gap:8px;">
            <button class="btn small" type="button" onclick="openQuickOrder({{ $product->id }}, '{{ addslashes($product->name) }}')">
                ⚡ Купити в 1 клік
            </button>
            @php $inWish = in_array($product->id, session('wishlist', [])); @endphp
            <button class="btn small {{ $inWish ? 'wishlisted' : '' }}" type="button"
                onclick="toggleWishlist(this, {{ $product->id }})"
                title="{{ $inWish ? 'Видалити з обраного' : 'Додати в обране' }}"
                style="{{ $inWish ? 'color:var(--accent);border-color:rgba(245,158,11,.3);background:rgba(245,158,11,.1);' : '' }}">
                {{ $inWish ? '❤️' : '🤍' }} В обране
            </button>
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

<!-- Tuning Kits -->
@if(isset($product->tuning_kits) && is_array($product->tuning_kits) && count($product->tuning_kits) > 0)
<div class="section-title">
    <div>
        <h2>Пакети тюнінгу</h2>
        <p>Готові комплекти апгрейду під ваш стиль гри</p>
    </div>
    <a class="btn small" href="#tabs">Дивитись характеристики</a>
</div>

<div class="kits" aria-label="Пакети тюнінгу">
    @foreach($product->tuning_kits as $index => $kit)
    <div class="kit">
        <div class="kit-top">
            <label class="radio" style="flex:1; min-width:260px;">
                <input type="radio" name="tuningKit" value="{{ $index }}" {{ $index === 0 ? 'checked' : '' }} />
                <div>
                    <div class="kit-name">{{ $kit['name'] ?? 'Пакет тюнінгу #' . ($index + 1) }}</div>
                    <div class="muted2" style="font-size:13px;">{{ $kit['description'] ?? '' }}</div>
                </div>
            </label>
            @if(isset($kit['tag']))
            <span class="kit-tag">{{ $kit['tag'] }}</span>
            @endif
        </div>
        @if(isset($kit['items']) && is_array($kit['items']))
        <ul class="kit-list">
            @foreach($kit['items'] as $item)
            <li>{{ $item }}</li>
            @endforeach
        </ul>
        @endif
        <div class="kit-foot">
            <div>
                <div class="kit-price" data-kit-price="{{ $kit['price'] ?? 0 }}">{{ number_format($kit['price'] ?? 0, 0) }} грн</div>
                @if(isset($kit['note']))
                <div class="kit-note">{{ $kit['note'] }}</div>
                @endif
            </div>
            <button class="btn small primary" type="button" data-add-kit="{{ $index }}">Додати пакет</button>
        </div>
    </div>
    @endforeach
</div>
@endif

<!-- Bundle / Recommended Items -->
@if($product->recommended && $product->recommended->count() > 0)
<div class="bundle" style="margin-top:16px;" aria-label="Рекомендовані товари">
    <div class="bundle-head">
        <div>
            <b>З цим товаром купують</b>
            <div class="muted" style="font-size:13px; margin-top:4px;">Оберіть товари — сума розраховується автоматично</div>
        </div>
        <button class="btn small" type="button" id="selectRecommended">Обрати рекомендоване</button>
    </div>

    <div class="bundle-body">
        <div class="bundle-items">
            @foreach($product->recommended->take(4) as $index => $rec)
            <div class="addon" data-has-qty="{{ $index === 0 ? '1' : '0' }}">
                <div class="addon-top">
                    <div class="addon-img">
                        @if($rec->primaryImage)
                            <img src="{{ asset('storage/' . $rec->primaryImage->image_path) }}" alt="{{ $rec->name }}">
                        @else
                            <svg width="32" height="32" viewBox="0 0 120 120" fill="none">
                                <path d="M20 70c20-18 40-26 80-30l5 10-70 16-6 10-9 2Z" stroke="rgba(255,255,255,.9)" stroke-width="4" stroke-linejoin="round"/>
                            </svg>
                        @endif
                    </div>
                    <div class="addon-info">
                        <div class="addon-title">{{ $rec->name }}</div>
                        <div class="addon-meta">{{ $rec->brand ? $rec->brand->name : 'SKU: ' . $rec->sku }}</div>
                        @if($rec->description)
                        <div class="muted2" style="font-size:12px; margin-top:4px;">{{ Str::limit($rec->description, 60) }}</div>
                        @endif
                    </div>

                    <div class="addon-controls">
                        <label class="addon-check" title="Додати">
                            <input type="checkbox" class="addonBox" data-addon-id="{{ $rec->id }}" data-addon-price="{{ $rec->price }}" />
                            <span class="addon-price">{{ number_format($rec->price, 0) }} грн{{ $index === 0 ? '/шт' : '' }}</span>
                        </label>

                        @if($index === 0)
                        <div class="mini-qty" aria-label="Кількість" aria-disabled="true">
                            <button type="button" class="aqMinus" aria-label="Мінус">−</button>
                            <input type="text" class="aqInput" value="1" inputmode="numeric" />
                            <button type="button" class="aqPlus" aria-label="Плюс">+</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="bundle-total">
            <div>
                <div class="muted2" style="font-size:13px;">Разом по додаткам (до товару):</div>
                <div class="sum" id="bundleSum">0 грн</div>
            </div>
            <div class="row" style="flex-wrap:wrap; justify-content:flex-end;">
                <button class="btn small" type="button" id="clearAddons">Очистити</button>
                <button class="btn primary" type="button" id="addBundleToCart">Додати обране</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Related Products -->
@if($product->recommended && $product->recommended->count() > 4)
<div class="section-title">
    <h2>Схожі товари</h2>
    <p class="muted">Інші товари, які можуть вас зацікавити</p>
</div>

<div class="related">
    @foreach($product->recommended->skip(4)->take(4) as $rec)
    <a href="{{ route('product.show', $rec->slug) }}" class="p" style="text-decoration:none;color:inherit;">
        <div class="img">
            @if($rec->primaryImage)
                <img src="{{ asset('storage/' . $rec->primaryImage->image_path) }}" alt="{{ $rec->name }}" style="width:100%;height:100%;object-fit:cover;">
            @else
                <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                    <path d="M20 70c20-18 40-26 80-30l5 10-70 16-6 10-9 2Z" stroke="rgba(255,255,255,.9)" stroke-width="4" stroke-linejoin="round"/>
                </svg>
            @endif
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
    const videoContainer = document.getElementById('videoContainer');
    const placeholderIcon = document.getElementById('placeholderIcon');

    document.querySelectorAll('.thumb').forEach(thumb => {
        thumb.addEventListener('click', () => {
            document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');

            const shotType = thumb.dataset.shot;

            if (shotType === 'video' && videoContainer) {
                // Show video
                videoContainer.style.display = 'block';
                placeholderIcon.style.display = 'none';
            } else {
                // Show photo placeholder
                if (videoContainer) videoContainer.style.display = 'none';
                if (placeholderIcon) placeholderIcon.style.display = 'block';
            }
        });
    });

    // Bundle functionality
    const addonBoxes = document.querySelectorAll('.addonBox');
    const bundleSumEl = document.getElementById('bundleSum');
    const selectRecommendedBtn = document.getElementById('selectRecommended');
    const addBundleBtn = document.getElementById('addBundleToCart');
    const clearAddonsBtn = document.getElementById('clearAddons');

    function updateBundleSum() {
        let total = 0;
        addonBoxes.forEach(box => {
            if (box.checked) {
                const addonEl = box.closest('.addon');
                const price = parseInt(box.dataset.addonPrice || 0);
                const mq = addonEl.querySelector('.mini-qty');
                const qty = mq ? (parseInt(mq.querySelector('.aqInput').value) || 1) : 1;
                total += price * qty;
            }
        });
        if (bundleSumEl) {
            bundleSumEl.textContent = total.toLocaleString('uk-UA') + ' грн';
        }
    }

    // Enable/disable mini-qty based on checkbox
    addonBoxes.forEach(box => {
        box.addEventListener('change', () => {
            const addonEl = box.closest('.addon');
            const mq = addonEl.querySelector('.mini-qty');
            if (mq) {
                mq.setAttribute('aria-disabled', box.checked ? 'false' : 'true');
            }
            updateBundleSum();
        });
    });

    // Mini-qty controls
    document.querySelectorAll('.aqMinus').forEach(btn => {
        btn.addEventListener('click', () => {
            const input = btn.parentElement.querySelector('.aqInput');
            const val = parseInt(input.value) || 1;
            if (val > 1) {
                input.value = val - 1;
                updateBundleSum();
            }
        });
    });

    document.querySelectorAll('.aqPlus').forEach(btn => {
        btn.addEventListener('click', () => {
            const input = btn.parentElement.querySelector('.aqInput');
            const val = parseInt(input.value) || 1;
            if (val < 99) {
                input.value = val + 1;
                updateBundleSum();
            }
        });
    });

    selectRecommendedBtn?.addEventListener('click', () => {
        const allChecked = Array.from(addonBoxes).every(box => box.checked);
        addonBoxes.forEach(box => {
            box.checked = !allChecked;
            const addonEl = box.closest('.addon');
            const mq = addonEl.querySelector('.mini-qty');
            if (mq) {
                mq.setAttribute('aria-disabled', box.checked ? 'false' : 'true');
            }
        });
        updateBundleSum();
    });

    clearAddonsBtn?.addEventListener('click', () => {
        addonBoxes.forEach(box => {
            box.checked = false;
            const addonEl = box.closest('.addon');
            const mq = addonEl.querySelector('.mini-qty');
            if (mq) {
                mq.setAttribute('aria-disabled', 'true');
                mq.querySelector('.aqInput').value = 1;
            }
        });
        updateBundleSum();
    });

    addBundleBtn?.addEventListener('click', () => {
        const selectedIds = Array.from(addonBoxes)
            .filter(box => box.checked)
            .map(box => box.dataset.addonId);

        if (selectedIds.length === 0) {
            alert('Оберіть хоча б один товар для додавання в кошик');
            return;
        }

        alert(`Додано ${selectedIds.length} додаткових товарів до кошика`);
        // TODO: Implement actual cart addition
    });

    // Tuning kits functionality
    const addKitBtns = document.querySelectorAll('[data-add-kit]');
    const kitRadios = Array.from(document.querySelectorAll('input[name="tuningKit"]'));

    addKitBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const kitIndex = btn.dataset.addKit;
            const selectedKit = kitRadios.find(r => r.value === kitIndex);
            const kitPriceEl = btn.closest('.kit').querySelector('[data-kit-price]');
            const kitPrice = kitPriceEl?.dataset.kitPrice || 0;

            alert(`Пакет тюнінгу додано: ${kitPrice} грн`);
            // TODO: Implement actual kit addition to cart
        });
    });
</script>
@endpush
@endsection
