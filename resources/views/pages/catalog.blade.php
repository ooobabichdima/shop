@extends('layouts.app')

@section('title', $category->meta_title ?: ($category->name . ' - Каталог | Strikeball Shop'))
@section('description', $category->meta_description ?: ($category->description ?: 'Каталог ' . $category->name . ' - купити страйкбольне обладнання в інтернет-магазині Strikeball Shop. Широкий вибір, доставка по Україні.'))
@section('keywords', $category->meta_keywords ?: ($category->name . ', страйкбол, airsoft, купити ' . $category->name . ', інтернет-магазин'))
@section('canonical', route('category.show', $category->slug))

@section('og_title', $category->meta_title ?: ($category->name . ' - Каталог'))
@section('og_description', $category->meta_description ?: ($category->description ?: 'Каталог ' . $category->name))

@push('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "{{ $category->name }}",
  "description": "{{ $category->description ?? '' }}",
  "url": "{{ route('category.show', $category->slug) }}"
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
    "name": "Каталог",
    "item": "{{ route('catalog') }}"
  },{
    "@type": "ListItem",
    "position": 3,
    "name": "{{ $category->name }}"
  }]
}
</script>
@endpush

@section('content')
@push('styles')
<style>
    /* ═══ CATEGORY HEADER ═══ */
    .cat-header{
        position:relative;padding:32px;margin:16px 0 24px;border-radius:var(--radius-lg);
        border:1px solid var(--border);overflow:hidden;
    }
    .cat-header-bg{
        position:absolute;inset:0;
        background:
            radial-gradient(ellipse 500px 300px at 0% 0%,rgba(245,158,11,.06),transparent),
            var(--surface);
    }
    .cat-header-content{position:relative;z-index:1}
    .cat-header h1{font-size:clamp(24px,3vw,36px);font-weight:800;letter-spacing:-.02em;margin:8px 0 4px}
    .cat-header p{color:var(--text2);font-size:15px;max-width:600px;margin-top:8px}

    /* Subcategories */
    .subcats{display:flex;flex-wrap:wrap;gap:8px;margin-top:20px;padding-top:20px;border-top:1px solid var(--border)}
    .subcat-link{
        padding:7px 16px;border-radius:8px;font-size:13px;font-weight:600;
        background:var(--surface2);border:1px solid var(--border);color:var(--text2);
        transition:var(--transition);
    }
    .subcat-link:hover{color:var(--accent);border-color:rgba(245,158,11,.3);background:var(--accent-glow)}

    /* Sort & count bar */
    .cat-toolbar{
        display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;
        margin-top:20px;padding-top:16px;border-top:1px solid var(--border);
    }
    .cat-count{font-size:14px;color:var(--text3);font-weight:500}
    .cat-count b{color:var(--text);font-weight:700}
    .sort-select{
        padding:9px 14px;border-radius:8px;border:1px solid var(--border);
        background:var(--surface2);color:var(--text);font-size:13px;font-weight:500;
        cursor:pointer;transition:var(--transition);outline:none;
    }
    .sort-select:hover{border-color:var(--border2)}

    /* ═══ LAYOUT ═══ */
    .catalog-layout{display:grid;grid-template-columns:280px 1fr;gap:24px;padding:0 0 32px}

    /* ═══ FILTERS ═══ */
    .filter-panel{
        border-radius:var(--radius-lg);border:1px solid var(--border);
        background:var(--surface);padding:20px;height:fit-content;position:sticky;top:80px;
    }
    .filter-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
    .filter-head h3{font-size:15px;font-weight:700}
    .filter-section{padding:16px 0;border-top:1px solid var(--border)}
    .filter-section:first-of-type{border-top:none;padding-top:0}
    .filter-section-title{font-size:13px;font-weight:700;margin-bottom:10px;color:var(--text)}
    .filter-label{
        display:flex;gap:10px;align-items:center;padding:7px 8px;margin:0 -8px;
        border-radius:6px;font-size:14px;color:var(--text2);cursor:pointer;
        transition:var(--transition);
    }
    .filter-label:hover{background:var(--surface2);color:var(--text)}
    .filter-label input[type="checkbox"]{
        width:16px;height:16px;accent-color:var(--accent);cursor:pointer;flex-shrink:0;
    }
    .filter-input{
        width:100%;padding:9px 12px;border-radius:8px;border:1px solid var(--border);
        background:var(--surface2);color:var(--text);font-size:13px;outline:none;
        transition:var(--transition);
    }
    .filter-input:focus{border-color:var(--accent);box-shadow:0 0 0 3px var(--accent-glow)}
    .filter-range{display:grid;grid-template-columns:1fr 1fr;gap:8px}
    .filter-hint{font-size:12px;color:var(--text3);margin-top:4px}

    /* Active filter chips */
    .filter-chips{display:flex;flex-wrap:wrap;gap:6px;margin-top:12px}
    .filter-chip{
        display:inline-flex;align-items:center;gap:4px;
        padding:4px 10px;border-radius:6px;font-size:12px;font-weight:600;
        background:var(--accent-glow);border:1px solid rgba(245,158,11,.25);color:var(--accent2);
    }

    /* ═══ PRODUCT GRID ═══ */
    .products{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
    .product{
        border-radius:var(--radius-lg);border:1px solid var(--border);background:var(--surface);
        overflow:hidden;display:flex;flex-direction:column;transition:var(--transition);
    }
    .product:hover{border-color:var(--border2);transform:translateY(-3px);box-shadow:var(--shadow-lg)}
    .product-img{
        height:180px;position:relative;
        background:linear-gradient(135deg,var(--surface2),var(--surface3));
        display:grid;place-items:center;font-size:48px;
    }
    .product-badge{
        position:absolute;top:10px;left:10px;
        padding:4px 10px;border-radius:6px;font-size:11px;font-weight:700;
        letter-spacing:.04em;text-transform:uppercase;
    }
    .product-badge.sale{background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.25);color:var(--success)}
    .product-badge.hot{background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.3);color:var(--accent2)}
    .product-badge.new{background:rgba(59,130,246,.1);border:1px solid rgba(59,130,246,.25);color:var(--info)}
    .product-stock{
        position:absolute;top:10px;right:10px;
        padding:3px 8px;border-radius:6px;font-size:10px;font-weight:700;letter-spacing:.03em;
    }
    .product-stock.in-stock{background:rgba(34,197,94,.15);border:1px solid rgba(34,197,94,.3);color:var(--success)}
    .product-stock.on-order{background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.3);color:var(--accent2)}
    .product-body{padding:14px 16px;flex:1;display:flex;flex-direction:column}
    .product-name{
        font-size:14px;font-weight:600;line-height:1.4;margin-bottom:6px;
        display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
    }
    .product-meta{display:flex;gap:8px;flex-wrap:wrap;color:var(--text3);font-size:12px;font-weight:500}
    .product-footer{
        margin-top:auto;padding:12px 16px;border-top:1px solid var(--border);
        display:flex;align-items:center;justify-content:space-between;gap:8px;
    }
    .product-price{font-size:17px;font-weight:800;letter-spacing:-.01em}

    /* ═══ EMPTY STATE ═══ */
    .empty-state{
        padding:60px 20px;text-align:center;border-radius:var(--radius-lg);
        border:1px solid var(--border);background:var(--surface);
    }
    .empty-state-icon{font-size:48px;opacity:.5;margin-bottom:16px}
    .empty-state h3{font-size:18px;font-weight:700;margin-bottom:6px}
    .empty-state p{color:var(--text3);font-size:14px;margin-bottom:24px}

    @media(max-width:1040px){
        .catalog-layout{grid-template-columns:1fr}
        .filter-panel{position:static}
        .products{grid-template-columns:repeat(2,1fr)}
    }
    @media(max-width:560px){
        .products{grid-template-columns:1fr}
    }
