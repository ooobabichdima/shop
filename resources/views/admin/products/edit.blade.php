@extends('layouts.app')

@section('title', 'Редагувати товар - Адмін')

@section('content')
<div style="padding:20px 0;">
    <div style="margin-bottom:30px;">
        <a href="{{ route('admin.products.index') }}" class="btn small" style="margin-bottom:16px;">
            ← Назад до списку
        </a>
        <h1 style="margin:0;">Редагувати товар</h1>
        <div style="color:var(--muted);margin-top:8px;">{{ $product->name }}</div>
    </div>

    <div class="card" style="padding:24px;max-width:800px;">
        <form method="POST" action="{{ route('admin.products.update', $product) }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Назва товару *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                    placeholder="Наприклад: AEG M4 RIS CQB">
                @error('name')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">SKU (артикул) *</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                    placeholder="Наприклад: DRV-M4-001">
                @error('sku')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Категорія *</label>
                    <select name="category_id" required
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;">
                        <option value="">Оберіть категорію</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Бренд</label>
                    <select name="brand_id"
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;">
                        <option value="">Не обрано</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Опис</label>
                <textarea name="description" rows="4"
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;resize:vertical;"
                    placeholder="Детальний опис товару...">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;margin-bottom:20px;">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Ціна, грн *</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" step="0.01"
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                        placeholder="9990">
                    @error('price')
                        <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Стара ціна, грн</label>
                    <input type="number" name="old_price" value="{{ old('old_price', $product->old_price) }}" min="0" step="0.01"
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                        placeholder="10990">
                    @error('old_price')
                        <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Залишок *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" step="1"
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                        placeholder="10">
                    @error('stock')
                        <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom:24px;padding:16px;border-radius:14px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);">
                <div style="font-weight:700;margin-bottom:12px;">Статуси товару</div>

                <label style="display:flex;gap:10px;align-items:center;padding:8px 0;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                        style="width:18px;height:18px;accent-color:var(--accent);">
                    <span>Активний (відображається на сайті)</span>
                </label>

                <label style="display:flex;gap:10px;align-items:center;padding:8px 0;cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                        style="width:18px;height:18px;accent-color:var(--accent);">
                    <span>Хіт продажів</span>
                </label>

                <label style="display:flex;gap:10px;align-items:center;padding:8px 0;cursor:pointer;">
                    <input type="checkbox" name="is_new" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }}
                        style="width:18px;height:18px;accent-color:var(--accent);">
                    <span>Новинка</span>
                </label>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn primary">
                    💾 Зберегти зміни
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn">
                    Скасувати
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
