@extends('layouts.app')

@section('title', $seo?->meta_title ?: 'Strikeball Shop — Інтернет-магазин страйкбольного обладнання')
@section('description', $seo?->meta_description ?: 'Купити страйкбольне обладнання в Україні: приводи AEG, магазини, кулі, захист, тактичне спорядження. Великий вибір, вигідні ціни, доставка по Україні.')
@section('keywords', $seo?->meta_keywords ?: 'страйкбол, airsoft, привод AEG, магазини страйкбол, кулі airsoft, захист, тактичне спорядження, інтернет-магазин')
@section('canonical', route('home'))

@if($seo?->og_title)
@section('og_title', $seo->og_title)
@endif

@if($seo?->og_description)
@section('og_description', $seo->og_description)
@endif

@if($seo?->og_image)
@section('og_image', asset($seo->og_image))
@endif

@push('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Strikeball Shop",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('images/logo.png') }}",
  "description": "Інтернет-магазин страйкбольного обладнання",
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "UA"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "Customer Service"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Strikeball Shop",
  "url": "{{ url('/') }}",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{{ url('/') }}?search={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
@endpush

@section('content')
@push('styles')
<style>
    .hero{
        padding:32px 24px; border-radius:var(--radius2); border:1px solid rgba(255,255,255,.12); margin:24px 0;
        background:radial-gradient(900px 300px at 50% 0%, rgba(88,255,122,.22), transparent 60%),
                 radial-gradient(700px 280px at 20% 20%, rgba(56,189,248,.16), transparent 55%),
                 radial-gradient(600px 260px at 80% 10%, rgba(168,85,247,.14), transparent 50%),
                 linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.04));
        box-shadow:var(--shadow); text-align:center;
    }
    .hero h1{margin:0 0 14px; font-size:var(--h1); line-height:1.08}
    .hero p{margin:0 auto 24px; color:var(--muted); font-size:var(--p); max-width:68ch}
    .hero .actions{display:flex; gap:12px; justify-content:center; flex-wrap:wrap}

    .section{margin:48px 0}
    .section-head{display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:12px}
    .section-head h2{margin:0; font-size:var(--h2)}

    .products{display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:16px}
    .product{
        border-radius:var(--radius); border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.05);
        overflow:hidden; display:flex; flex-direction:column; box-shadow:0 10px 30px rgba(0,0,0,.30);
        transition: transform .12s ease, border-color .12s ease, background .12s ease;
    }
    .product:hover{transform:translateY(-2px); border-color:rgba(255,255,255,.22); background:rgba(255,255,255,.06)}
    .p-top{padding:12px; position:relative}
    .p-badge{
        position:absolute; top:12px; left:12px; display:inline-flex; align-items:center; gap:6px;
        padding:6px 10px; border-radius:999px; font-size:12px; font-weight:900;
        border:1px solid rgba(255,255,255,.16); background:rgba(0,0,0,.45); backdrop-filter:blur(10px);
    }
    .p-badge.hot{border-color:rgba(255,204,0,.30); color:rgba(255,204,0,.95)}
    .p-badge.sale{border-color:rgba(88,255,122,.25); color:rgba(88,255,122,.95)}
    .p-badge.new{border-color:rgba(56,189,248,.30); color:rgba(56,189,248,.95)}
    .p-img{
        height:170px; border-radius:14px; border:1px solid rgba(255,255,255,.10);
        background: radial-gradient(120px 120px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
                    linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
        display:grid; place-items:center; font-size:56px;
    }
    .p-mid{padding:0 14px 14px}
    .p-title{margin:12px 0 8px; font-size:15px; font-weight:780; line-height:1.3}
    .p-meta{display:flex; gap:10px; flex-wrap:wrap; color:var(--muted); font-size:12.5px; margin-bottom:4px}
    .p-bottom{
        margin-top:auto; padding:12px 14px; border-top:1px solid rgba(255,255,255,.10);
        display:flex; align-items:center; justify-content:space-between; gap:10px
    }
    .price{font-weight:950; font-size:18px}

    .categories{display:grid; grid-template-columns:repeat(auto-fill, minmax(240px, 1fr)); gap:16px}
    .cat-card{
        padding:24px 20px; border-radius:var(--radius); border:1px solid rgba(255,255,255,.12);
        background:rgba(255,255,255,.05); text-align:center; transition:all .12s ease;
        box-shadow:0 10px 30px rgba(0,0,0,.30);
    }
    .cat-card:hover{transform:translateY(-2px); border-color:rgba(255,255,255,.22); background:rgba(255,255,255,.07)}
    .cat-card h3{margin:0; font-size:18px}

    @media (max-width: 768px){
        .products{grid-template-columns:repeat(auto-fill, minmax(240px, 1fr))}
        .categories{grid-template-columns:repeat(auto-fill, minmax(180px, 1fr))}
    }
    @media (max-width: 560px){
        .products{grid-template-columns:1fr}
        .categories{grid-template-columns:1fr}
        .hero{padding:24px 18px}
    }
</style>
@endpush

<!-- Hero Section -->
<div class="hero">
    <span class="pill" style="margin-bottom:16px;">🎯 Професійне обладнання для страйкболу</span>
    <h1>Вітаємо в Strikeball Shop</h1>
    <p>Великий вибір страйкбольного обладнання: приводи, магазини, кулі, захист, тактичне спорядження. Доставка по Україні, гарантія якості, професійна консультація.</p>
    <div class="actions">
        <a href="#featured" class="btn primary" style="text-decoration:none;">Хіти продажів</a>
        <a href="#categories" class="btn" style="text-decoration:none;">Всі категорії</a>
    </div>
</div>

<!-- Featured Products -->
@if($featuredProducts->count() > 0)
<div class="section" id="featured">
    <div class="section-head">
        <h2>🔥 Хіти продажів</h2>
        <span class="pill">{{ $featuredProducts->count() }} товарів</span>
    </div>

    <div class="products">
        @foreach($featuredProducts as $product)
        <article class="product">
            <div class="p-top">
                @if($loop->index === 0)
                    <span class="p-badge hot">★ Хіт</span>
                @elseif($loop->index === 1)
                    <span class="p-badge sale">-15%</span>
                @elseif($loop->index === 2)
                    <span class="p-badge new">✦ Новинка</span>
                @endif
                <a class="p-img" href="{{ route('product.show', $product->slug) }}" aria-label="Відкрити товар">
                    @if($product->primaryImage)
                        <span>📦</span>
                    @else
                        <span>📦</span>
                    @endif
                </a>
            </div>
            <div class="p-mid">
                <a class="p-title" href="{{ route('product.show', $product->slug)}}">{{ $product->name }}</a>
                <div class="p-meta">
                    <span class="star">★★★★★</span>
                    <span>{{ $product->category->name }}</span>
                </div>
            </div>
            <div class="p-bottom">
                <div class="price">{{ number_format($product->price, 0) }} грн</div>
                <form method="POST" action="{{ route('cart.add') }}" style="margin:0;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn small primary">В кошик</button>
                </form>
            </div>
        </article>
        @endforeach
    </div>
</div>
@endif

<!-- Categories -->
@if($categories->count() > 0)
<div class="section" id="categories">
    <div class="section-head">
        <h2>📂 Категорії товарів</h2>
        <span class="pill">{{ $categories->count() }} категорій</span>
    </div>

    <div class="categories">
        @foreach($categories as $category)
        <a href="{{ route('category.show', $category->slug) }}" class="cat-card">
            <h3>{{ $category->name }}</h3>
        </a>
        @endforeach
    </div>
</div>
@endif

<!-- Info Blocks -->
<div class="section">
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:16px;">
        <div class="card" style="padding:20px; text-align:center;">
            <div style="font-size:32px; margin-bottom:8px;">🚚</div>
            <h3 style="margin:0 0 8px; font-size:16px;">Доставка по Україні</h3>
            <p style="margin:0; color:var(--muted); font-size:13px;">Нова Пошта, Укрпошта</p>
        </div>
        <div class="card" style="padding:20px; text-align:center;">
            <div style="font-size:32px; margin-bottom:8px;">🛡️</div>
            <h3 style="margin:0 0 8px; font-size:16px;">Гарантія якості</h3>
            <p style="margin:0; color:var(--muted); font-size:13px;">Офіційні постачальники</p>
        </div>
        <div class="card" style="padding:20px; text-align:center;">
            <div style="font-size:32px; margin-bottom:8px;">💬</div>
            <h3 style="margin:0 0 8px; font-size:16px;">Консультація</h3>
            <p style="margin:0; color:var(--muted); font-size:13px;">Допоможемо з підбором</p>
        </div>
        <div class="card" style="padding:20px; text-align:center;">
            <div style="font-size:32px; margin-bottom:8px;">💳</div>
            <h3 style="margin:0 0 8px; font-size:16px;">Зручна оплата</h3>
            <p style="margin:0; color:var(--muted); font-size:13px;">Готівка, картка, розстрочка</p>
        </div>
    </div>
</div>
@endsection
