@extends('layouts.app')

@section('title', 'Каталог товарів - Strikeball Shop')
@section('description', 'Повний каталог страйкбольного обладнання: приводи, боєприпаси, апгрейд, оптика, тактичне спорядження. Доставка по Україні.')
@section('keywords', 'каталог страйкбол, airsoft україна, купити страйкбольне обладнання')
@section('canonical', route('catalog'))

@push('styles')
<style>
    .catalog-hero{
        position:relative;padding:64px 40px;margin:16px 0 40px;
        border-radius:var(--radius-lg);overflow:hidden;border:1px solid var(--border);
    }
    .catalog-hero-bg{
        position:absolute;inset:0;
        background:
            radial-gradient(ellipse 600px 400px at 20% 30%,rgba(245,158,11,.08),transparent),
            radial-gradient(ellipse 400px 300px at 80% 70%,rgba(59,130,246,.06),transparent),
            var(--surface);
    }
    .catalog-hero-grid{
        position:absolute;inset:0;
        background-image:
            linear-gradient(rgba(255,255,255,.02) 1px,transparent 1px),
            linear-gradient(90deg,rgba(255,255,255,.02) 1px,transparent 1px);
        background-size:80px 80px;
        mask-image:radial-gradient(ellipse at center,black 20%,transparent 70%);
        -webkit-mask-image:radial-gradient(ellipse at center,black 20%,transparent 70%);
    }
    .catalog-hero-content{
        position:relative;z-index:1;max-width:700px;margin:0 auto;text-align:center;
    }
    .catalog-hero h1{
        font-size:clamp(28px,4vw,48px);font-weight:900;line-height:1.1;
        letter-spacing:-.03em;margin-bottom:16px;
    }
    .catalog-hero p{color:var(--text2);font-size:17px;line-height:1.7;margin-bottom:32px}
    .catalog-stats{
        display:flex;gap:40px;justify-content:center;flex-wrap:wrap;
        padding-top:32px;border-top:1px solid var(--border);
    }
    .stat-num{font-size:32px;font-weight:800;color:var(--accent);letter-spacing:-.02em}
    .stat-label{font-size:12px;color:var(--text3);text-transform:uppercase;letter-spacing:.06em;font-weight:600;margin-top:2px}

    .categories-section{margin-bottom:60px}
    .section-title{
        font-size:clamp(22px,2.5vw,30px);font-weight:800;letter-spacing:-.02em;
        margin:0 0 28px;display:flex;align-items:center;gap:12px;
    }
    .section-title::before{
        content:'';width:3px;height:28px;border-radius:99px;
        background:linear-gradient(180deg,var(--accent),rgba(245,158,11,.2));flex-shrink:0;
    }

    .categories-grid{
        display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:16px;
    }
    .cat-card{
        border-radius:var(--radius-lg);border:1px solid var(--border);
        background:var(--surface);padding:24px;transition:var(--transition);
        position:relative;overflow:hidden;
    }
    .cat-card::before{
        content:'';position:absolute;top:0;left:0;right:0;height:2px;
        background:linear-gradient(90deg,var(--accent),rgba(59,130,246,.6));
        transform:scaleX(0);transform-origin:left;transition:transform .3s ease;
    }
    .cat-card:hover{border-color:var(--border2);transform:translateY(-3px);box-shadow:var(--shadow-lg)}
    .cat-card:hover::before{transform:scaleX(1)}

    .cat-card-header{display:flex;align-items:flex-start;gap:16px;margin-bottom:16px}
    .cat-card-icon{
        flex-shrink:0;width:56px;height:56px;border-radius:14px;
        display:grid;place-items:center;font-size:28px;
        border:1px solid var(--border);background:var(--surface2);
        transition:var(--transition);
    }
    .cat-card:hover .cat-card-icon{background:var(--accent-glow);border-color:rgba(245,158,11,.3)}
    .cat-card-info{flex:1;min-width:0}
    .cat-card h3{font-size:18px;font-weight:700;margin-bottom:4px}
    .cat-card h3 a{transition:color .15s ease}
    .cat-card h3 a:hover{color:var(--accent)}
    .cat-card-count{font-size:12px;color:var(--text3);font-weight:600}
    .cat-card-desc{color:var(--text3);font-size:13px;line-height:1.6;margin-bottom:16px}

    .subcategories{
        display:flex;flex-wrap:wrap;gap:6px;padding-top:16px;border-top:1px solid var(--border);
    }
    .subcat-chip{
        padding:5px 12px;border-radius:6px;font-size:12px;font-weight:600;
        background:var(--surface2);border:1px solid var(--border);color:var(--text2);
        transition:var(--transition);
    }
    .subcat-chip:hover{color:var(--accent);border-color:rgba(245,158,11,.3);background:var(--accent-glow)}
    .subcat-chip.more{
        background:var(--accent-glow);border-color:rgba(245,158,11,.25);color:var(--accent2);font-weight:700;
    }

    .empty-catalog{
        padding:80px 20px;text-align:center;border-radius:var(--radius-lg);
        border:1px solid var(--border);background:var(--surface);
    }
    .empty-catalog-icon{font-size:56px;opacity:.3;margin-bottom:16px}

    @media(max-width:768px){
        .catalog-hero{padding:40px 24px}
        .categories-grid{grid-template-columns:1fr}
        .catalog-stats{gap:24px}
    }
