@extends('layouts.app')

@section('title', 'Товари - Адмін')

@section('content')
<div style="padding:20px 0;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;flex-wrap:wrap;gap:16px;">
        <h1 style="margin:0;">Товари</h1>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <form method="POST" action="{{ route('admin.products.import') }}" style="margin:0;">
                @csrf
                <button type="submit" class="btn" style="background:rgba(56,189,248,.15);border-color:rgba(56,189,248,.3);" onclick="return confirm('Імпортувати тестові дані? Це створить нові товари, категорії та бренди.')">
                    📥 Імпорт даних
                </button>
            </form>
            <a href="{{ route('admin.products.create') }}" class="btn primary">
                + Додати товар
            </a>
        </div>
    </div>

    <div class="card" style="padding:20px;">
        @if($products->count() > 0)
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="border-bottom:2px solid rgba(255,255,255,.12);">
                            <th style="text-align:left;padding:12px 8px;font-size:13px;color:var(--muted);">Товар</th>
                            <th style="text-align:left;padding:12px 8px;font-size:13px;color:var(--muted);">SKU</th>
                            <th style="text-align:left;padding:12px 8px;font-size:13px;color:var(--muted);">Категорія</th>
                            <th style="text-align:right;padding:12px 8px;font-size:13px;color:var(--muted);">Ціна</th>
                            <th style="text-align:center;padding:12px 8px;font-size:13px;color:var(--muted);">Залишок</th>
                            <th style="text-align:center;padding:12px 8px;font-size:13px;color:var(--muted);">Статус</th>
                            <th style="text-align:right;padding:12px 8px;font-size:13px;color:var(--muted);">Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr style="border-bottom:1px solid rgba(255,255,255,.08);">
                            <td style="padding:12px 8px;">
                                <div style="font-weight:700;">{{ $product->name }}</div>
                                @if($product->brand)
                                    <div style="color:var(--muted);font-size:12px;margin-top:2px;">{{ $product->brand->name }}</div>
                                @endif
                            </td>
                            <td style="padding:12px 8px;font-size:13px;color:var(--muted);">{{ $product->sku }}</td>
                            <td style="padding:12px 8px;font-size:13px;">{{ $product->category->name }}</td>
                            <td style="padding:12px 8px;text-align:right;font-weight:800;">
                                {{ number_format($product->price, 0) }} грн
                                @if($product->old_price)
                                    <div style="font-size:12px;color:var(--muted);font-weight:400;text-decoration:line-through;">
                                        {{ number_format($product->old_price, 0) }}
                                    </div>
                                @endif
                            </td>
                            <td style="padding:12px 8px;text-align:center;">
                                <span style="padding:4px 8px;border-radius:8px;font-size:12px;font-weight:700;
                                    background:{{ $product->stock > 10 ? 'rgba(88,255,122,.15)' : ($product->stock > 0 ? 'rgba(255,204,0,.15)' : 'rgba(255,77,77,.15)') }};
                                    color:{{ $product->stock > 10 ? 'rgba(88,255,122,.95)' : ($product->stock > 0 ? 'rgba(255,204,0,.95)' : 'rgba(255,77,77,.95)') }};">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td style="padding:12px 8px;text-align:center;">
                                @if($product->is_active)
                                    <span style="color:rgba(88,255,122,.95);font-size:12px;">✓ Активний</span>
                                @else
                                    <span style="color:var(--muted);font-size:12px;">○ Неактивний</span>
                                @endif
                            </td>
                            <td style="padding:12px 8px;text-align:right;">
                                <div style="display:flex;gap:8px;justify-content:flex-end;">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn small" style="padding:6px 10px;font-size:12px;">
                                        ✏️ Редагувати
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="margin:0;" onsubmit="return confirm('Видалити товар {{ $product->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn small" style="padding:6px 10px;font-size:12px;background:rgba(255,77,77,.1);border-color:rgba(255,77,77,.3);color:rgba(255,77,77,.95);">
                                            🗑️ Видалити
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top:20px;">
                {{ $products->links() }}
            </div>
        @else
            <div style="text-align:center;padding:40px 20px;">
                <div style="font-size:48px;margin-bottom:16px;opacity:.5;">📦</div>
                <h3 style="margin:0 0 8px;">Товарів ще немає</h3>
                <p style="color:var(--muted);margin:0 0 20px;">Додайте перший товар або імпортуйте тестові дані</p>
                <div style="display:flex;gap:10px;justify-content:center;">
                    <form method="POST" action="{{ route('admin.products.import') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn" onclick="return confirm('Імпортувати тестові дані?')">
                            📥 Імпорт даних
                        </button>
                    </form>
                    <a href="{{ route('admin.products.create') }}" class="btn primary">
                        + Додати товар
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
