@extends('layouts.app')

@section('title', 'Товари - Адмін')

@section('content')
<div style="padding:20px 0;">
    <h1 style="margin-bottom:30px;">Товари</h1>

    <div class="card">
        @foreach($products as $product)
            <div style="display:flex;justify-content:space-between;align-items:center;padding:16px 0;border-bottom:1px solid rgba(255,255,255,.1);">
                <div>
                    <div style="font-weight:900;">{{ $product->name }}</div>
                    <div style="color:rgba(255,255,255,.65);font-size:14px;margin-top:4px;">
                        {{ $product->sku }} • {{ $product->category->name }}
                    </div>
                </div>
                <div style="text-align:right;">
                    <div style="font-weight:900;margin-bottom:4px;">{{ number_format($product->price, 0) }} грн</div>
                    <div style="font-size:14px;">Залишок: {{ $product->stock }}</div>
                </div>
            </div>
        @endforeach

        <div style="margin-top:20px;">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
