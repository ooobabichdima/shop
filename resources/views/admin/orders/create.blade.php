@extends('layouts.admin')

@section('title', 'Створити замовлення - Адмін')

@section('content')
<div style="padding:20px 0;">
    <div style="margin-bottom:30px;">
        <a href="{{ route('admin.orders.index') }}" class="btn small" style="margin-bottom:16px;">
            ← Назад до списку
        </a>
        <h1 style="margin:0;">Створити замовлення</h1>
    </div>

    @if($errors->any())
        <div style="padding:14px 16px; border-radius:14px; margin-bottom:16px; background:rgba(255,77,77,.1); border:1px solid rgba(255,77,77,.3); color:rgba(255,77,77,.95);">
            <div style="font-weight:700;margin-bottom:8px;">Помилки валідації:</div>
            <ul style="margin:0;padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.orders.store') }}">
        @csrf

        <!-- Інформація про клієнта -->
        <div class="card" style="padding:24px;margin-bottom:20px;">
            <h2 style="margin:0 0 20px;display:flex;align-items:center;gap:10px;">
                <span style="font-size:24px;">👤</span>
                <span>Інформація про клієнта</span>
            </h2>

            <div style="display:grid;gap:16px;">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Ім'я клієнта *</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                        placeholder="Іванов Іван Іванович">
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Телефон *</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required
                            style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                            background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                            placeholder="+380501234567">
                    </div>

                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                            background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                            placeholder="email@example.com">
                    </div>
                </div>
            </div>
        </div>

        <!-- Доставка -->
        <div class="card" style="padding:24px;margin-bottom:20px;">
            <h2 style="margin:0 0 20px;display:flex;align-items:center;gap:10px;">
                <span style="font-size:24px;">🚚</span>
                <span>Доставка</span>
            </h2>

            <div style="display:grid;gap:16px;">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Служба доставки *</label>
                    <select name="shipping_provider" required
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;">
                        <option value="">Оберіть службу</option>
                        <option value="novaposhta" {{ old('shipping_provider') == 'novaposhta' ? 'selected' : '' }}>Нова Пошта</option>
                        <option value="ukrposhta" {{ old('shipping_provider') == 'ukrposhta' ? 'selected' : '' }}>Укрпошта</option>
                        <option value="meest" {{ old('shipping_provider') == 'meest' ? 'selected' : '' }}>Meest</option>
                        <option value="courier" {{ old('shipping_provider') == 'courier' ? 'selected' : '' }}>Кур'єр</option>
                    </select>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Місто *</label>
                        <input type="text" name="shipping_city" value="{{ old('shipping_city') }}" required
                            style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                            background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                            placeholder="Київ">
                    </div>

                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Номер відділення</label>
                        <input type="text" name="shipping_ref" value="{{ old('shipping_ref') }}"
                            style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                            background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                            placeholder="№ 1">
                    </div>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Адреса (для кур'єра)</label>
                    <input type="text" name="shipping_address" value="{{ old('shipping_address') }}"
                        style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                        placeholder="вул. Хрещатик, буд. 1, кв. 1">
                </div>
            </div>
        </div>

        <!-- Товари -->
        <div class="card" style="padding:24px;margin-bottom:20px;">
            <h2 style="margin:0 0 20px;display:flex;align-items:center;gap:10px;">
                <span style="font-size:24px;">🛒</span>
                <span>Товари</span>
            </h2>

            <div style="margin-bottom:16px;position:relative;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Пошук товару</label>
                <input type="text" id="productSearch"
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                    placeholder="Введіть назву або SKU товару...">
                <div id="searchResults" style="display:none;position:absolute;top:100%;left:0;right:0;z-index:100;
                    background:rgba(10,14,20,.98);border:1px solid rgba(255,255,255,.14);border-radius:14px;
                    margin-top:8px;max-height:300px;overflow-y:auto;box-shadow:0 10px 40px rgba(0,0,0,.5);"></div>
            </div>

            <div id="selectedProducts" style="display:grid;gap:12px;margin-bottom:16px;"></div>

            <div id="emptyState" style="text-align:center;padding:40px 20px;border:2px dashed rgba(255,255,255,.1);border-radius:14px;">
                <div style="font-size:48px;margin-bottom:12px;opacity:.3;">📦</div>
                <p style="color:var(--muted);margin:0;">Додайте товари за допомогою пошуку вище</p>
            </div>

            <div style="margin-top:20px;padding:16px;border-radius:14px;background:rgba(56,189,248,.1);border:1px solid rgba(56,189,248,.3);">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-weight:700;color:rgba(56,189,248,.95);">Всього до сплати:</span>
                    <span id="totalAmount" style="font-size:24px;font-weight:900;color:var(--text);">0 грн</span>
                </div>
            </div>
        </div>

        <!-- Коментар -->
        <div class="card" style="padding:24px;margin-bottom:20px;">
            <h2 style="margin:0 0 20px;">Коментар до замовлення</h2>
            <textarea name="comment" rows="4"
                style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;resize:vertical;"
                placeholder="Додаткова інформація про замовлення...">{{ old('comment') }}</textarea>
        </div>

        <div style="display:flex;gap:12px;">
            <button type="submit" class="btn primary">
                ✓ Створити замовлення
            </button>
            <a href="{{ route('admin.orders.index') }}" class="btn">
                Скасувати
            </a>
        </div>
    </form>
</div>

<script>
(function(){
    const searchInput = document.getElementById('productSearch');
    const searchResults = document.getElementById('searchResults');
    const selectedProductsContainer = document.getElementById('selectedProducts');
    const emptyState = document.getElementById('emptyState');
    const totalAmountEl = document.getElementById('totalAmount');
    let searchTimeout = null;
    let selectedProducts = [];

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
                        <div class="search-result-item" data-id="${p.id}" data-name="${p.name}" data-price="${p.price}" data-sku="${p.sku}"
                            style="padding:12px 14px;border-bottom:1px solid rgba(255,255,255,.08);cursor:pointer;
                            transition:background .15s ease;">
                            <b style="font-size:14px;">${p.name}</b>
                            <div style="color:var(--muted);font-size:12px;margin-top:4px;">
                                SKU: ${p.sku} • ${p.price.toLocaleString('uk-UA')} грн
                            </div>
                        </div>
                    `).join('');
                    searchResults.style.display = 'block';

                    searchResults.querySelectorAll('.search-result-item').forEach(item => {
                        item.addEventListener('mouseenter', (e) => {
                            e.target.style.background = 'rgba(255,255,255,.06)';
                        });
                        item.addEventListener('mouseleave', (e) => {
                            e.target.style.background = 'transparent';
                        });
                        item.addEventListener('click', () => {
                            const id = parseInt(item.dataset.id);
                            const name = item.dataset.name;
                            const price = parseFloat(item.dataset.price);
                            const sku = item.dataset.sku;
                            addProduct(id, name, price, sku);
                            searchInput.value = '';
                            searchResults.style.display = 'none';
                        });
                    });
                })
                .catch(err => console.error('Search error:', err));
        }, 300);
    });

    function addProduct(id, name, price, sku){
        const existing = selectedProducts.find(p => p.id === id);
        if(existing){
            existing.quantity++;
            updateProductRow(existing);
        } else {
            const product = { id, name, price, sku, quantity: 1 };
            selectedProducts.push(product);
            createProductRow(product);
        }
        updateEmptyState();
        updateTotal();
    }

    function createProductRow(product){
        const div = document.createElement('div');
        div.className = 'product-row';
        div.dataset.id = product.id;
        div.style.cssText = 'padding:14px;border-radius:14px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.05);';
        div.innerHTML = `
            <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;">
                <div style="flex:1;">
                    <div style="font-weight:700;margin-bottom:4px;">${product.name}</div>
                    <div style="color:var(--muted);font-size:12px;">SKU: ${product.sku} • ${product.price.toLocaleString('uk-UA')} грн/шт</div>
                </div>
                <div style="display:flex;align-items:center;gap:10px;">
                    <button type="button" class="qty-btn qty-minus" style="width:32px;height:32px;border-radius:8px;
                        border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);
                        cursor:pointer;font-weight:900;font-size:16px;">−</button>
                    <input type="number" class="qty-input" value="${product.quantity}" min="1"
                        style="width:60px;text-align:center;padding:8px;border-radius:8px;border:1px solid rgba(255,255,255,.14);
                        background:rgba(0,0,0,.18);color:var(--text);font-weight:700;">
                    <button type="button" class="qty-btn qty-plus" style="width:32px;height:32px;border-radius:8px;
                        border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);
                        cursor:pointer;font-weight:900;font-size:16px;">+</button>
                    <div class="item-total" style="min-width:100px;text-align:right;font-weight:900;font-size:16px;">
                        ${(product.price * product.quantity).toLocaleString('uk-UA')} грн
                    </div>
                    <button type="button" class="remove-btn" style="width:32px;height:32px;border-radius:8px;
                        border:1px solid rgba(255,77,77,.3);background:rgba(255,77,77,.1);color:rgba(255,77,77,.95);
                        cursor:pointer;font-weight:900;">✕</button>
                </div>
            </div>
            <input type="hidden" name="products[${product.id}][id]" value="${product.id}">
            <input type="hidden" name="products[${product.id}][quantity]" class="hidden-qty" value="${product.quantity}">
        `;

        div.querySelector('.qty-minus').addEventListener('click', () => {
            if(product.quantity > 1){
                product.quantity--;
                updateProductRow(product);
            }
        });

        div.querySelector('.qty-plus').addEventListener('click', () => {
            product.quantity++;
            updateProductRow(product);
        });

        div.querySelector('.qty-input').addEventListener('change', (e) => {
            const val = parseInt(e.target.value) || 1;
            product.quantity = Math.max(1, val);
            updateProductRow(product);
        });

        div.querySelector('.remove-btn').addEventListener('click', () => {
            selectedProducts = selectedProducts.filter(p => p.id !== product.id);
            div.remove();
            updateEmptyState();
            updateTotal();
        });

        selectedProductsContainer.appendChild(div);
    }

    function updateProductRow(product){
        const row = document.querySelector(`.product-row[data-id="${product.id}"]`);
        if(!row) return;

        row.querySelector('.qty-input').value = product.quantity;
        row.querySelector('.hidden-qty').value = product.quantity;
        row.querySelector('.item-total').textContent = (product.price * product.quantity).toLocaleString('uk-UA') + ' грн';
        updateTotal();
    }

    function updateEmptyState(){
        emptyState.style.display = selectedProducts.length > 0 ? 'none' : 'block';
    }

    function updateTotal(){
        const total = selectedProducts.reduce((sum, p) => sum + (p.price * p.quantity), 0);
        totalAmountEl.textContent = total.toLocaleString('uk-UA') + ' грн';
    }

    document.addEventListener('click', (e) => {
        if(!searchInput.contains(e.target) && !searchResults.contains(e.target)){
            searchResults.style.display = 'none';
        }
    });
})();
</script>
@endsection