</style>
@endpush

<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a>
    <span class="crumbs-sep">/</span>
    <a href="{{ route('catalog') }}">Каталог</a>
    <span class="crumbs-sep">/</span>
    <span>{{ $category->name }}</span>
</div>

{{-- Category Header --}}
<div class="cat-header">
    <div class="cat-header-bg"></div>
    <div class="cat-header-content">
        <span class="tag tag-accent">Категорія</span>
        <h1>{{ $category->name }}</h1>
        @if($category->description)
            <p>{{ $category->description }}</p>
        @endif

        @if($category->children && $category->children->count() > 0)
            <div class="subcats">
                @foreach($category->children as $child)
                    <a href="{{ route('category.show', $child->slug) }}" class="subcat-link">{{ $child->name }}</a>
                @endforeach
            </div>
        @endif

        <div class="cat-toolbar">
            <div class="cat-count">Знайдено: <b>{{ $totalProducts }}</b> товарів</div>
            <select class="sort-select" id="sortSelect" aria-label="Сортування">
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Популярні</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Дешевші</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Дорожчі</option>
                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Рейтинг</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Новинки</option>
            </select>
        </div>
    </div>
</div>

<div class="catalog-layout">
    {{-- FILTERS --}}
    <aside class="filter-panel" aria-label="Фільтри">
        <form method="GET" action="{{ route('category.show', $category->slug) }}" id="filterForm">
            <div class="filter-head">
                <h3>Фільтри</h3>
                <a href="{{ route('category.show', $category->slug) }}" class="btn btn-sm btn-ghost">Скинути</a>
            </div>

            <div class="filter-section">
                <div class="filter-section-title">Ціна, грн</div>
                <div class="filter-range">
                    <input class="filter-input" type="number" name="price_from" placeholder="від" value="{{ request('price_from') }}" />
                    <input class="filter-input" type="number" name="price_to" placeholder="до" value="{{ request('price_to') }}" />
                </div>
            </div>

            @if($brands->count() > 0)
            <div class="filter-section">
                <div class="filter-section-title">Бренд</div>
                @foreach($brands as $brand)
                    <label class="filter-label">
                        <input type="checkbox" name="brand[]" value="{{ $brand->id }}"
                            {{ in_array($brand->id, (array)request('brand', [])) ? 'checked' : '' }} />
                        {{ $brand->name }}
                    </label>
                @endforeach
            </div>
            @endif

            @foreach($attributes as $attribute)
            <div class="filter-section">
                <div class="filter-section-title">{{ $attribute->name }}</div>
                @if($attribute->type === 'select' && $attribute->options)
                    @foreach($attribute->options as $option)
                        <label class="filter-label">
                            <input type="checkbox" name="attr[{{ $attribute->id }}][]" value="{{ $option }}"
                                {{ in_array($option, (array)request("attr.{$attribute->id}", [])) ? 'checked' : '' }} />
                            {{ $option }}
                        </label>
                    @endforeach
                @elseif($attribute->type === 'range')
                    <div class="filter-range">
                        <input class="filter-input" type="number" name="attr[{{ $attribute->id }}][min]"
                               placeholder="від" value="{{ request("attr.{$attribute->id}.min") }}" />
                        <input class="filter-input" type="number" name="attr[{{ $attribute->id }}][max]"
                               placeholder="до" value="{{ request("attr.{$attribute->id}.max") }}" />
                    </div>
                @endif
            </div>
            @endforeach

            <div class="filter-section">
                <div class="filter-section-title">Наявність</div>
                <label class="filter-label">
                    <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }} />
                    В наявності
                </label>
                <label class="filter-label">
                    <input type="checkbox" name="on_order" value="1" {{ request('on_order') ? 'checked' : '' }} />
                    Під замовлення
                </label>
            </div>

            @if(request()->hasAny(['price_from', 'price_to', 'brand', 'in_stock', 'on_order']))
            <div class="filter-section">
                <div class="filter-section-title">Активні фільтри</div>
                <div class="filter-chips">
                    @if(request('in_stock'))
                        <span class="filter-chip">В наявності</span>
                    @endif
                    @if(request('on_order'))
                        <span class="filter-chip">Під замовлення</span>
                    @endif
                    @if(request('price_from') || request('price_to'))
                        <span class="filter-chip">
                            @if(request('price_from')){{ request('price_from') }}@else 0 @endif
                            -
                            @if(request('price_to')){{ request('price_to') }}@else ... @endif грн
                        </span>
                    @endif
                    @if(request('brand'))
                        @foreach($brands->whereIn('id', request('brand', [])) as $brand)
                            <span class="filter-chip">{{ $brand->name }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
            @endif

            <div class="filter-section" style="border-top:none;padding-top:4px;">
                <button class="btn btn-primary" type="submit" style="width:100%;">Застосувати</button>
            </div>
        </form>
    </aside>

    {{-- PRODUCTS --}}
    <section aria-label="Список товарів">
        @if($products->count() > 0)
            <div class="products">
                @foreach($products as $product)
                <article class="product">
                    <a class="product-img" href="{{ route('product.show', $product->slug) }}">
                        @if($product->discount_percent > 0)
                            <span class="product-badge sale">-{{ $product->discount_percent }}%</span>
                        @elseif($product->is_new)
                            <span class="product-badge new">Новинка</span>
                        @elseif($product->is_featured)
                            <span class="product-badge hot">Хіт</span>
                        @endif
                        @php $sb = $product->stock_status_badge; @endphp
                        <span class="product-stock {{ $sb['class'] }}">{{ $sb['text'] }}</span>
                        <span>📦</span>
                    </a>
                    <div class="product-body">
                        <a class="product-name" href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                        <div class="product-meta">
                            @if($product->rating)
                                <span class="star">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= $product->rating ? '★' : '☆' }}
                                    @endfor
                                </span>
                            @endif
                            <span>{{ $product->brand ? $product->brand->name : $product->sku }}</span>
                        </div>
                    </div>
                    <div class="product-footer">
                        <div class="product-price">
                            {{ number_format($product->price, 0, '.', ' ') }}
                            <small style="font-weight:500;font-size:13px;color:var(--text3)">грн</small>
                            @if($product->old_price && $product->old_price > $product->price)
                                <span class="strike">{{ number_format($product->old_price, 0) }}</span>
                            @endif
                        </div>
                        <div style="display:flex;gap:6px;align-items:center;">
                            @php $inW = in_array($product->id, session('wishlist', [])); @endphp
                            <button type="button" class="btn btn-sm {{ $inW ? 'wishlisted' : '' }}"
                                onclick="toggleWishlist(this, {{ $product->id }})"
                                title="{{ $inW ? 'Видалити' : 'В обране' }}"
                                style="padding:6px 8px;min-width:0;">{{ $inW ? '❤️' : '🤍' }}</button>
                            <button type="button" class="btn btn-sm"
                                onclick="openQuickOrder({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                style="padding:6px 8px;min-width:0;" title="Купити в 1 клік">⚡</button>
                            <form method="POST" action="{{ route('cart.add') }}" style="margin:0;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary btn-sm">В кошик</button>
                            </form>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="pagination">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">🔍</div>
                <h3>Товарів не знайдено</h3>
                <p>Спробуйте змінити параметри фільтрації</p>
                <a href="{{ route('category.show', $category->slug) }}" class="btn">Скинути фільтри</a>
            </div>
        @endif
    </section>
</div>

@push('scripts')
<script>
    document.getElementById('sortSelect')?.addEventListener('change', function() {
        const form = document.getElementById('filterForm');
        const sortInput = document.createElement('input');
        sortInput.type = 'hidden';
        sortInput.name = 'sort';
        sortInput.value = this.value;
        form.appendChild(sortInput);
        form.submit();
    });
</script>
@endpush
@endsection