</style>
@endpush

@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a>
    <span class="crumbs-sep">/</span>
    <span>Каталог</span>
</div>

<div class="catalog-hero">
    <div class="catalog-hero-bg"></div>
    <div class="catalog-hero-grid"></div>
    <div class="catalog-hero-content">
        <h1>Каталог обладнання</h1>
        <p>Знайдіть усе необхідне для страйкболу в одному місці. Від початківця до професіонала - ми маємо рішення для кожного рівня.</p>

        <div class="catalog-stats">
            <div>
                <div class="stat-num">{{ $categories->count() }}</div>
                <div class="stat-label">Категорій</div>
            </div>
            <div>
                <div class="stat-num">{{ $categories->sum(function($cat) { return $cat->children ? $cat->children->count() : 0; }) }}</div>
                <div class="stat-label">Підкатегорій</div>
            </div>
            <div>
                <div class="stat-num">2000+</div>
                <div class="stat-label">Товарів</div>
            </div>
            <div>
                <div class="stat-num">30+</div>
                <div class="stat-label">Брендів</div>
            </div>
        </div>
    </div>
</div>

<div class="categories-section">
    <h2 class="section-title">Всі категорії</h2>

    @if($categories->count() > 0)
    <div class="categories-grid">
        @foreach($categories as $category)
        <div class="cat-card">
            <div class="cat-card-header">
                <div class="cat-card-icon">
                    @switch($category->slug)
                        @case('pryvody') 🎯 @break
                        @case('boieprypasy') 🔘 @break
                        @case('apgreid') ⚙️ @break
                        @case('magazyny') 📋 @break
                        @case('akumulyatory') 🔋 @break
                        @case('optyka') 🔭 @break
                        @case('zakhyst') 🛡️ @break
                        @case('taktychne-sporyadzhennya') 🎒 @break
                        @case('odyag') 👕 @break
                        @case('zvyazok') 📡 @break
                        @case('kamuflyazh') 🌿 @break
                        @case('instrumenty') 🔧 @break
                        @default 📦 @break
                    @endswitch
                </div>
                <div class="cat-card-info">
                    <h3><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></h3>
                    @if($category->children && $category->children->count() > 0)
                        <div class="cat-card-count">{{ $category->children->count() }} підкатегорій</div>
                    @endif
                </div>
            </div>

            @if($category->description)
                <p class="cat-card-desc">{{ Str::limit($category->description, 100) }}</p>
            @endif

            @if($category->children && $category->children->count() > 0)
                <div class="subcategories">
                    @foreach($category->children->take(8) as $child)
                        <a href="{{ route('category.show', $child->slug) }}" class="subcat-chip">{{ $child->name }}</a>
                    @endforeach
                    @if($category->children->count() > 8)
                        <a href="{{ route('category.show', $category->slug) }}" class="subcat-chip more">
                            +{{ $category->children->count() - 8 }} ще
                        </a>
                    @endif
                </div>
            @endif
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-catalog">
        <div class="empty-catalog-icon">📦</div>
        <h3 style="font-size:18px;font-weight:700;margin-bottom:8px;">Категорії ще не додані</h3>
        <p style="color:var(--text3);font-size:14px;">Каталог товарів поповнюється. Зачекайте трохи!</p>
    </div>
    @endif
</div>
@endsection
