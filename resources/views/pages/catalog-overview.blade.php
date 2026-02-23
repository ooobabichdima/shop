@extends('layouts.app')

@section('title', 'Каталог товарів - Strikeball Shop')
@section('description', 'Повний каталог страйкбольного обладнання: приводи, боєприпаси, апгрейд, оптика, тактичне спорядження. Доставка по Україні.')
@section('keywords', 'каталог страйкбол, airsoft україна, купити страйкбольне обладнання')
@section('canonical', route('catalog'))

@push('styles')
<style>
    .catalog-head {
        padding: 24px;
        border-radius: var(--radius2);
        border: 1px solid rgba(255,255,255,.12);
        margin: 16px 0 24px;
        background: radial-gradient(700px 240px at 20% 0%, rgba(88,255,122,.18), transparent 60%),
                    radial-gradient(520px 220px at 86% 10%, rgba(56,189,248,.14), transparent 55%),
                    linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));
        box-shadow: var(--shadow);
    }
    .catalog-head h1 {
        margin: 0 0 12px;
        font-size: var(--h1);
        line-height: 1.08;
    }
    .catalog-head p {
        margin: 0;
        color: var(--muted);
        font-size: var(--p);
        max-width: 72ch;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .cat-card {
        border-radius: var(--radius);
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05);
        padding: 20px;
        transition: transform .12s ease, border-color .12s ease, background .12s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,.30);
    }
    .cat-card:hover {
        transform: translateY(-2px);
        border-color: rgba(255,255,255,.22);
        background: rgba(255,255,255,.06);
    }

    .cat-card-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        font-size: 28px;
        margin-bottom: 14px;
        border: 1px solid rgba(255,255,255,.10);
        background: radial-gradient(80px 80px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
                    linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
    }

    .cat-card h3 {
        margin: 0 0 8px;
        font-size: 18px;
        font-weight: 780;
    }
    .cat-card h3 a {
        color: var(--text);
        text-decoration: none;
    }
    .cat-card h3 a:hover {
        color: var(--accent);
    }

    .cat-card-desc {
        color: var(--muted);
        font-size: 14px;
        margin: 0 0 12px;
        line-height: 1.5;
    }

    .subcategories {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid rgba(255,255,255,.10);
    }

    .subcat-link {
        padding: 5px 10px;
        border-radius: 999px;
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.10);
        font-size: 12.5px;
        color: var(--muted);
        text-decoration: none;
        transition: all .12s ease;
    }
    .subcat-link:hover {
        background: rgba(255,255,255,.10);
        color: var(--text);
        border-color: rgba(255,255,255,.18);
    }

    @media (max-width: 768px) {
        .categories-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a> / <span>Каталог</span>
</div>

<div class="catalog-head">
    <span class="pill">Каталог</span>
    <h1>Каталог страйкбольного обладнання</h1>
    <p>Широкий вибір приводів, обладнання, одягу та аксесуарів для страйкболу. Якісні товари від перевірених виробників з доставкою по всій Україні.</p>
</div>

<div class="categories-grid">
    @foreach($categories as $category)
    <div class="cat-card">
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

        <h3><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></h3>

        @if($category->description)
            <p class="cat-card-desc">{{ Str::limit($category->description, 120) }}</p>
        @endif

        @if($category->children && $category->children->count() > 0)
            <div class="subcategories">
                @foreach($category->children->take(6) as $child)
                    <a href="{{ route('category.show', $child->slug) }}" class="subcat-link">{{ $child->name }}</a>
                @endforeach
                @if($category->children->count() > 6)
                    <a href="{{ route('category.show', $category->slug) }}" class="subcat-link" style="font-weight:600;">
                        +{{ $category->children->count() - 6 }} ще
                    </a>
                @endif
            </div>
        @endif
    </div>
    @endforeach
</div>

@if($categories->count() === 0)
<div class="card" style="text-align:center;padding:60px 20px;">
    <div style="font-size:64px;margin-bottom:20px;opacity:.3;">📦</div>
    <h3>Категорії ще не додані</h3>
    <p style="color:var(--muted);">Каталог товарів поповнюється</p>
</div>
@endif

@endsection
