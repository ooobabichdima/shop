@extends('layouts.app')

@section('title', $category->name . ' - Strikeball Shop')

@section('content')
<div style="padding:20px 0;">
    <h1 style="margin-bottom:30px;">{{ $category->name }}</h1>

    @if($products->count() > 0)
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:16px;margin-bottom:30px;">
            @foreach($products as $product)
                <div class="card">
                    <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit;">
                        <div style="height:150px;background:rgba(255,255,255,.05);border-radius:12px;margin-bottom:12px;display:grid;place-items:center;">
                            <span style="font-size:48px;">📦</span>
                        </div>
                        <h3 style="margin:0 0 8px;font-size:16px;">{{ $product->name }}</h3>
                        <div style="color:rgba(255,255,255,.65);font-size:13px;margin-bottom:8px;">{{ $product->sku }}</div>
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <div style="font-weight:900;font-size:18px;">{{ number_format($product->price, 0) }} грн</div>
                            @if($product->isInStock())
                                <span style="color:rgba(88,255,122,.9);font-size:13px;">В наявності</span>
                            @else
                                <span style="color:rgba(255,77,77,.9);font-size:13px;">Немає</span>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    @else
        <div class="card" style="text-align:center;padding:40px;">
            <p style="font-size:18px;color:rgba(255,255,255,.65);">Товари не знайдено</p>
        </div>
    @endif
</div>
@endsection
