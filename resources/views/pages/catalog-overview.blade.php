@extends('layouts.app')

@section('title', 'Каталог товарів - Strikeball Shop')
@section('description', 'Повний каталог страйкбольного обладнання: приводи, боєприпаси, апгрейд, оптика, тактичне спорядження. Доставка по Україні.')
@section('keywords', 'каталог страйкбол, airsoft україна, купити страйкбольне обладнання')
@section('canonical', route('catalog'))

@push('styles')
<style>
    /* Hero section з фоном */
    .catalog-hero {
        position: relative;
        padding: 60px 24px;
        margin: 16px 0 32px;
        border-radius: var(--radius2);
        overflow: hidden;
        background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
        box-shadow: 0 20px 60px rgba(0,0,0,.4);
    }

    .catalog-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background:
            radial-gradient(circle at 20% 50%, rgba(88,255,122,.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(56,189,248,.15) 0%, transparent 50%),
            url('data:image/svg+xml,<svg width="60" height="60" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse"><path d="M 60 0 L 0 0 0 60" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
        opacity: 0.6;
    }

    .catalog-hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .catalog-hero h1 {
        margin: 0 0 16px;
        font-size: 48px;
        font-weight: 900;
        background: linear-gradient(135deg, #fff 0%, rgba(255,255,255,0.8) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.1;
    }

    .catalog-hero p {
        margin: 0 0 24px;
        color: rgba(255,255,255,.85);
        font-size: 18px;
        line-height: 1.6;
    }

    .catalog-stats {
        display: flex;
        gap: 32px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 32px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 36px;
        font-weight: 900;
        background: linear-gradient(135deg, rgba(88,255,122,.95), rgba(56,189,248,.95));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
    }

    .stat-label {
        margin-top: 4px;
        font-size: 13px;
        color: rgba(255,255,255,.65);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Категорії */
    .categories-section {
        margin-bottom: 60px;
    }

    .section-title {
        font-size: 28px;
        font-weight: 800;
        margin: 0 0 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title::before {
        content: '';
        width: 4px;
        height: 32px;
        background: linear-gradient(180deg, var(--accent), rgba(88,255,122,.3));
        border-radius: 999px;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .cat-card {
        position: relative;
        border-radius: var(--radius);
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05);
        backdrop-filter: blur(10px);
        padding: 24px;
        transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0,0,0,.15);
        overflow: hidden;
    }

    .cat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent), rgba(56,189,248,.8));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .3s ease;
    }

    .cat-card:hover {
        transform: translateY(-4px);
        border-color: rgba(255,255,255,.25);
        background: rgba(255,255,255,.08);
        box-shadow: 0 12px 40px rgba(0,0,0,.25);
    }

    .cat-card:hover::before {
        transform: scaleX(1);
    }

    .cat-card-header {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 16px;
    }

    .cat-card-icon {
        flex-shrink: 0;
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        font-size: 32px;
        border: 1px solid rgba(255,255,255,.15);
        background: linear-gradient(135deg, rgba(88,255,122,.12), rgba(56,189,248,.12));
        box-shadow: 0 8px 16px rgba(0,0,0,.2), inset 0 1px 0 rgba(255,255,255,.1);
        transition: transform .3s ease;
    }

    .cat-card:hover .cat-card-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .cat-card-info {
        flex: 1;
        min-width: 0;
    }

    .cat-card h3 {
        margin: 0 0 6px;
        font-size: 20px;
        font-weight: 800;
    }

    .cat-card h3 a {
        color: var(--text);
        text-decoration: none;
        transition: color .2s ease;
    }

    .cat-card h3 a:hover {
        color: var(--accent);
    }

    .cat-card-count {
        font-size: 13px;
        color: var(--muted);
        font-weight: 600;
    }

    .cat-card-desc {
        color: rgba(255,255,255,.7);
        font-size: 14px;
        line-height: 1.6;
        margin: 0 0 16px;
    }

    .subcategories {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding-top: 16px;
        border-top: 1px solid rgba(255,255,255,.08);
    }

    .subcat-link {
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.12);
        font-size: 13px;
        font-weight: 600;
        color: rgba(255,255,255,.75);
        text-decoration: none;
        transition: all .2s ease;
        white-space: nowrap;
    }

    .subcat-link:hover {
        background: rgba(88,255,122,.15);
        border-color: rgba(88,255,122,.3);
        color: rgba(88,255,122,.95);
        transform: translateY(-1px);
    }

    .subcat-more {
        background: linear-gradient(135deg, rgba(88,255,122,.15), rgba(56,189,248,.15));
        border-color: rgba(255,255,255,.2);
        color: var(--text);
        font-weight: 700;
    }

    /* Mobile */
    @media (max-width: 768px) {
        .catalog-hero {
            padding: 40px 20px;
        }

        .catalog-hero h1 {
            font-size: 32px;
        }

        .catalog-hero p {
            font-size: 16px;
        }

        .categories-grid {
            grid-template-columns: 1fr;
        }

        .stat-number {
            font-size: 28px;
        }
    }

    /* Smooth scroll */
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush

@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a> / <span>Каталог</span>
</div>

<!-- Hero Section -->
<div class="catalog-hero">
    <div class="catalog-hero-content">
        <h1>🎯 Каталог страйкбольного обладнання</h1>
        <p>Знайдіть усе необхідне для страйкболу в одному місці. Від початківця до професіонала – ми маємо рішення для кожного рівня.</p>

        <div class="catalog-stats">
            <div class="stat-item">
                <div class="stat-number">{{ $categories->count() }}</div>
                <div class="stat-label">Категорій</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $categories->sum(function($cat) { return $cat->children ? $cat->children->count() : 0; }) }}</div>
                <div class="stat-label">Підкатегорій</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">2000+</div>
                <div class="stat-label">Товарів</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">30+</div>
                <div class="stat-label">Брендів</div>
            </div>
        </div>
    </div>
</div>

<!-- Categories -->
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
                    <h3>
                        <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                    </h3>
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
                        <a href="{{ route('category.show', $child->slug) }}" class="subcat-link">{{ $child->name }}</a>
                    @endforeach
                    @if($category->children->count() > 8)
                        <a href="{{ route('category.show', $category->slug) }}" class="subcat-link subcat-more">
                            +{{ $category->children->count() - 8 }} ще
                        </a>
                    @endif
                </div>
            @endif
        </div>
        @endforeach
    </div>
    @else
    <div class="card" style="text-align:center;padding:80px 20px;background:rgba(255,255,255,.05);backdrop-filter:blur(10px);">
        <div style="font-size:64px;margin-bottom:20px;opacity:.3;">📦</div>
        <h3 style="margin:0 0 12px;">Категорії ще не додані</h3>
        <p style="color:var(--muted);margin:0;">Каталог товарів поповнюється. Зачекайте трохи!</p>
    </div>
    @endif
</div>

@endsection
