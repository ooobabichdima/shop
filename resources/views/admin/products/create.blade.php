@extends('layouts.app')

@section('title', 'Додати товар - Адмін')

@section('content')
<div style="padding:20px 0;">
    <div style="margin-bottom:30px;">
        <a href="{{ route('admin.products.index') }}" class="btn small" style="margin-bottom:16px;">
            ← Назад до списку
        </a>
        <h1 style="margin:0;">Додати новий товар</h1>
    </div>

    <div class="card" style="padding:24px;max-width:800px;">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Назва товару *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                    placeholder="Наприклад: AEG M4 RIS CQB">
                @error('name')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">SKU (артикул) *</label>
                <input type="text" name="sku" value="{{ old('sku') }}" required
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
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
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
                    placeholder="Детальний опис товару...">{{ old('description') }}</textarea>
                @error('description')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">YouTube відео</label>
                <input type="url" name="youtube_url" value="{{ old('youtube_url') }}"
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                    placeholder="https://www.youtube.com/watch?v=...">
                <small style="color:var(--muted);margin-top:4px;display:block;">Вставте посилання на YouTube відео</small>
                @error('youtube_url')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;margin-bottom:20px;">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Ціна, грн *</label>
                    <input type="number" name="price" value="{{ old('price') }}" required min="0" step="0.01"
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                        placeholder="9990">
                    @error('price')
                        <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Стара ціна, грн</label>
                    <input type="number" name="old_price" value="{{ old('old_price') }}" min="0" step="0.01"
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                        placeholder="10990">
                    @error('old_price')
                        <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Залишок *</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" required min="0" step="1"
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
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        style="width:18px;height:18px;accent-color:var(--accent);">
                    <span>Активний (відображається на сайті)</span>
                </label>

                <label style="display:flex;gap:10px;align-items:center;padding:8px 0;cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                        style="width:18px;height:18px;accent-color:var(--accent);">
                    <span>Хіт продажів</span>
                </label>

                <label style="display:flex;gap:10px;align-items:center;padding:8px 0;cursor:pointer;">
                    <input type="checkbox" name="is_new" value="1" {{ old('is_new') ? 'checked' : '' }}
                        style="width:18px;height:18px;accent-color:var(--accent);">
                    <span>Новинка</span>
                </label>
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Характеристики (JSON)</label>
                <textarea name="specs" rows="6"
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;font-family:monospace;resize:vertical;"
                    placeholder='{"Швидкість пострілу":"300-320 м/с","Ємність магазину":"120 куль","Вага":"2.8 кг"}'>{{ old('specs') }}</textarea>
                <small style="color:var(--muted);margin-top:4px;display:block;">Формат JSON: {"Назва характеристики": "Значення"}</small>
                @error('specs')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Пакети для тюнінгу (JSON)</label>
                <textarea name="tuning_kits" rows="8"
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;font-family:monospace;resize:vertical;"
                    placeholder='[{"name":"Базовий тюнінг","price":1500,"items":["Заміна пружини","Регулювання хопапу","Змащення"]},{"name":"Розширений","price":3500,"items":["Базовий тюнінг","Заміна циліндра","Встановлення тайт-бору"]}]'>{{ old('tuning_kits') }}</textarea>
                <small style="color:var(--muted);margin-top:4px;display:block;">Формат JSON: масив об'єктів з полями name, price, items (масив)</small>
                @error('tuning_kits')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Рекомендовані товари</label>
                <select name="recommended_products[]" multiple size="8"
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:14px;">
                    @foreach($products as $p)
                        <option value="{{ $p->id }}" style="padding:6px;">
                            {{ $p->name }} ({{ number_format($p->price, 0, '', ' ') }} грн)
                        </option>
                    @endforeach
                </select>
                <small style="color:var(--muted);margin-top:4px;display:block;">Тримайте Ctrl (Cmd на Mac) щоб вибрати декілька товарів</small>
                @error('recommended_products')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn primary">
                    💾 Створити товар
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn">
                    Скасувати
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
