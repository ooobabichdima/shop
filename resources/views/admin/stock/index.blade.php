@extends('layouts.admin')
@section('title', 'Управління залишками - Адмін')
@section('content')
<div style="padding:20px 0;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
        <div>
            <h1 style="margin:0;">Залишки на складах</h1>
            <p style="color:var(--muted);margin:4px 0 0;font-size:14px;">Управління кількістю товарів на складах</p>
        </div>
        <a href="{{ route('admin.warehouses.index') }}" class="btn">Склади</a>
    </div>

    {{-- Filters --}}
    <div class="card" style="padding:16px;margin-bottom:20px;">
        <form method="GET" action="{{ route('admin.stock.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
            <div style="flex:1;min-width:200px;">
                <label style="display:block;margin-bottom:6px;font-size:13px;font-weight:700;color:var(--muted);">Пошук</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Назва або артикул..."
                    style="width:100%;padding:10px 14px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);font-size:14px;">
            </div>
            <div style="min-width:160px;">
                <label style="display:block;margin-bottom:6px;font-size:13px;font-weight:700;color:var(--muted);">Категорія</label>
                <select name="category_id" style="width:100%;padding:10px 14px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);font-size:14px;">
                    <option value="">Всі</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:160px;">
                <label style="display:block;margin-bottom:6px;font-size:13px;font-weight:700;color:var(--muted);">Статус</label>
                <select name="stock_status" style="width:100%;padding:10px 14px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);font-size:14px;">
                    <option value="">Всі</option>
                    <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>В наявності</option>
                    <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Мало (менше 5)</option>
                    <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Немає на складі</option>
                </select>
            </div>
            <button type="submit" class="btn primary" style="height:42px;">Фільтрувати</button>
            <a href="{{ route('admin.stock.index') }}" class="btn" style="height:42px;">Скинути</a>
        </form>
    </div>

    {{-- Stock table --}}
    <div class="card" style="overflow-x:auto;padding:0;">
        <table style="width:100%;border-collapse:collapse;font-size:14px;">
            <thead>
                <tr style="border-bottom:1px solid rgba(255,255,255,.12);background:rgba(0,0,0,.14);">
                    <th style="padding:14px 16px;text-align:left;font-weight:700;white-space:nowrap;">Товар</th>
                    <th style="padding:14px 10px;text-align:left;font-weight:700;">SKU</th>
                    @foreach($warehouses as $wh)
                    <th style="padding:14px 10px;text-align:center;font-weight:700;min-width:100px;">
                        <div>{{ $wh->name }}</div>
                        <div style="font-size:11px;color:var(--muted);font-weight:500;">{{ $wh->code }}</div>
                    </th>
                    @endforeach
                    <th style="padding:14px 10px;text-align:center;font-weight:700;">Всього</th>
                    <th style="padding:14px 10px;text-align:center;font-weight:700;">Статус</th>
                    <th style="padding:14px 16px;text-align:right;font-weight:700;">Дії</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr style="border-bottom:1px solid rgba(255,255,255,.06);" class="stock-row">
                    <td style="padding:12px 16px;">
                        <div style="font-weight:700;max-width:300px;">{{ Str::limit($product->name, 50) }}</div>
                        <div style="font-size:12px;color:var(--muted);">{{ $product->category->name ?? '-' }}</div>
                    </td>
                    <td style="padding:12px 10px;">
                        <code style="background:rgba(255,255,255,.06);padding:3px 8px;border-radius:6px;font-size:12px;">{{ $product->sku }}</code>
                    </td>
                    @foreach($warehouses as $wh)
                    @php
                        $stock = $product->warehouses->firstWhere('id', $wh->id);
                        $qty = $stock ? $stock->pivot->quantity : 0;
                        $reserved = $stock ? $stock->pivot->reserved : 0;
                        $available = max(0, $qty - $reserved);
                    @endphp
                    <td style="padding:12px 10px;text-align:center;">
                        <div style="font-weight:700;font-size:16px;{{ $available > 0 ? 'color:var(--accent)' : 'color:var(--muted2)' }}">
                            {{ $qty }}
                        </div>
                        @if($reserved > 0)
                            <div style="font-size:11px;color:var(--warn);">резерв: {{ $reserved }}</div>
                        @endif
                    </td>
                    @endforeach
                    <td style="padding:12px 10px;text-align:center;">
                        @php
                            $totalQty = $product->warehouses->sum('pivot.quantity');
                            $totalAvail = $product->warehouses->sum(fn($w) => max(0, $w->pivot->quantity - $w->pivot->reserved));
                        @endphp
                        <div style="font-weight:900;font-size:18px;">{{ $totalQty }}</div>
                        @if($totalAvail != $totalQty)
                            <div style="font-size:11px;color:var(--muted);">доступно: {{ $totalAvail }}</div>
                        @endif
                    </td>
                    <td style="padding:12px 10px;text-align:center;">
                        @if($totalAvail > 0)
                            <span style="padding:4px 10px;border-radius:8px;font-size:12px;font-weight:700;background:rgba(88,255,122,.12);border:1px solid rgba(88,255,122,.25);color:var(--accent);">В наявності</span>
                        @else
                            <span style="padding:4px 10px;border-radius:8px;font-size:12px;font-weight:700;background:rgba(255,204,0,.12);border:1px solid rgba(255,204,0,.25);color:var(--warn);">Під замовлення</span>
                        @endif
                    </td>
                    <td style="padding:12px 16px;text-align:right;">
                        <a href="{{ route('admin.stock.edit', $product) }}" class="btn small">Редагувати</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ 4 + $warehouses->count() }}" style="padding:40px;text-align:center;color:var(--muted);">
                        Товарів не знайдено
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="pagination" style="margin-top:20px;">
            {{ $products->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection
