<div style="position:sticky;top:0;z-index:50;backdrop-filter:blur(14px);background:rgba(6,9,18,.55);border-bottom:1px solid rgba(255,255,255,.10);">
    <div class="container">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;gap:16px;">
            <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:10px;font-weight:900;text-decoration:none;color:inherit;">
                <span style="width:34px;height:34px;border-radius:12px;background:linear-gradient(180deg,rgba(88,255,122,.95),rgba(34,197,94,.85));"></span>
                <span>Strikeball Shop</span>
            </a>

            <nav style="display:flex;align-items:center;gap:10px;">
                <a href="{{ route('home') }}" class="btn" style="padding:10px;">Головна</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn" style="padding:10px;">Адмін</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn" style="padding:10px;">Вихід</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn" style="padding:10px;">Вхід</a>
                @endauth
                <a href="{{ route('cart') }}" class="btn primary" style="padding:10px;">
                    Кошик ({{ count(session('cart', [])) }})
                </a>
            </nav>
        </div>
    </div>
</div>
