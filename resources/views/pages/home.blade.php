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
    /* ═══ HERO ═══ */
    .hero{
        position:relative;
        padding:80px 48px;
        margin:24px 0;
        border-radius:var(--radius-lg);
        overflow:hidden;
        border:1px solid var(--border);
    }
    .hero-bg{
        position:absolute;inset:0;
        background:
            radial-gradient(ellipse 600px 400px at 10% 20%, rgba(245,158,11,.12), transparent),
            radial-gradient(ellipse 500px 300px at 90% 80%, rgba(59,130,246,.08), transparent),
            var(--surface);
    }
    .hero-grid{
        position:absolute;inset:0;
        background-image:
            linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
        background-size:60px 60px;
        mask-image:radial-gradient(ellipse at center, black 30%, transparent 70%);
        -webkit-mask-image:radial-gradient(ellipse at center, black 30%, transparent 70%);
    }
    .hero-content{position:relative;z-index:1;max-width:640px}
    .hero-label{
        display:inline-flex;align-items:center;gap:8px;
        padding:6px 16px;border-radius:99px;font-size:13px;font-weight:600;
        background:var(--accent-glow);border:1px solid rgba(245,158,11,.25);color:var(--accent2);
        margin-bottom:24px;
    }
    .hero-label span{
        width:6px;height:6px;border-radius:99px;background:var(--accent);
        animation:pulse 2s infinite;
    }
    @keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}
    .hero h1{
        font-size:clamp(32px,5vw,56px);font-weight:900;line-height:1.05;
        letter-spacing:-.03em;margin-bottom:20px;
    }
    .hero h1 em{
        font-style:normal;
        background:linear-gradient(135deg,var(--accent),var(--accent2));
        -webkit-background-clip:text;-webkit-text-fill-color:transparent;
        background-clip:text;
    }
    .hero p{
        font-size:17px;line-height:1.7;color:var(--text2);margin-bottom:32px;max-width:520px;
    }
    .hero-actions{display:flex;gap:12px;flex-wrap:wrap}
    .hero-stats{
        display:flex;gap:40px;margin-top:48px;padding-top:32px;
        border-top:1px solid var(--border);
    }
    .hero-stat-num{font-size:28px;font-weight:800;color:var(--text);letter-spacing:-.02em}
    .hero-stat-label{font-size:13px;color:var(--text3);margin-top:2px}

    /* ═══ SECTIONS ═══ */
    .section{margin:64px 0}
    .section-header{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px;gap:16px}
    .section-header h2{font-size:clamp(22px,2.5vw,32px);font-weight:800;letter-spacing:-.02em;line-height:1.2}
    .section-header p{color:var(--text3);font-size:14px;margin-top:4px}

    /* ═══ HORIZONTAL CATEGORY SCROLL ═══ */
    .cat-scroll{
        display:flex;gap:12px;overflow-x:auto;padding:4px 0 16px;
        scrollbar-width:thin;scrollbar-color:var(--border) transparent;
        -webkit-overflow-scrolling:touch;
    }
    .cat-scroll::-webkit-scrollbar{height:4px}
    .cat-scroll::-webkit-scrollbar-track{background:transparent}
    .cat-scroll::-webkit-scrollbar-thumb{background:var(--border);border-radius:99px}
    .cat-item{
        flex-shrink:0;padding:20px 28px;border-radius:var(--radius);
        border:1px solid var(--border);background:var(--surface);
        transition:var(--transition);cursor:pointer;text-align:center;min-width:180px;
        position:relative;overflow:hidden;
    }
    .cat-item::before{
        content:'';position:absolute;top:0;left:0;right:0;height:2px;
        background:linear-gradient(90deg,var(--accent),var(--accent2));
        transform:scaleX(0);transform-origin:left;transition:transform .3s ease;
    }
    .cat-item:hover::before{transform:scaleX(1)}
    .cat-item:hover{border-color:var(--border2);background:var(--surface2);transform:translateY(-2px)}
    .cat-item h3{font-size:15px;font-weight:700;margin-bottom:4px}
    .cat-item .cat-count{font-size:12px;color:var(--text3)}

    /* ═══ PRODUCT GRID ═══ */
    .products{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px}
    .product{
        border-radius:var(--radius-lg);border:1px solid var(--border);background:var(--surface);
        overflow:hidden;display:flex;flex-direction:column;
        transition:var(--transition);position:relative;
    }
    .product:hover{border-color:var(--border2);transform:translateY(-4px);box-shadow:var(--shadow-lg)}
    .product-img{
        height:200px;position:relative;
        background:linear-gradient(135deg,var(--surface2),var(--surface3));
        display:grid;place-items:center;font-size:48px;overflow:hidden;
    }
    .product-img::after{
        content:'';position:absolute;inset:0;
        background:linear-gradient(to top,var(--surface),transparent 60%);
        opacity:0;transition:opacity .3s ease;
    }
    .product:hover .product-img::after{opacity:1}
    .product-badge{
        position:absolute;top:12px;left:12px;z-index:2;
        padding:5px 10px;border-radius:6px;font-size:11px;font-weight:700;
        letter-spacing:.04em;text-transform:uppercase;
    }
    .product-badge.hot{background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.3);color:var(--accent2)}
    .product-badge.sale{background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.25);color:var(--success)}
    .product-badge.new{background:rgba(59,130,246,.1);border:1px solid rgba(59,130,246,.25);color:var(--info)}
    .product-body{padding:16px 18px;flex:1;display:flex;flex-direction:column}
    .product-name{
        font-size:15px;font-weight:600;line-height:1.4;margin-bottom:8px;
        display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
    }
    .product-meta{display:flex;gap:8px;flex-wrap:wrap;color:var(--text3);font-size:12px;font-weight:500}
    .product-meta .star{font-size:11px}
    .product-footer{
        margin-top:auto;padding:14px 18px;border-top:1px solid var(--border);
        display:flex;align-items:center;justify-content:space-between;gap:10px;
    }
    .product-price{font-size:18px;font-weight:800;letter-spacing:-.01em}

    /* ═══ FEATURES ═══ */
    .features{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;border-radius:var(--radius-lg);overflow:hidden;border:1px solid var(--border)}
    .feature{
        padding:28px 24px;background:var(--surface);text-align:center;
        transition:var(--transition);position:relative;
    }
    .feature:hover{background:var(--surface2)}
    .feature-icon{
        width:48px;height:48px;border-radius:12px;display:grid;place-items:center;
        margin:0 auto 14px;font-size:22px;
        background:var(--surface2);border:1px solid var(--border);
    }
    .feature h3{font-size:14px;font-weight:700;margin-bottom:4px}
    .feature p{font-size:12px;color:var(--text3);line-height:1.5}

    /* ═══ PROMO BANNERS ═══ */
    .promo-banners{display:grid;grid-template-columns:1.2fr 1fr;gap:16px}
    .promo-banner{
        position:relative;border-radius:var(--radius-lg);overflow:hidden;
        border:1px solid var(--border);transition:var(--transition);display:flex;
        align-items:center;justify-content:space-between;padding:24px 28px;
    }
    .promo-banner:hover{transform:translateY(-2px);box-shadow:var(--shadow-lg);border-color:var(--border2)}
    .promo-banner-bg{position:absolute;inset:0;z-index:0}
    .promo-banner-content{position:relative;z-index:1;flex:1}
    .promo-banner-tag{
        display:inline-block;padding:4px 10px;border-radius:6px;font-size:10px;
        font-weight:700;text-transform:uppercase;letter-spacing:.06em;
        background:rgba(255,255,255,.1);color:var(--text);margin-bottom:8px;
    }
    .promo-banner-title{font-size:24px;font-weight:800;margin:0 0 6px;letter-spacing:-.02em}
    .promo-banner-text{font-size:14px;color:var(--text2);margin:0 0 12px}
    .promo-banner-cta{
        display:inline-flex;align-items:center;gap:6px;font-size:14px;
        font-weight:700;color:var(--accent);
    }
    .promo-banner-icon{
        position:relative;z-index:1;font-size:48px;opacity:.9;flex-shrink:0;
    }
    .promo-banner-lg{min-height:200px}
    .promo-banner-sm h4{font-size:16px;font-weight:700;margin:0 0 4px}
    .promo-banner-sm p{font-size:12px;color:var(--text3);margin:0}
    .promo-banners-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px}

    /* ═══ CTA BANNER ═══ */
    .cta-banner{
        position:relative;padding:48px;border-radius:var(--radius-lg);overflow:hidden;
        border:1px solid rgba(245,158,11,.2);
    }
    .cta-banner-bg{
        position:absolute;inset:0;
        background:
            radial-gradient(ellipse 500px 300px at 80% 50%, rgba(245,158,11,.08), transparent),
            var(--surface);
    }
    .cta-banner-content{position:relative;z-index:1;display:flex;align-items:center;justify-content:space-between;gap:32px;flex-wrap:wrap}
    .cta-banner h2{font-size:24px;font-weight:800;letter-spacing:-.02em}
    .cta-banner p{color:var(--text2);font-size:15px;margin-top:8px;max-width:480px}

    @media(max-width:768px){
        .hero{padding:40px 24px}
        .hero-stats{flex-wrap:wrap;gap:24px}
        .features{grid-template-columns:repeat(2,1fr)}
        .products{grid-template-columns:repeat(auto-fill,minmax(240px,1fr))}
        .cta-banner{padding:32px 24px}
        .cta-banner-content{flex-direction:column;text-align:center}
    }
    @media(max-width:480px){
        .hero{padding:32px 20px}
        .features{grid-template-columns:1fr}
        .products{grid-template-columns:1fr}
    }
