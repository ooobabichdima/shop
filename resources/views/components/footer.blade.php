<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="row" style="gap:10px; margin-bottom:10px;">
                    <span class="logo" aria-hidden="true">
                        <svg class="ico18" viewBox="0 0 24 24" fill="none">
                            <path d="M12 3c4.8 0 9 3.6 9 9s-4.2 9-9 9-9-3.6-9-9 4.2-9 9-9Z" stroke="#04140a" stroke-width="2"/>
                            <path d="M12 7c2.8 0 5 2.2 5 5s-2.2 5-5 5-5-2.2-5-5 2.2-5 5-5Z" stroke="#04140a" stroke-width="2"/>
                        </svg>
                    </span>
                    <div>
                        <b>Strikeball Shop</b><br/>
                        <small class="muted">Доставка • Гарантія • Сервіс</small>
                    </div>
                </div>
                <p style="margin:0; color:var(--muted); font-size:13px; max-width:60ch;">
                    Інтернет-магазин страйкбольного обладнання. Приводи, магазини, кулі, захист, оптика. Доставка по Україні, гарантія, допомога з підбором.
                </p>
            </div>

            <div>
                <h5>Каталог</h5>
                <a href="{{ route('catalog') }}">Всі категорії</a>
                @php
                    $footerCategories = \App\Models\Category::whereNull('parent_id')->orderBy('sort_order')->take(5)->get();
                @endphp
                @foreach($footerCategories as $category)
                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                @endforeach
                <a href="{{ route('used-market') }}">Б/У ринок</a>
            </div>

            <div>
                <h5>Покупцям</h5>
                <a href="{{ route('delivery') }}">Доставка</a>
                <a href="{{ route('payment') }}">Оплата</a>
                <a href="{{ route('warranty') }}">Гарантія</a>
                <a href="{{ route('returns') }}">Повернення</a>
            </div>

            <div>
                <h5>Компанія</h5>
                <a href="{{ route('about') }}">Про нас</a>
                <a href="{{ route('contacts') }}">Контакти</a>
                <a href="{{ route('offer') }}">Публічна оферта</a>
                <a href="{{ route('privacy') }}">Політика конфіденційності</a>
            </div>
        </div>

        <div class="copyright">
            <div>© {{ date('Y') }} Strikeball Shop. Всі права захищені.</div>
            <div>Laravel {{ app()->version() }}</div>
        </div>
    </div>
</footer>
