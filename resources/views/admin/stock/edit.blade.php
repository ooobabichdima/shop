@extends('layouts.admin')
@section('title', 'Залишки: ' . $product->name . ' - Адмін')
@section('content')
<div style="padding:20px 0;">
    <div style="margin-bottom:30px;">
        <a href="{{ route('admin.stock.index') }}" class="btn" style="margin-bottom:12px;">← Назад до залишків</a>
        <h1 style="margin:0;">Залишки: {{ $product->name }}</h1>
        <p style="color:var(--muted);margin:6px 0 0;">SKU: {{ $product->sku }} | Категорія: {{ $product->category->name ?? '-' }}</p>
    </div>

    <form method="POST" action="{{ route('admin.stock.update', $product) }}">
        @csrf
        @method('PUT')

        <div class="card" style="padding:20px;margin-bottom:16px;">
            <h2 style="margin:0 0 20px;">Кількість на складах</h2>

            <div style="display:grid;gap:16px;">
                @foreach($warehouses as $wh)
                @php
                    $stock = $product->warehouses->firstWhere('id', $wh->id);
                    $qty = $stock ? $stock->pivot->quantity : 0;
                    $reserved = $stock ? $stock->pivot->reserved : 0;
                @endphp
                <div style="padding:16px;border-radius:14px;border:1px solid rgba(255,255,255,.12);background:rgba(0,0,0,.14);">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                        <div>
                            <div style="font-weight:700;font-size:16px;">{{ $wh->name }}</div>
                            <div style="font-size:13px;color:var(--muted);">{{ $wh->city }} • {{ $wh->code }}</div>
                        </div>
                        @if($wh->is_active)
                            <span style="padding:4px 10px;border-radius:8px;font-size:12px;font-weight:700;background:rgba(88,255,122,.12);border:1px solid rgba(88,255,122,.25);color:var(--accent);">Активний</span>
                        @endif
                    </div>

                    <input type="hidden" name="warehouses[{{ $loop->index }}][warehouse_id]" value="{{ $wh->id }}">

                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;">
                        <div>
                            <label style="display:block;margin-bottom:6px;font-size:13px;font-weight:700;color:var(--muted);">Кількість</label>
                            <input type="number" name="warehouses[{{ $loop->index }}][quantity]" value="{{ $qty }}" min="0"
                                style="width:100%;padding:10px 14px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);font-size:16px;font-weight:700;">
                        </div>
                        <div>
                            <label style="display:block;margin-bottom:6px;font-size:13px;font-weight:700;color:var(--muted);">Зарезервовано</label>
                            <input type="number" name="warehouses[{{ $loop->index }}][reserved]" value="{{ $reserved }}" min="0"
                                style="width:100%;padding:10px 14px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);font-size:16px;font-weight:700;">
                        </div>
                        <div>
                            <label style="display:block;margin-bottom:6px;font-size:13px;font-weight:700;color:var(--muted);">Доступно</label>
                            <div style="padding:10px 14px;border-radius:12px;border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.04);font-size:16px;font-weight:900;color:{{ max(0, $qty - $reserved) > 0 ? 'var(--accent)' : 'var(--danger)' }};">
                                {{ max(0, $qty - $reserved) }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn primary">Зберегти залишки</button>
            <a href="{{ route('admin.stock.index') }}" class="btn">Скасувати</a>
        </div>
    </form>
</div>
@endsection
