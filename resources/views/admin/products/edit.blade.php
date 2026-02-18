@extends('layouts.admin')

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

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">YouTube відео</label>
                <input type="url" name="youtube_url" value="{{ old('youtube_url', $product->youtube_url) }}"
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                    placeholder="https://www.youtube.com/watch?v=...">
                <small style="color:var(--muted);margin-top:4px;display:block;">Вставте посилання на YouTube відео</small>
                @error('youtube_url')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Колір товару</label>
                <input type="text" name="color" value="{{ old('color', $product->color) }}"
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                    placeholder="Чорний, Зелений, Tan, Coyote...">
                <small style="color:var(--muted);margin-top:4px;display:block;">Колір для варіацій товару (якщо є)</small>
                @error('color')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Варіації товару (інші кольори)</label>
                <div style="margin-bottom:10px;">
                    <input type="text" id="variationSearch" placeholder="Знайти варіацію за назвою або SKU..."
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:14px;">
                    <div id="variationSearchResults" style="display:none;max-height:240px;overflow-y:auto;margin-top:8px;
                        border:1px solid rgba(255,255,255,.14);border-radius:14px;background:rgba(0,0,0,.18);"></div>
                </div>
                <div id="selectedVariations" style="display:grid;gap:8px;margin-bottom:10px;">
                    @foreach($product->variations as $variation)
                    <div class="selected-variation" data-id="{{ $variation->id }}" style="display:flex;justify-content:space-between;align-items:center;
                        padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.05);">
                        <div>
                            <b style="font-size:13.5px;">{{ $variation->name }}</b>
                            @if($variation->color)
                                <span style="margin-left:8px;padding:3px 8px;border-radius:8px;background:rgba(88,255,122,.14);
                                    color:rgba(255,255,255,.85);font-size:11px;font-weight:700;">{{ $variation->color }}</span>
                            @endif
                            <div style="color:var(--muted);font-size:12px;margin-top:2px;">SKU: {{ $variation->sku }} • {{ number_format($variation->price, 0, '', ' ') }} грн</div>
                        </div>
                        <button type="button" class="remove-variation" data-id="{{ $variation->id }}"
                            style="padding:6px 10px;border-radius:10px;border:1px solid rgba(255,77,77,.3);
                            background:rgba(255,77,77,.1);color:rgba(255,77,77,.95);cursor:pointer;font-size:12px;font-weight:700;">
                            Видалити
                        </button>
                        <input type="hidden" name="variations[]" value="{{ $variation->id }}">
                    </div>
                    @endforeach
                </div>
                <small style="color:var(--muted);display:block;">Оберіть товари, які є варіаціями цього (наприклад, інші кольори)</small>
                @error('variations')
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

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Характеристики товару</label>
                <div id="specsContainer" style="display:grid;gap:8px;margin-bottom:10px;">
                    @php
                        $specs = old('specs', $product->specs ?? []);
                        if(is_string($specs)) {
                            $specs = json_decode($specs, true) ?: [];
                        }
                    @endphp
                    @if(!empty($specs))
                        @foreach($specs as $key => $value)
                        <div class="spec-row" style="display:grid;grid-template-columns:1fr 1fr auto;gap:8px;align-items:start;">
                            <input type="text" class="spec-key" value="{{ $key }}" placeholder="Назва характеристики"
                                style="padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);
                                background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;">
                            <input type="text" class="spec-value" value="{{ $value }}" placeholder="Значення"
                                style="padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);
                                background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;">
                            <button type="button" class="remove-spec btn small danger">✕</button>
                        </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" id="addSpec" class="btn small">+ Додати характеристику</button>
                <input type="hidden" name="specs" id="specsJson">
                <small style="color:var(--muted);margin-top:6px;display:block;">Технічні характеристики товару</small>
                @error('specs')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Пакети для тюнінгу</label>
                <div id="tuningKitsContainer" style="display:grid;gap:12px;margin-bottom:10px;">
                    @php
                        $tuningKits = old('tuning_kits', $product->tuning_kits ?? []);
                        if(is_string($tuningKits)) {
                            $tuningKits = json_decode($tuningKits, true) ?: [];
                        }
                    @endphp
                    @if(!empty($tuningKits))
                        @foreach($tuningKits as $index => $kit)
                        <div class="tuning-kit" style="padding:14px;border-radius:14px;border:1px solid rgba(255,255,255,.12);
                            background:rgba(255,255,255,.04);">
                            <div style="display:grid;grid-template-columns:1fr auto;gap:8px;margin-bottom:10px;">
                                <input type="text" class="kit-name" value="{{ $kit['name'] ?? '' }}" placeholder="Назва пакету"
                                    style="padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);
                                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;">
                                <button type="button" class="remove-kit btn small danger">✕ Видалити пакет</button>
                            </div>
                            <div style="display:grid;grid-template-columns:1fr;gap:8px;margin-bottom:10px;">
                                <input type="number" class="kit-price" value="{{ $kit['price'] ?? '' }}" placeholder="Ціна (грн)"
                                    style="padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);
                                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;">
                            </div>
                            <div style="margin-bottom:6px;font-size:13px;font-weight:700;color:var(--muted);">Роботи:</div>
                            <div class="kit-items" style="display:grid;gap:6px;margin-bottom:8px;">
                                @if(!empty($kit['items']))
                                    @foreach($kit['items'] as $item)
                                    <div style="display:grid;grid-template-columns:1fr auto;gap:8px;">
                                        <input type="text" class="kit-item" value="{{ $item }}" placeholder="Назва роботи"
                                            style="padding:8px 12px;border-radius:10px;border:1px solid rgba(255,255,255,.14);
                                            background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;">
                                        <button type="button" class="remove-kit-item btn small danger" style="padding:6px 10px;">✕</button>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="add-kit-item btn small" style="font-size:12px;">+ Додати роботу</button>
                        </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" id="addTuningKit" class="btn small">+ Додати пакет тюнінгу</button>
                <input type="hidden" name="tuning_kits" id="tuningKitsJson">
                <small style="color:var(--muted);margin-top:6px;display:block;">Пакети послуг з налаштування та апгрейду</small>
                @error('tuning_kits')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Рекомендовані товари</label>
                <div style="margin-bottom:10px;">
                    <input type="text" id="productSearch" placeholder="Почніть вводити назву товару..."
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:14px;">
                    <div id="searchResults" style="display:none;max-height:240px;overflow-y:auto;margin-top:8px;
                        border:1px solid rgba(255,255,255,.14);border-radius:14px;background:rgba(0,0,0,.18);"></div>
                </div>
                <div id="selectedProducts" style="display:grid;gap:8px;margin-bottom:10px;">
                    @foreach($product->recommended as $rec)
                    <div class="selected-product" data-id="{{ $rec->id }}" style="display:flex;justify-content:space-between;align-items:center;
                        padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.05);">
                        <div>
                            <b style="font-size:13.5px;">{{ $rec->name }}</b>
                            <div style="color:var(--muted);font-size:12px;margin-top:2px;">{{ number_format($rec->price, 0, '', ' ') }} грн</div>
                        </div>
                        <button type="button" class="remove-product" data-id="{{ $rec->id }}"
                            style="padding:6px 10px;border-radius:10px;border:1px solid rgba(255,77,77,.3);
                            background:rgba(255,77,77,.1);color:rgba(255,77,77,.95);cursor:pointer;font-size:12px;font-weight:700;">
                            Видалити
                        </button>
                        <input type="hidden" name="recommended_products[]" value="{{ $rec->id }}">
                    </div>
                    @endforeach
                </div>
                <small style="color:var(--muted);display:block;">Використовуйте пошук вище щоб додати товари</small>
                @error('recommended_products')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <script>
            (function(){
                const searchInput = document.getElementById('productSearch');
                const searchResults = document.getElementById('searchResults');
                const selectedContainer = document.getElementById('selectedProducts');
                const currentProductId = {{ $product->id }};
                let searchTimeout = null;
                let selectedIds = [{{ $product->recommended->pluck('id')->implode(',') }}];

                searchInput.addEventListener('input', (e) => {
                    clearTimeout(searchTimeout);
                    const query = e.target.value.trim();

                    if(query.length < 2){
                        searchResults.style.display = 'none';
                        return;
                    }

                    searchTimeout = setTimeout(() => {
                        fetch(`/admin/products/search?q=${encodeURIComponent(query)}&exclude=${currentProductId}`)
                            .then(r => r.json())
                            .then(data => {
                                if(data.length === 0){
                                    searchResults.innerHTML = '<div style="padding:12px;color:var(--muted);font-size:13px;">Нічого не знайдено</div>';
                                    searchResults.style.display = 'block';
                                    return;
                                }

                                searchResults.innerHTML = data.map(p => `
                                    <div class="search-result-item" data-id="${p.id}" data-name="${p.name}" data-price="${p.price}"
                                        style="padding:10px 12px;border-bottom:1px solid rgba(255,255,255,.08);cursor:pointer;
                                        ${selectedIds.includes(p.id) ? 'opacity:0.4;pointer-events:none;' : ''}">
                                        <b style="font-size:13.5px;">${p.name}</b>
                                        <div style="color:var(--muted);font-size:12px;margin-top:2px;">${p.price.toLocaleString('uk-UA')} грн • SKU: ${p.sku}</div>
                                    </div>
                                `).join('');
                                searchResults.style.display = 'block';

                                // Add click handlers
                                searchResults.querySelectorAll('.search-result-item').forEach(item => {
                                    item.addEventListener('click', () => {
                                        const id = parseInt(item.dataset.id);
                                        const name = item.dataset.name;
                                        const price = parseFloat(item.dataset.price);
                                        addSelectedProduct(id, name, price);
                                        searchInput.value = '';
                                        searchResults.style.display = 'none';
                                    });
                                });
                            })
                            .catch(err => console.error('Search error:', err));
                    }, 300);
                });

                function addSelectedProduct(id, name, price){
                    if(selectedIds.includes(id)) return;
                    selectedIds.push(id);

                    const div = document.createElement('div');
                    div.className = 'selected-product';
                    div.dataset.id = id;
                    div.style.cssText = 'display:flex;justify-content:space-between;align-items:center;padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.05);';
                    div.innerHTML = `
                        <div>
                            <b style="font-size:13.5px;">${name}</b>
                            <div style="color:var(--muted);font-size:12px;margin-top:2px;">${price.toLocaleString('uk-UA')} грн</div>
                        </div>
                        <button type="button" class="remove-product" data-id="${id}"
                            style="padding:6px 10px;border-radius:10px;border:1px solid rgba(255,77,77,.3);
                            background:rgba(255,77,77,.1);color:rgba(255,77,77,.95);cursor:pointer;font-size:12px;font-weight:700;">
                            Видалити
                        </button>
                        <input type="hidden" name="recommended_products[]" value="${id}">
                    `;

                    div.querySelector('.remove-product').addEventListener('click', () => {
                        selectedIds = selectedIds.filter(sid => sid !== id);
                        div.remove();
                    });

                    selectedContainer.appendChild(div);
                }

                // Existing remove buttons
                document.querySelectorAll('.remove-product').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const id = parseInt(btn.dataset.id);
                        selectedIds = selectedIds.filter(sid => sid !== id);
                        btn.closest('.selected-product').remove();
                    });
                });

                // Close search results when clicking outside
                document.addEventListener('click', (e) => {
                    if(!searchInput.contains(e.target) && !searchResults.contains(e.target)){
                        searchResults.style.display = 'none';
                    }
                });
            })();

            // Specs handling
            (function(){
                const specsContainer = document.getElementById('specsContainer');
                const addSpecBtn = document.getElementById('addSpec');
                const specsJson = document.getElementById('specsJson');

                function createSpecRow(key = '', value = ''){
                    const div = document.createElement('div');
                    div.className = 'spec-row';
                    div.style.cssText = 'display:grid;grid-template-columns:1fr 1fr auto;gap:8px;align-items:start;';
                    div.innerHTML = `
                        <input type="text" class="spec-key" value="${key}" placeholder="Назва характеристики"
                            style="padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);
                            background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;">
                        <input type="text" class="spec-value" value="${value}" placeholder="Значення"
                            style="padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);
                            background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;">
                        <button type="button" class="remove-spec btn small danger">✕</button>
                    `;
                    div.querySelector('.remove-spec').addEventListener('click', () => div.remove());
                    return div;
                }

                addSpecBtn.addEventListener('click', () => {
                    specsContainer.appendChild(createSpecRow());
                });

                document.querySelectorAll('.remove-spec').forEach(btn => {
                    btn.addEventListener('click', () => btn.closest('.spec-row').remove());
                });

                // Convert to JSON on form submit
                document.querySelector('form').addEventListener('submit', (e) => {
                    const specs = {};
                    document.querySelectorAll('.spec-row').forEach(row => {
                        const key = row.querySelector('.spec-key').value.trim();
                        const value = row.querySelector('.spec-value').value.trim();
                        if(key && value) specs[key] = value;
                    });
                    specsJson.value = Object.keys(specs).length > 0 ? JSON.stringify(specs) : '';
                });
            })();

            // Tuning kits handling
            (function(){
                const tuningKitsContainer = document.getElementById('tuningKitsContainer');
                const addTuningKitBtn = document.getElementById('addTuningKit');
                const tuningKitsJson = document.getElementById('tuningKitsJson');

                function createKitItemRow(value = ''){
                    const div = document.createElement('div');
                    div.style.cssText = 'display:grid;grid-template-columns:1fr auto;gap:8px;';
                    div.innerHTML = `
                        <input type="text" class="kit-item" value="${value}" placeholder="Назва роботи"
                            style="padding:8px 12px;border-radius:10px;border:1px solid rgba(255,255,255,.14);
                            background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;">
                        <button type="button" class="remove-kit-item btn small danger" style="padding:6px 10px;">✕</button>
                    `;
                    div.querySelector('.remove-kit-item').addEventListener('click', () => div.remove());
                    return div;
                }

                function createTuningKit(name = '', price = '', items = []){
                    const div = document.createElement('div');
                    div.className = 'tuning-kit';
                    div.style.cssText = 'padding:14px;border-radius:14px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.04);';

                    const itemsHtml = items.map(item => `
                        <div style="display:grid;grid-template-columns:1fr auto;gap:8px;">
                            <input type="text" class="kit-item" value="${item}" placeholder="Назва роботи"
                                style="padding:8px 12px;border-radius:10px;border:1px solid rgba(255,255,255,.14);
                                background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;">
                            <button type="button" class="remove-kit-item btn small danger" style="padding:6px 10px;">✕</button>
                        </div>
                    `).join('');

                    div.innerHTML = `
                        <div style="display:grid;grid-template-columns:1fr auto;gap:8px;margin-bottom:10px;">
                            <input type="text" class="kit-name" value="${name}" placeholder="Назва пакету"
                                style="padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);
                                background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;">
                            <button type="button" class="remove-kit btn small danger">✕ Видалити пакет</button>
                        </div>
                        <div style="display:grid;grid-template-columns:1fr;gap:8px;margin-bottom:10px;">
                            <input type="number" class="kit-price" value="${price}" placeholder="Ціна (грн)"
                                style="padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);
                                background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:13px;">
                        </div>
                        <div style="margin-bottom:6px;font-size:13px;font-weight:700;color:var(--muted);">Роботи:</div>
                        <div class="kit-items" style="display:grid;gap:6px;margin-bottom:8px;">
                            ${itemsHtml}
                        </div>
                        <button type="button" class="add-kit-item btn small" style="font-size:12px;">+ Додати роботу</button>
                    `;

                    div.querySelector('.remove-kit').addEventListener('click', () => div.remove());
                    div.querySelector('.add-kit-item').addEventListener('click', () => {
                        div.querySelector('.kit-items').appendChild(createKitItemRow());
                    });
                    div.querySelectorAll('.remove-kit-item').forEach(btn => {
                        btn.addEventListener('click', () => btn.closest('div').remove());
                    });

                    return div;
                }

                addTuningKitBtn.addEventListener('click', () => {
                    tuningKitsContainer.appendChild(createTuningKit());
                });

                document.querySelectorAll('.remove-kit').forEach(btn => {
                    btn.addEventListener('click', () => btn.closest('.tuning-kit').remove());
                });

                document.querySelectorAll('.add-kit-item').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const kit = e.target.closest('.tuning-kit');
                        kit.querySelector('.kit-items').appendChild(createKitItemRow());
                    });
                });

                document.querySelectorAll('.remove-kit-item').forEach(btn => {
                    btn.addEventListener('click', () => btn.closest('div').remove());
                });

                // Convert to JSON on form submit
                document.querySelector('form').addEventListener('submit', (e) => {
                    const kits = [];
                    document.querySelectorAll('.tuning-kit').forEach(kitDiv => {
                        const name = kitDiv.querySelector('.kit-name').value.trim();
                        const price = parseFloat(kitDiv.querySelector('.kit-price').value) || 0;
                        const items = [];
                        kitDiv.querySelectorAll('.kit-item').forEach(input => {
                            const val = input.value.trim();
                            if(val) items.push(val);
                        });
                        if(name && items.length > 0) {
                            kits.push({ name, price, items });
                        }
                    });
                    tuningKitsJson.value = kits.length > 0 ? JSON.stringify(kits) : '';
                });
            })();

            // Variations handling
            (function(){
                const variationSearch = document.getElementById('variationSearch');
                const variationResults = document.getElementById('variationSearchResults');
                const selectedVariationsContainer = document.getElementById('selectedVariations');
                const currentProductId = {{ $product->id }};
                let searchTimeout = null;
                let selectedVariationIds = [{{ $product->variations->pluck('id')->implode(',') }}];

                variationSearch.addEventListener('input', (e) => {
                    clearTimeout(searchTimeout);
                    const query = e.target.value.trim();

                    if(query.length < 2){
                        variationResults.style.display = 'none';
                        return;
                    }

                    searchTimeout = setTimeout(() => {
                        fetch(`/admin/products/search?q=${encodeURIComponent(query)}&exclude=${currentProductId}`)
                            .then(r => r.json())
                            .then(data => {
                                if(data.length === 0){
                                    variationResults.innerHTML = '<div style="padding:12px;color:var(--muted);font-size:13px;">Нічого не знайдено</div>';
                                    variationResults.style.display = 'block';
                                    return;
                                }

                                variationResults.innerHTML = data.map(p => `
                                    <div class="variation-result-item" data-id="${p.id}" data-name="${p.name}" data-sku="${p.sku}" data-price="${p.price}"
                                        style="padding:10px 12px;border-bottom:1px solid rgba(255,255,255,.08);cursor:pointer;
                                        ${selectedVariationIds.includes(p.id) ? 'opacity:0.4;pointer-events:none;' : ''}">
                                        <b style="font-size:13.5px;">${p.name}</b>
                                        <div style="color:var(--muted);font-size:12px;margin-top:2px;">${p.price.toLocaleString('uk-UA')} грн • SKU: ${p.sku}</div>
                                    </div>
                                `).join('');
                                variationResults.style.display = 'block';

                                variationResults.querySelectorAll('.variation-result-item').forEach(item => {
                                    item.addEventListener('click', () => {
                                        const id = parseInt(item.dataset.id);
                                        const name = item.dataset.name;
                                        const sku = item.dataset.sku;
                                        const price = parseFloat(item.dataset.price);
                                        addSelectedVariation(id, name, sku, price);
                                        variationSearch.value = '';
                                        variationResults.style.display = 'none';
                                    });
                                });
                            })
                            .catch(err => console.error('Search error:', err));
                    }, 300);
                });

                function addSelectedVariation(id, name, sku, price){
                    if(selectedVariationIds.includes(id)) return;
                    selectedVariationIds.push(id);

                    const div = document.createElement('div');
                    div.className = 'selected-variation';
                    div.dataset.id = id;
                    div.style.cssText = 'display:flex;justify-content:space-between;align-items:center;padding:10px 12px;border-radius:12px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.05);';
                    div.innerHTML = `
                        <div>
                            <b style="font-size:13.5px;">${name}</b>
                            <div style="color:var(--muted);font-size:12px;margin-top:2px;">SKU: ${sku} • ${price.toLocaleString('uk-UA')} грн</div>
                        </div>
                        <button type="button" class="remove-variation" data-id="${id}"
                            style="padding:6px 10px;border-radius:10px;border:1px solid rgba(255,77,77,.3);
                            background:rgba(255,77,77,.1);color:rgba(255,77,77,.95);cursor:pointer;font-size:12px;font-weight:700;">
                            Видалити
                        </button>
                        <input type="hidden" name="variations[]" value="${id}">
                    `;

                    div.querySelector('.remove-variation').addEventListener('click', () => {
                        selectedVariationIds = selectedVariationIds.filter(vid => vid !== id);
                        div.remove();
                    });

                    selectedVariationsContainer.appendChild(div);
                }

                document.querySelectorAll('.remove-variation').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const id = parseInt(btn.dataset.id);
                        selectedVariationIds = selectedVariationIds.filter(vid => vid !== id);
                        btn.closest('.selected-variation').remove();
                    });
                });

                document.addEventListener('click', (e) => {
                    if(!variationSearch.contains(e.target) && !variationResults.contains(e.target)){
                        variationResults.style.display = 'none';
                    }
                });
            })();
            </script>

            <div style="margin-bottom:20px;padding:20px;border-radius:16px;border:1px solid rgba(56,189,248,.25);background:rgba(56,189,248,.06);">
                <h3 style="margin:0 0 16px;display:flex;align-items:center;gap:10px;">
                    <span style="font-size:20px;">🔍</span>
                    <span>SEO налаштування</span>
                </h3>

                <div style="display:grid;gap:16px;">
                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Meta заголовок</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title ?? '') }}"
                            style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                            background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                            placeholder="Якщо порожнє, буде використано назву товару">
                        <small style="color:var(--muted);margin-top:4px;display:block;">Рекомендовано: 50-60 символів</small>
                        @error('meta_title')
                            <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Meta опис</label>
                        <textarea name="meta_description" rows="3"
                            style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                            background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;resize:vertical;"
                            placeholder="Якщо порожнє, буде використано короткий опис товару">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                        <small style="color:var(--muted);margin-top:4px;display:block;">Рекомендовано: 150-160 символів</small>
                        @error('meta_description')
                            <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Ключові слова</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords ?? '') }}"
                            style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                            background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                            placeholder="airsoft, страйкбол, автомат, привод">
                        <small style="color:var(--muted);margin-top:4px;display:block;">Ключові слова через кому</small>
                        @error('meta_keywords')
                            <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
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