</style>
@endpush

{{-- ═══ HERO ═══ --}}
<div class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grid"></div>
    <div class="hero-content">
        <div class="hero-label">
            <span></span>
            Професійне обладнання для страйкболу
        </div>
        <h1>Екіпіруйся для <em>перемоги</em></h1>
        <p>Приводи, тактичне спорядження, захист та аксесуари від провідних брендів. Доставка по Україні, гарантія, професійна консультація.</p>
        <div class="hero-actions">
            <a href="{{ route('catalog') }}" class="btn btn-primary btn-lg">Переглянути каталог</a>
            <a href="#featured" class="btn btn-lg">Хіти продажів</a>
        </div>
        <div class="hero-stats">
            <div>
                <div class="hero-stat-num">2000+</div>
                <div class="hero-stat-label">Товарів</div>
            </div>
            <div>
                <div class="hero-stat-num">30+</div>
                <div class="hero-stat-label">Брендів</div>
            </div>
            <div>
                <div class="hero-stat-num">5000+</div>
                <div class="hero-stat-label">Клієнтів</div>
            </div>
            <div>
                <div class="hero-stat-num">24h</div>
                <div class="hero-stat-label">Відправка</div>
            </div>
        </div>
    </div>
</div>

{{-- ═══ PROMO BANNERS ═══ --}}
<div class="section" style="margin:40px 0">
    <div class="promo-banners">
        {{-- Large banner --}}
        <a href="{{ route('catalog') }}?sort=newest" class="promo-banner promo-banner-lg">
            <div class="promo-banner-bg" style="background:linear-gradient(135deg,rgba(245,158,11,.15),rgba(217,119,6,.08))"></div>
            <div class="promo-banner-content">
                <span class="promo-banner-tag">Новинки сезону</span>
                <h3 class="promo-banner-title">Нові приводи 2026</h3>
                <p class="promo-banner-text">Ексклюзивні моделі від топових виробників</p>
                <span class="promo-banner-cta">Переглянути →</span>
            </div>
            <div class="promo-banner-icon">🎯</div>
        </a>

        {{-- Small banners grid --}}
        <div class="promo-banners-grid">
            <a href="{{ route('catalog') }}?price_to=2000" class="promo-banner promo-banner-sm">
                <div class="promo-banner-bg" style="background:linear-gradient(135deg,rgba(59,130,246,.12),rgba(37,99,235,.08))"></div>
                <div class="promo-banner-content">
                    <span class="promo-banner-tag">Акція</span>
                    <h4>До 2000 грн</h4>
                    <p>Вигідні пропозиції</p>
                </div>
                <div class="promo-banner-icon" style="font-size:28px">💰</div>
            </a>

            <a href="{{ route('catalog') }}?in_stock=1" class="promo-banner promo-banner-sm">
                <div class="promo-banner-bg" style="background:linear-gradient(135deg,rgba(34,197,94,.12),rgba(21,128,61,.08))"></div>
                <div class="promo-banner-content">
                    <span class="promo-banner-tag">В наявності</span>
                    <h4>Швидка доставка</h4>
                    <p>Відправка сьогодні</p>
                </div>
                <div class="promo-banner-icon" style="font-size:28px">🚚</div>
            </a>

            <a href="{{ route('catalog') }}" class="promo-banner promo-banner-sm">
                <div class="promo-banner-bg" style="background:linear-gradient(135deg,rgba(168,85,247,.12),rgba(126,34,206,.08))"></div>
                <div class="promo-banner-content">
                    <span class="promo-banner-tag">Топ вибір</span>
                    <h4>Хіти продажів</h4>
                    <p>Найпопулярніше</p>
                </div>
                <div class="promo-banner-icon" style="font-size:28px">⭐</div>
            </a>

            <a href="{{ route('contacts') }}" class="promo-banner promo-banner-sm">
                <div class="promo-banner-bg" style="background:linear-gradient(135deg,rgba(251,146,60,.12),rgba(234,88,12,.08))"></div>
                <div class="promo-banner-content">
                    <span class="promo-banner-tag">Допомога</span>
                    <h4>Консультація</h4>
                    <p>Підберемо обладнання</p>
                </div>
                <div class="promo-banner-icon" style="font-size:28px">💬</div>
            </a>
        </div>
    </div>
