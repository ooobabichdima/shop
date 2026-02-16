@extends('layouts.app')

@section('title', $category->name . ' - Strikeball Shop')

@section('content')
@push('styles')
<style>
    .cat-head{
        padding:16px; border-radius:var(--radius2); border:1px solid rgba(255,255,255,.12); margin:16px 0;
        background:radial-gradient(700px 240px at 20% 0%, rgba(88,255,122,.18), transparent 60%),
                 radial-gradient(520px 220px at 86% 10%, rgba(56,189,248,.14), transparent 55%),
                 linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));
        box-shadow:var(--shadow);
    }
    .cat-head h1{margin:6px 0 6px; font-size:var(--h1); line-height:1.08}
    .cat-head p{margin:0; color:var(--muted); font-size:var(--p); max-width:72ch}
    .cat-head .bar{margin-top:12px; display:flex; gap:10px; flex-wrap:wrap; align-items:center; justify-content:space-between}
    .count{color:rgba(255,255,255,.70); font-size:13px}
    .select{
        padding:10px 12px; border-radius:14px; border:1px solid rgba(255,255,255,.14);
        background:rgba(0,0,0,.18); color:var(--text); outline:none; font-size:14px;
    }

    .layout{display:grid; grid-template-columns: 320px 1fr; gap:16px; padding:16px 0 28px}
    .filters{padding:14px}
    .filters h3{margin:0 0 12px; font-size:16px}
    .filters .sec{padding:12px 0; border-top:1px solid rgba(255,255,255,.10)}
    .filters .sec:first-of-type{border-top:none; padding-top:0}
    .filters label{display:flex; gap:10px; align-items:center; color:rgba(255,255,255,.80); font-size:14px; padding:6px 0; cursor:pointer}
    .filters input[type="checkbox"]{width:16px; height:16px; accent-color: var(--accent)}
    .filters .hint{color:var(--muted); font-size:12.5px; margin-top:6px}
    .range{display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-top:8px}
    .in{
        width:100%; padding:10px 12px; border-radius:14px; border:1px solid rgba(255,255,255,.14);
        background:rgba(0,0,0,.18); color:var(--text); outline:none; font-size:14px;
    }
    .chips{display:flex; flex-wrap:wrap; gap:8px; margin-top:8px}
    .chip{
        padding:8px 10px; border-radius:999px; border:1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05); color:var(--muted); font-size:13px;
    }
    .chip b{color:rgba(255,255,255,.86)}
    .chip button{
        margin-left:6px; border:none; background:transparent; color:rgba(255,255,255,.65); cursor:pointer;
    }
    .chip button:hover{color:var(--text)}
    .toolbar{display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; margin-bottom:10px}

    .products{display:grid; grid-template-columns: repeat(3, 1fr); gap:16px}
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
        border:1px solid rgba(255,255,255,.16); background:rgba(0,0,0,.35); backdrop-filter:blur(10px);
    }
    .p-badge.sale{border-color:rgba(88,255,122,.25); color:rgba(88,255,122,.95)}
    .p-badge.hot{border-color:rgba(255,204,0,.20); color:rgba(255,204,0,.95)}
    .p-badge.new{border-color:rgba(56,189,248,.30); color:rgba(56,189,248,.95)}
    .p-img{
        height:170px; border-radius:14px; border:1px solid rgba(255,255,255,.10);
        background: radial-gradient(120px 120px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
                    linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
        display:grid; place-items:center; font-size:56px;
    }
    .p-mid{padding:0 12px 12px}
    .p-title{margin:10px 0 6px; font-size:15px; font-weight:780}
    .p-meta{display:flex; gap:10px; flex-wrap:wrap; color:var(--muted); font-size:12.5px}
    .p-bottom{
        margin-top:auto; padding:12px; border-top:1px solid rgba(255,255,255,.10);
        display:flex; align-items:center; justify-content:space-between; gap:10px
    }
    .price{font-weight:950}
    .strike{color:rgba(255,255,255,.45); text-decoration:line-through; font-weight:700; margin-left:8px}
    .star{color:rgba(255,204,0,.9)}
    .pagination{display:flex; gap:8px; justify-content:center; margin-top:14px; flex-wrap:wrap}

    @media (max-width: 1040px){
        .layout{grid-template-columns: 1fr}
        .products{grid-template-columns: repeat(2, 1fr)}
    }
    @media (max-width: 560px){
        .products{grid-template-columns: 1fr}
    }
</style>
@endpush

<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a> / <a href="#">Каталог</a> / <span>{{ $category->name }}</span>
</div>

<div class="cat-head">
    <span class="pill">Категорія</span>
    <h1>{{ $category->name }}</h1>
    @if($category->description)
        <p>{{ $category->description }}</p>
    @endif

    <div class="bar">
        <div class="count">Знайдено: <b>{{ $totalProducts }}</b> товарів</div>
        <div class="row" style="flex-wrap:wrap; justify-content:flex-end;">
            <select class="select" id="sortSelect" aria-label="Сортування">
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Сортування: популярні</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Спочатку дешевші</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Спочатку дорожчі</option>
                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>По рейтингу</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Новинки</option>
            </select>
        </div>
    </div>
</div>

<div class="layout">
    <!-- FILTERS -->
    <aside class="card filters" aria-label="Фільтри">
        <form method="GET" action="{{ route('category.show', $category->slug) }}" id="filterForm">
            <div class="row" style="justify-content:space-between; align-items:flex-start;">
                <div>
                    <h3>Фільтри</h3>
                    <div class="hint">Оберіть параметри для фільтрації</div>
                </div>
                <a href="{{ route('category.show', $category->slug) }}" class="btn small">Скинути</a>
            </div>

            <div class="sec">
                <b style="display:block; margin-bottom:6px;">Ціна, грн</b>
                <div class="range">
                    <input class="in" type="number" name="price_from" placeholder="від" value="{{ request('price_from') }}" />
                    <input class="in" type="number" name="price_to" placeholder="до" value="{{ request('price_to') }}" />
                </div>
            </div>

            @if($brands->count() > 0)
            <div class="sec">
                <b style="display:block; margin-bottom:6px;">Бренд</b>
                @foreach($brands as $brand)
                    <label>
                        <input type="checkbox" name="brand[]" value="{{ $brand->id }}"
                            {{ in_array($brand->id, (array)request('brand', [])) ? 'checked' : '' }} />
                        {{ $brand->name }}
                    </label>
                @endforeach
            </div>
            @endif

            <div class="sec">
                <b style="display:block; margin-bottom:6px;">Наявність</b>
                <label>
                    <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }} />
                    Тільки в наявності
                </label>
            </div>

            <!-- Active Filters -->
            @if(request()->hasAny(['price_from', 'price_to', 'brand', 'in_stock']))
            <div class="sec">
                <b style="display:block; margin-bottom:6px;">Активні фільтри</b>
                <div class="chips">
                    @if(request('in_stock'))
                        <span class="chip"><b>В наявності</b></span>
                    @endif
                    @if(request('price_from') || request('price_to'))
                        <span class="chip">
                            <b>Ціна:
                                @if(request('price_from')){{ request('price_from') }}@else 0 @endif
                                -
                                @if(request('price_to')){{ request('price_to') }}@else ∞ @endif
                            </b>
                        </span>
                    @endif
                    @if(request('brand'))
                        @foreach($brands->whereIn('id', request('brand', [])) as $brand)
                            <span class="chip"><b>{{ $brand->name }}</b></span>
                        @endforeach
                    @endif
                </div>
            </div>
            @endif

            <div class="sec">
                <button class="btn primary" type="submit" style="width:100%;">Застосувати фільтри</button>
            </div>
        </form>
    </aside>

    <!-- LISTING -->
    <section aria-label="Список товарів">
        @if($products->count() > 0)
            <div class="products">
                @foreach($products as $product)
                <article class="product">
                    <div class="p-top">
                        @if($product->discount_percent > 0)
                            <span class="p-badge sale">-{{ $product->discount_percent }}%</span>
                        @elseif($product->is_new)
                            <span class="p-badge new">✦ Новинка</span>
                        @elseif($product->is_featured)
                            <span class="p-badge hot">★ Хіт</span>
                        @endif
                        <a class="p-img" href="{{ route('product.show', $product->slug) }}" aria-label="Відкрити товар">
                            <span>📦</span>
                        </a>
                    </div>
                    <div class="p-mid">
                        <a class="p-title" href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                        <div class="p-meta">
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
                    <div class="p-bottom">
                        <div class="price">
                            {{ number_format($product->price, 0) }} грн
                            @if($product->old_price && $product->old_price > $product->price)
                                <span class="strike">{{ number_format($product->old_price, 0) }}</span>
                            @endif
                        </div>
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

            <div class="pagination">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <div class="card" style="text-align:center;padding:40px 20px;">
                <div style="font-size:48px;margin-bottom:16px;opacity:.5;">🔍</div>
                <h3 style="margin:0 0 8px;">Товарів не знайдено</h3>
                <p style="color:var(--muted);margin:0 0 20px;">Спробуйте змінити параметри фільтрації</p>
                <a href="{{ route('category.show', $category->slug) }}" class="btn">Скинути фільтри</a>
            </div>
        @endif
    </section>
</div>

@push('scripts')
<script>
    // Auto-submit form on sort change
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
