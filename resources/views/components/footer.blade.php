<footer class="footer">
    <div class="container">
        <div class="footer-main">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="flex" style="gap:12px;">
                        <div class="brand-mark" style="width:36px;height:36px;font-size:16px;border-radius:8px;">SS</div>
                        <div>
                            <div style="font-weight:800;font-size:16px;">Strikeball Shop</div>
                            <div style="font-size:11px;color:var(--text3);text-transform:uppercase;letter-spacing:.06em;font-weight:500;">Airsoft Store</div>
                        </div>
                    </div>
                    <p>
                        Інтернет-магазин страйкбольного обладнання. Приводи, магазини, кулі, захист, оптика. Доставка по Україні, гарантія, допомога з підбором.
                    </p>
                    <div style="margin-top:20px;display:flex;gap:8px;">
                        <a href="https://t.me/strikeballshop" target="_blank" rel="noopener" class="btn btn-icon btn-sm" aria-label="Telegram" style="width:36px;height:36px;padding:0;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M21.2 4.4L2.4 11.1c-.6.2-.6.6 0 .8l4.7 1.5 1.8 5.8c.2.5.7.5 1 .2l2.6-2.4 5 3.7c.6.4 1 .2 1.2-.5L22.2 5.5c.3-1-.3-1.4-1-1.1z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                        </a>
                        <a href="https://instagram.com/strikeballshop" target="_blank" rel="noopener" class="btn btn-icon btn-sm" aria-label="Instagram" style="width:36px;height:36px;padding:0;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><rect x="2" y="2" width="20" height="20" rx="5" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="1.5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor"/></svg>
                        </a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Каталог</h4>
                    <a href="{{ route('catalog') }}">Всі категорії</a>
                    @php
                        $footerCategories = \App\Models\Category::whereNull('parent_id')->orderBy('sort_order')->take(5)->get();
                    @endphp
                    @foreach($footerCategories as $category)
                        <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                    @endforeach
                    <a href="{{ route('used-market') }}">Б/У ринок</a>
                </div>

                <div class="footer-col">
                    <h4>Покупцям</h4>
                    <a href="{{ route('delivery') }}">Доставка</a>
                    <a href="{{ route('payment') }}">Оплата</a>
                    <a href="{{ route('warranty') }}">Гарантія</a>
                    <a href="{{ route('returns') }}">Повернення та обмін</a>
                </div>

                <div class="footer-col">
                    <h4>Компанія</h4>
                    <a href="{{ route('about') }}">Про нас</a>
                    <a href="{{ route('contacts') }}">Контакти</a>
                    <a href="{{ route('offer') }}">Публічна оферта</a>
                    <a href="{{ route('privacy') }}">Конфіденційність</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div>&copy; {{ date('Y') }} Strikeball Shop. Всі права захищені.</div>
            <div style="display:flex;gap:16px;">
                <span>Visa</span>
                <span>Mastercard</span>
                <span>Нова Пошта</span>
            </div>
        </div>
    </div>
</footer>