</div>

{{-- ═══ CATEGORIES ═══ --}}
@if($categories->count() > 0)
<div class="section" id="categories">
    <div class="section-header">
        <div>
            <div class="section-label">Каталог</div>
            <h2>Категорії товарів</h2>
        </div>
        <a href="{{ route('catalog') }}" class="btn btn-sm">Дивитись все &rarr;</a>
    </div>

    <div class="cat-scroll">
        @foreach($categories as $category)
        <a href="{{ route('category.show', $category->slug) }}" class="cat-item">
            <h3>{{ $category->name }}</h3>
            <div class="cat-count">{{ $category->children_count ?? 0 }} підкатегорій</div>
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- ═══ FEATURED PRODUCTS ═══ --}}
@if($featuredProducts->count() > 0)
<div class="section" id="featured">
    <div class="section-header">
        <div>
            <div class="section-label">Популярне</div>
            <h2>Хіти продажів</h2>
        </div>
        <span class="tag tag-accent">{{ $featuredProducts->count() }} товарів</span>
    </div>

    <div class="products">
        @foreach($featuredProducts as $product)
        <article class="product">
            <a class="product-img" href="{{ route('product.show', $product->slug) }}">
                @if($loop->index === 0)
                    <span class="product-badge hot">Хіт</span>
                @elseif($loop->index === 1)
                    <span class="product-badge sale">Знижка</span>
                @elseif($loop->index === 2)
                    <span class="product-badge new">Новинка</span>
                @endif
                <span>📦</span>
            </a>
            <div class="product-body">
                <a class="product-name" href="{{ route('product.show', $product->slug)}}">{{ $product->name }}</a>
                <div class="product-meta">
                    <span class="star">★★★★★</span>
                    <span>{{ $product->category->name }}</span>
                    @if($product->brand)
                        <span>{{ $product->brand->name }}</span>
                    @endif
                </div>
            </div>
            <div class="product-footer">
                <div class="product-price">{{ number_format($product->price, 0, '.', ' ') }} <small style="font-weight:500;font-size:14px;color:var(--text3)">грн</small></div>
                <form method="POST" action="{{ route('cart.add') }}" style="margin:0;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary btn-sm">В кошик</button>
                </form>
            </div>
        </article>
        @endforeach
    </div>
