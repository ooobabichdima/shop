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

                {{-- Catalog with mega menu --}}
                <div class="nav-dropdown">
                    <a href="{{ route('catalog') }}" class="nav-dropdown-trigger">
                        Каталог
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" style="margin-left:4px;transition:transform .2s ease;">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>

                    <div class="mega-menu">
                        <div class="container">
                            <div class="mega-menu-inner">
                                @php
                                    $allCategories = \App\Models\Category::with(['children' => function($q) {
                                        $q->where('is_active', true)->orderBy('sort_order')->limit(10);
                                    }])
                                    ->whereNull('parent_id')
                                    ->where('is_active', true)
                                    ->orderBy('sort_order')
                                    ->get();
                                @endphp

                                @foreach($allCategories as $category)
                                <div class="mega-menu-col">
                                    <a href="{{ route('category.show', $category->slug) }}" class="mega-menu-title">
                                        <span class="mega-menu-icon">
                                            @switch($category->slug)
                                                @case('pryvody') 🎯 @break
                                                @case('boieprypasy') 🔘 @break
                                                @case('apgreid') ⚙️ @break
                                                @case('magazyny') 📋 @break
                                                @case('akumulyatory') 🔋 @break
                                                @case('optyka') 🔭 @break
                                                @case('zakhyst') 🛡️ @break
                                                @case('taktychne-sporyadzhennya') 🎒 @break
                                                @case('odyag') 👕 @break
                                                @case('zvyazok') 📡 @break
                                                @case('kamuflyazh') 🌿 @break
                                                @case('instrumenty') 🔧 @break
                                                @default 📦 @break
                                            @endswitch
                                        </span>
                                        {{ $category->name }}
                                    </a>

                                    @if($category->children && $category->children->count() > 0)
                                    <ul class="mega-menu-list">
                                        @foreach($category->children as $child)
                                        <li>
                                            <a href="{{ route('category.show', $child->slug) }}">{{ $child->name }}</a>
                                        </li>
                                        @endforeach
                                        @if($category->children->count() >= 10)
                                        <li>
                                            <a href="{{ route('category.show', $category->slug) }}" class="mega-menu-more">
                                                Дивитись все →
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                    @endif
                                </div>
                                @endforeach

                                {{-- Promo block --}}
                                <div class="mega-menu-promo">
                                    <div class="mega-menu-promo-inner">
                                        <div class="mega-menu-promo-icon">✨</div>
                                        <h3>Не знаєте, що обрати?</h3>
                                        <p>Наші експерти допоможуть підібрати обладнання</p>
                                        <a href="{{ route('contacts') }}" class="btn btn-primary btn-sm" style="width:100%;margin-top:12px;">
                                            Консультація
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $topCategories = \App\Models\Category::whereNull('parent_id')->orderBy('sort_order')->take(3)->get();
                @endphp
                @foreach($topCategories as $category)
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
                @foreach($topCategories as $category)
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
    // Mobile menu toggle
    const burger = document.getElementById('burger');
    const menu = document.getElementById('mobileMenu');
    if(burger && menu){
        burger.addEventListener('click', () => {
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
    }

    // Mega menu functionality
    const dropdown = document.querySelector('.nav-dropdown');
    const megaMenu = document.querySelector('.mega-menu');
    const trigger = document.querySelector('.nav-dropdown-trigger');

    if(dropdown && megaMenu && trigger) {
        let timeout;

        dropdown.addEventListener('mouseenter', () => {
            clearTimeout(timeout);
            megaMenu.style.display = 'block';
            setTimeout(() => {
                megaMenu.classList.add('mega-menu-open');
            }, 10);
            trigger.querySelector('svg').style.transform = 'rotate(180deg)';
        });

        dropdown.addEventListener('mouseleave', () => {
            timeout = setTimeout(() => {
                megaMenu.classList.remove('mega-menu-open');
                setTimeout(() => {
                    megaMenu.style.display = 'none';
                }, 200);
            }, 150);
            trigger.querySelector('svg').style.transform = 'rotate(0deg)';
        });
    }
})();
</script>
@endpush
