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

                {{-- Catalog with advanced mega menu --}}
                <div class="nav-dropdown">
                    <button class="nav-dropdown-trigger" id="catalogTrigger">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right:6px;">
                            <rect x="3" y="3" width="7" height="7" stroke="currentColor" stroke-width="2" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" stroke="currentColor" stroke-width="2" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" stroke="currentColor" stroke-width="2" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" stroke="currentColor" stroke-width="2" rx="1"/>
                        </svg>
                        Каталог
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" style="margin-left:6px;transition:transform .2s ease;">
                            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div class="mega-menu-advanced">
                        <div class="container">
                            <div class="mega-menu-grid">
                                {{-- Left sidebar with categories --}}
                                <div class="mega-sidebar">
                                    @php
                                        $allCats = \App\Models\Category::whereNull('parent_id')->where('is_active', true)->orderBy('sort_order')->get();
                                    @endphp
                                    @foreach($allCats as $cat)
                                    <a href="{{ route('category.show', $cat->slug) }}" class="mega-sidebar-item" data-category="{{ $cat->id }}">
                                        <span class="mega-sidebar-icon">
                                            @if($cat->image)
                                                <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}" style="width:24px;height:24px;object-fit:cover;border-radius:4px;">
                                            @else
                                                @switch($cat->slug)
                                                    @case('pryvody') 🎯 @break
                                                    @case('boieprypasy') 🔘 @break
                                                    @case('apgreid') ⚙️ @break
                                                    @case('magazyny') 📋 @break
                                                    @case('akumulyatory') 🔋 @break
                                                    @case('optyka') 🔭 @break
                                                    @case('zakhyst') 🛡️ @break
                                                    @case('taktychne-sporyadzhennya') 🎒 @break
                                                    @default 📦 @break
                                                @endswitch
                                            @endif
                                        </span>
                                        <span class="mega-sidebar-text">{{ $cat->name }}</span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" class="mega-sidebar-arrow">
                                            <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                    @endforeach
                                </div>

                                {{-- Main content area --}}
                                <div class="mega-content">
                                    {{-- Subcategories columns --}}
                                    <div class="mega-columns">
                                        @php
                                            $featuredCat = $allCats->first();
                                            if($featuredCat) {
                                                $subcats = \App\Models\Category::where('parent_id', $featuredCat->id)->where('is_active', true)->orderBy('sort_order')->limit(15)->get()->chunk(5);
                                            } else {
                                                $subcats = collect();
                                            }
                                        @endphp
                                        @foreach($subcats as $chunk)
                                        <div class="mega-column">
                                            @foreach($chunk as $subcat)
                                            <a href="{{ route('category.show', $subcat->slug) }}" class="mega-column-link">
                                                {{ $subcat->name }}
                                            </a>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>

                                    {{-- Bottom section: Brands + Quick filters + Banners --}}
                                    <div class="mega-bottom">
                                        {{-- Popular brands --}}
                                        <div class="mega-brands">
                                            <div class="mega-section-title">Популярні бренди</div>
                                            <div class="mega-brands-grid">
                                                @php
                                                    $brands = \App\Models\Brand::where('is_active', true)->orderBy('name')->limit(8)->get();
                                                @endphp
                                                @foreach($brands as $brand)
                                                <a href="{{ route('catalog') }}?brand[]={{ $brand->id }}" class="mega-brand-item">
                                                    {{ $brand->name }}
                                                </a>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Quick filters --}}
                                        <div class="mega-filters">
                                            <div class="mega-section-title">Швидкий доступ</div>
                                            <div class="mega-filters-list">
                                                <a href="{{ route('catalog') }}?sort=newest" class="mega-filter-chip">✨ Новинки</a>
                                                <a href="{{ route('catalog') }}?sort=popular" class="mega-filter-chip">🔥 Хіти продажів</a>
                                                <a href="{{ route('catalog') }}?price_to=1000" class="mega-filter-chip">💰 До 1000 грн</a>
                                                <a href="{{ route('catalog') }}?in_stock=1" class="mega-filter-chip">✅ В наявності</a>
                                            </div>
                                        </div>

                                        {{-- Promo banner --}}
                                        <div class="mega-banner">
                                            <div class="mega-banner-content">
                                                <div class="mega-banner-tag">Спеціальна пропозиція</div>
                                                <h3>Знижки до -30%</h3>
                                                <p>На вибране обладнання</p>
                                                <a href="{{ route('catalog') }}" class="btn btn-primary btn-sm">Переглянути</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $topCategories = \App\Models\Category::whereNull('parent_id')->orderBy('sort_order')->take(2)->get();
                @endphp
                @foreach($topCategories as $category)
                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                @endforeach
                <a href="{{ route('blog.index') }}">Блог</a>
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

                <a href="{{ route('wishlist') }}" class="btn btn-icon" aria-label="Обране" style="position:relative;">
                    @php $wishCount = count(session('wishlist', [])); @endphp
                    @if($wishCount > 0)
                        <span class="cart-badge">{{ $wishCount }}</span>
                    @endif
                    <svg class="ico20" viewBox="0 0 24 24" fill="none">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>

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

    // Advanced mega menu functionality
    const trigger = document.getElementById('catalogTrigger');
    const megaMenu = document.querySelector('.mega-menu-advanced');
    const navDropdown = document.querySelector('.nav-dropdown');

    if(trigger && megaMenu && navDropdown) {
        let timeout;

        const showMenu = () => {
            clearTimeout(timeout);
            megaMenu.style.display = 'block';
            setTimeout(() => {
                megaMenu.classList.add('mega-menu-open');
            }, 10);
            trigger.querySelector('svg:last-child').style.transform = 'rotate(180deg)';
        };

        const hideMenu = () => {
            timeout = setTimeout(() => {
                megaMenu.classList.remove('mega-menu-open');
                setTimeout(() => {
                    megaMenu.style.display = 'none';
                }, 200);
                trigger.querySelector('svg:last-child').style.transform = 'rotate(0deg)';
            }, 200);
        };

        // Add listeners to trigger button
        trigger.addEventListener('mouseenter', showMenu);
        trigger.addEventListener('mouseleave', hideMenu);

        // Add listeners to the dropdown container
        navDropdown.addEventListener('mouseenter', showMenu);
        navDropdown.addEventListener('mouseleave', hideMenu);

        // IMPORTANT: Add listeners to mega menu itself
        megaMenu.addEventListener('mouseenter', showMenu);
        megaMenu.addEventListener('mouseleave', hideMenu);

        // Sidebar hover effects
        const sidebarItems = document.querySelectorAll('.mega-sidebar-item');
        sidebarItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                sidebarItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }
})();
</script>
@endpush
