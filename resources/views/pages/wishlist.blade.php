@extends('layouts.app')
@section('title', 'Обране - Strikeball Shop')

@section('content')
@push('styles')
<style>
    .wish-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px}
    .wish-card{
        border-radius:var(--radius-lg);border:1px solid var(--border);background:var(--surface);
        overflow:hidden;display:flex;flex-direction:column;transition:var(--transition);
    }
    .wish-card:hover{border-color:var(--border2);transform:translateY(-3px);box-shadow:var(--shadow-lg)}
    .wish-img{
        height:180px;position:relative;
        background:linear-gradient(135deg,var(--surface2),var(--surface3));
        display:grid;place-items:center;font-size:48px;
    }
    .wish-stock{
        position:absolute;top:10px;right:10px;
        padding:3px 8px;border-radius:6px;font-size:10px;font-weight:700;
    }
    .wish-stock.in-stock{background:rgba(34,197,94,.15);border:1px solid rgba(34,197,94,.3);color:var(--success)}
    .wish-stock.on-order{background:rgba(245,158,11,.15);border:1px solid rgba(245,158,11,.3);color:var(--accent2)}
    .wish-body{padding:16px 18px;flex:1;display:flex;flex-direction:column}
    .wish-name{font-size:15px;font-weight:600;line-height:1.4;margin-bottom:8px}
    .wish-meta{color:var(--text3);font-size:12px;margin-bottom:12px}
    .wish-footer{
        margin-top:auto;padding:14px 18px;border-top:1px solid var(--border);
        display:flex;align-items:center;justify-content:space-between;gap:8px;
    }
    .wish-price{font-size:18px;font-weight:800}
    .wish-actions{display:flex;gap:8px}
    .wish-remove{
        width:36px;height:36px;border-radius:10px;border:1px solid var(--border);
        background:var(--surface2);color:var(--text3);cursor:pointer;
        display:grid;place-items:center;transition:var(--transition);
    }
    .wish-remove:hover{border-color:rgba(255,77,77,.3);color:rgba(255,77,77,.9);background:rgba(255,77,77,.1)}
    .empty-wish{
        padding:80px 20px;text-align:center;border-radius:var(--radius-lg);
        border:1px solid var(--border);background:var(--surface);
    }
</style>
@endpush

<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a>
    <span class="crumbs-sep">/</span>
    <span>Обране</span>
</div>

<div style="margin:24px 0;">
    <h1 style="margin:0 0 8px;">Обране</h1>
    <p style="color:var(--text3);font-size:15px;">{{ $products->count() }} {{ $products->count() == 1 ? 'товар' : 'товарів' }} в обраному</p>
</div>

@if($products->count() > 0)
<div class="wish-grid">
    @foreach($products as $product)
    <div class="wish-card">
        <a class="wish-img" href="{{ route('product.show', $product->slug) }}">
            @php $sb = $product->stock_status_badge; @endphp
            <span class="wish-stock {{ $sb['class'] }}">{{ $sb['text'] }}</span>
            @if($product->primaryImage)
                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" alt="{{ $product->name }}"
                    style="width:100%;height:100%;object-fit:cover;">
            @else
                <span>📦</span>
            @endif
        </a>
        <div class="wish-body">
            <a class="wish-name" href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
            <div class="wish-meta">
                {{ $product->category->name ?? '' }}
                @if($product->brand) &bull; {{ $product->brand->name }} @endif
            </div>
        </div>
        <div class="wish-footer">
            <div class="wish-price">{{ number_format($product->price, 0, '.', ' ') }} <small style="font-weight:500;font-size:13px;color:var(--text3)">грн</small></div>
            <div class="wish-actions">
                <form method="POST" action="{{ route('cart.add') }}" style="margin:0;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary btn-sm">В кошик</button>
                </form>
                <form method="POST" action="{{ route('wishlist.remove') }}" style="margin:0;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="wish-remove" title="Видалити з обраного">✕</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="empty-wish">
    <div style="font-size:48px;opacity:.5;margin-bottom:16px;">💛</div>
    <h3 style="font-size:20px;font-weight:700;margin-bottom:8px;">Список обраного порожній</h3>
    <p style="color:var(--text3);font-size:15px;margin-bottom:24px;">Натисніть на серце на картці товару, щоб додати його в обране</p>
    <a href="{{ route('catalog') }}" class="btn btn-primary">Перейти до каталогу</a>
</div>
@endif
@endsection
