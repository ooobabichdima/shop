@extends('layouts.app')

@section('title', $product->name . ' - Strikeball Shop')

@section('content')
<div style="padding:20px 0;">
    <div class="card" style="margin-bottom:20px;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            <div>
                <div style="height:400px;background:rgba(255,255,255,.05);border-radius:12px;display:grid;place-items:center;">
                    <span style="font-size:120px;">📦</span>
                </div>
            </div>
            <div>
                <h1 style="margin-bottom:16px;">{{ $product->name }}</h1>
                <div style="color:rgba(255,255,255,.65);margin-bottom:16px;">
                    SKU: {{ $product->sku }} | {{ $product->category->name }}
                    @if($product->brand)
                        | {{ $product->brand->name }}
                    @endif
                </div>

                <div style="font-size:32px;font-weight:900;margin-bottom:16px;">
                    {{ number_format($product->price, 0) }} грн
                    @if($product->old_price && $product->old_price > $product->price)
                        <span style="text-decoration:line-through;color:rgba(255,255,255,.45);font-size:24px;margin-left:10px;">
                            {{ number_format($product->old_price, 0) }} грн
                        </span>
                    @endif
                </div>

                <div style="margin-bottom:20px;">
                    @if($product->isInStock())
                        <span style="color:rgba(88,255,122,.9);">✓ В наявності ({{ $product->stock }} шт)</span>
                    @else
                        <span style="color:rgba(255,77,77,.9);">✗ Немає в наявності</span>
                    @endif
                </div>

                @if($product->description)
                    <div style="margin-bottom:20px;color:rgba(255,255,255,.8);">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                @endif

                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div style="display:flex;gap:12px;margin-bottom:16px;">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                               style="width:80px;padding:12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);">
                        <button type="submit" class="btn primary" style="flex:1;" @if(!$product->isInStock()) disabled @endif>
                            Додати в кошик
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($product->recommended->count() > 0)
        <div class="card">
            <h2 style="margin-bottom:20px;">Рекомендовані товари</h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;">
                @foreach($product->recommended as $rec)
                    <div style="border:1px solid rgba(255,255,255,.12);border-radius:12px;padding:12px;">
                        <a href="{{ route('product.show', $rec->slug) }}" style="text-decoration:none;color:inherit;">
                            <div style="height:100px;background:rgba(255,255,255,.05);border-radius:8px;margin-bottom:8px;"></div>
                            <div style="font-weight:700;margin-bottom:4px;">{{ $rec->name }}</div>
                            <div style="font-weight:900;">{{ number_format($rec->price, 0) }} грн</div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
