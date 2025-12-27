@extends('layouts.app')

@section('title', 'Головна - Strikeball Shop')

@section('content')
<div style="padding:40px 0;">
    <h1 style="text-align:center;margin-bottom:40px;">Вітаємо в Strikeball Shop</h1>

    @if($featuredProducts->count() > 0)
        <div style="margin-bottom:40px;">
            <h2 style="margin-bottom:20px;">Хіти продажів</h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:16px;">
                @foreach($featuredProducts as $product)
                    <div class="card">
                        <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit;">
                            <div style="height:150px;background:rgba(255,255,255,.05);border-radius:12px;margin-bottom:12px;display:grid;place-items:center;">
                                @if($product->primaryImage)
                                    <span style="font-size:48px;">📦</span>
                                @else
                                    <span style="font-size:48px;">📦</span>
                                @endif
                            </div>
                            <h3 style="margin:0 0 8px;font-size:16px;">{{ $product->name }}</h3>
                            <div style="color:rgba(255,255,255,.65);font-size:14px;margin-bottom:12px;">
                                {{ $product->category->name }}
                            </div>
                            <div style="display:flex;justify-content:space-between;align-items:center;">
                                <div style="font-weight:900;font-size:18px;">{{ number_format($product->price, 0) }} грн</div>
                                <form method="POST" action="{{ route('cart.add') }}" style="margin:0;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn primary" style="padding:8px 12px;font-size:14px;">
                                        В кошик
                                    </button>
                                </form>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($categories->count() > 0)
        <div>
            <h2 style="margin-bottom:20px;">Категорії</h2>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;">
                @foreach($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}" class="card" style="text-decoration:none;color:inherit;text-align:center;">
                        <h3 style="margin:0;">{{ $category->name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
