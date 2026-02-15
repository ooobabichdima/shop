<div class="topbar">
    <div class="container">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('home') }}">
                <span class="logo" aria-hidden="true">
                    <svg class="ico18" viewBox="0 0 24 24" fill="none">
                        <path d="M12 3c4.8 0 9 3.6 9 9s-4.2 9-9 9-9-3.6-9-9 4.2-9 9-9Z" stroke="#04140a" stroke-width="2"/>
                        <path d="M12 7c2.8 0 5 2.2 5 5s-2.2 5-5 5-5-2.2-5-5 2.2-5 5-5Z" stroke="#04140a" stroke-width="2"/>
                    </svg>
                </span>
                <span>
                    Strikeball Shop
                    <small>Каталог • Доставка • Сервіс</small>
                </span>
            </a>

            <nav class="nav" aria-label="Основне меню">
                <a href="{{ route('home') }}">Головна</a>
                @php
                    $categories = \App\Models\Category::take(3)->get();
                @endphp
                @foreach($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                @endforeach
                <a href="#">Контакти</a>
            </nav>

            <div class="search" role="search" aria-label="Пошук по магазину">
                <svg class="ico18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="rgba(255,255,255,.75)" stroke-width="2"/>
                    <path d="M16.5 16.5 21 21" stroke="rgba(255,255,255,.75)" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <input id="q" type="search" placeholder="Знайти: M4, hop-up, коліматор…" autocomplete="off" />
            </div>

            <div class="actions">
                <button class="iconbtn burger" id="burger" aria-label="Відкрити меню">
                    <svg class="ico20" viewBox="0 0 24 24" fill="none">
                        <path d="M4 7h16M4 12h16M4 17h16" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>

                <a href="{{ route('cart') }}" class="iconbtn" aria-label="Кошик">
                    @php
                        $cartCount = count(session('cart', []));
                    @endphp
                    @if($cartCount > 0)
                        <span class="badge">{{ $cartCount }}</span>
                    @endif
                    <svg class="ico20" viewBox="0 0 24 24" fill="none">
                        <path d="M6 7h15l-2 10H7L6 7Z" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linejoin="round"/>
                        <path d="M6 7 5 4H2" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a class="btn small" href="{{ route('admin.dashboard') }}">Адмін</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn small">Вихід</button>
                    </form>
                @else
                    <a class="btn small" href="{{ route('login') }}">Увійти</a>
                @endauth
            </div>
        </div>

        <div id="mobileMenu">
            <div class="grid" style="gap:10px;">
                <a class="btn" href="{{ route('home') }}">Головна</a>
                @foreach($categories as $category)
                    <a class="btn" href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                @endforeach
                <a class="btn" href="#">Контакти</a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function(){
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobileMenu');
    if (burger && mobileMenu) {
        burger.addEventListener('click', ()=> {
            mobileMenu.style.display = (mobileMenu.style.display === 'block') ? 'none' : 'block';
        });
    }
})();
</script>
@endpush