</div>
@endif

{{-- ═══ FEATURES ═══ --}}
<div class="section">
    <div class="features">
        <div class="feature">
            <div class="feature-icon">🚚</div>
            <h3>Швидка доставка</h3>
            <p>Відправка в день замовлення. Нова Пошта по всій Україні</p>
        </div>
        <div class="feature">
            <div class="feature-icon">🛡️</div>
            <h3>Гарантія якості</h3>
            <p>Офіційне дилерство. Оригінальна продукція з гарантією</p>
        </div>
        <div class="feature">
            <div class="feature-icon">💬</div>
            <h3>Консультація</h3>
            <p>Допоможемо підібрати обладнання під ваші потреби</p>
        </div>
        <div class="feature">
            <div class="feature-icon">💳</div>
            <h3>Зручна оплата</h3>
            <p>Готівка, картка, накладений платіж, розстрочка</p>
        </div>
    </div>
</div>

{{-- ═══ CTA ═══ --}}
<div class="section">
    <div class="cta-banner">
        <div class="cta-banner-bg"></div>
        <div class="cta-banner-content">
            <div>
                <h2>Потрібна допомога з вибором?</h2>
                <p>Наші експерти допоможуть підібрати обладнання під ваш стиль гри та бюджет. Безкоштовна консультація!</p>
            </div>
            <a href="{{ route('contacts') }}" class="btn btn-primary btn-lg">Зв'язатися з нами</a>
        </div>
    </div>
</div>

@endsection
