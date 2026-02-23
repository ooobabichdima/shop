{{-- Top utility bar --}}
<div class="toputil">
    <div class="container">
        <div class="toputil-inner">
            <div class="toputil-links">
                <a href="{{ route('delivery') }}">Доставка</a>
                <a href="{{ route('payment') }}">Оплата</a>
                <a href="{{ route('warranty') }}">Гарантія</a>
                <a href="{{ route('about') }}">Про нас</a>
            </div>
            <div class="toputil-links">
                <a href="tel:+380123456789" style="font-weight:600;color:var(--text2);">+38 (012) 345-67-89</a>
                <span style="color:var(--border);">|</span>
                <a href="https://t.me/strikeballshop" target="_blank" rel="noopener">Telegram</a>
            </div>
        </div>
    </div>
</div>

{{-- Main header --}}
<header class="header">
    <div class="container">
        <div class="header-inner">
            <a class="brand" href="{{ route('home') }}">
                <div class="brand-mark">SS</div>
                <div class="brand-text">
                    Strikeball Shop
                    <small>Airsoft Store</small>
                </div>
            </a>

            <nav class="nav" aria-label="Основне меню">
                <a href="{{ route('home') }}">Головна</a>
                <a href="{{ route('catalog') }}">Каталог</a>
                @php
                    $categories = \App\Models\Category::whereNull('parent_id')->orderBy('sort_order')->take(3)->get();
                @endphp
                @foreach($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                @endforeach
                <a href="{{ route('contacts') }}">Контакти</a>
            </nav>

            <div class="header-search" role="search">
                <svg class="ico18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2"/>
                    <path d="M16.5 16.5 21 21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <input id="q" type="search" placeholder="Пошук товарів..." autocomplete="off" />
            </div>

            <div class="header-actions">
                <button class="btn btn-icon burger" id="burger" aria-label="Меню">
                    <svg class="ico20" viewBox="0 0 24 24" fill="none">
                        <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>

                <a href="{{ route('cart') }}" class="btn btn-icon cart-btn" aria-label="Кошик">
                    @php $cartCount = count(session('cart', [])); @endphp
                    @if($cartCount > 0)
                        <span class="cart-badge">{{ $cartCount }}</span>
                    @endif
                    <svg class="ico20" viewBox="0 0 24 24" fill="none">
                        <path d="M6 7h15l-2 10H7L6 7Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M6 7 5 4H2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a class="btn btn-sm" href="{{ route('admin.dashboard') }}">Адмін</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn btn-sm">Вихід</button>
                    </form>
                @else
                    <a class="btn btn-sm" href="{{ route('login') }}">Увійти</a>
                @endauth
            </div>
        </div>

        <div id="mobileMenu">
            <div class="grid">
                <a href="{{ route('home') }}">Головна</a>
                <a href="{{ route('catalog') }}">Каталог</a>
                @foreach($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                @endforeach
                <a href="{{ route('contacts') }}">Контакти</a>
                <a href="{{ route('delivery') }}">Доставка</a>
                <a href="{{ route('about') }}">Про нас</a>
            </div>
        </div>
    </div>
</header>

@push('scripts')
<script>
(function(){
    const burger = document.getElementById('burger');
    const menu = document.getElementById('mobileMenu');
    if(burger && menu){
        burger.addEventListener('click', () => {
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
    }
})();
</script>
@endpush
