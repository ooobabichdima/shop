@extends('layouts.admin')

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
                <label style="display:block;margin-bottom:8px;font-weight:700;">Характеристики товару</label>
                <div id="specsContainer" style="display:grid;gap:8px;margin-bottom:10px;">
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
                <div id="selectedProducts" style="display:grid;gap:8px;margin-bottom:10px;"></div>
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
                let searchTimeout = null;
                let selectedIds = [];

                searchInput.addEventListener('input', (e) => {
                    clearTimeout(searchTimeout);
                    const query = e.target.value.trim();

                    if(query.length < 2){
                        searchResults.style.display = 'none';
                        return;
                    }

                    searchTimeout = setTimeout(() => {
                        fetch(`/admin/products/search?q=${encodeURIComponent(query)}`)
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
                        <div class="kit-items" style="display:grid;gap:6px;margin-bottom:8px;"></div>
                        <button type="button" class="add-kit-item btn small" style="font-size:12px;">+ Додати роботу</button>
                    `;

                    div.querySelector('.remove-kit').addEventListener('click', () => div.remove());
                    div.querySelector('.add-kit-item').addEventListener('click', () => {
                        div.querySelector('.kit-items').appendChild(createKitItemRow());
                    });

                    return div;
                }

                addTuningKitBtn.addEventListener('click', () => {
                    tuningKitsContainer.appendChild(createTuningKit());
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
            </script>

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
