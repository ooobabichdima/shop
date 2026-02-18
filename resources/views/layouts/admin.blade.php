<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#0b0f14" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Адмін панель - Strikeball Shop')</title>
    <meta name="description" content="Адміністративна панель" />

    <style>
        :root{
            --bg:#070a0f;--panel:rgba(255,255,255,.06);--panel2:rgba(255,255,255,.08);
            --text:rgba(255,255,255,.92);--muted:rgba(255,255,255,.65);--muted2:rgba(255,255,255,.45);
            --line:rgba(255,255,255,.12);--accent:#58ff7a;--accent2:#22c55e;--danger:#ff4d4d;--warn:#ffcc00;
            --shadow:0 18px 60px rgba(0,0,0,.55);--radius:18px;--radius2:24px;--max:1280px;
            --h1:clamp(26px,3vw,40px);--h2:clamp(20px,2.2vw,30px);--p:15px;
        }
        *{box-sizing:border-box} html,body{height:100%}
        body{
            margin:0; font-family: ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial,"Noto Sans","Helvetica Neue",sans-serif;
            background:
                radial-gradient(1200px 600px at 12% -10%, rgba(88,255,122,.22), transparent 60%),
                radial-gradient(900px 500px at 90% 0%, rgba(56,189,248,.18), transparent 60%),
                radial-gradient(900px 500px at 20% 110%, rgba(168,85,247,.14), transparent 65%),
                linear-gradient(180deg, #05070b, #070a0f 20%, #060912);
            color:var(--text); line-height:1.45; overflow-x:hidden;
        }
        a{color:inherit; text-decoration:none}
        button,input,select,textarea{font:inherit}
        .container{width:min(var(--max), calc(100% - 32px)); margin:0 auto}
        .grid{display:grid; gap:16px}
        .row{display:flex; align-items:center; gap:12px}

        /* Admin buttons - smaller sizes */
        .btn{
            display:inline-flex; align-items:center; justify-content:center; gap:8px;
            padding:8px 12px; border-radius:12px; border:1px solid rgba(255,255,255,.14);
            background:rgba(255,255,255,.06); color:var(--text); cursor:pointer;
            transition:transform .12s ease, background .12s ease, border-color .12s ease;
            white-space:nowrap; font-size:14px;
        }
        .btn:hover{transform:translateY(-1px); border-color:rgba(255,255,255,.22); background:rgba(255,255,255,.08)}
        .btn.primary{
            background:linear-gradient(180deg, rgba(88,255,122,.95), rgba(34,197,94,.92));
            border-color: rgba(88,255,122,.35); color:#031107; font-weight:900;
            box-shadow:0 16px 40px rgba(34,197,94,.22);
        }
        .btn.small{padding:6px 10px; border-radius:10px; font-size:13px}
        .btn.danger{
            background:rgba(255,77,77,.12); border-color:rgba(255,77,77,.28); color:rgba(255,77,77,.95);
        }
        .btn.danger:hover{background:rgba(255,77,77,.18); border-color:rgba(255,77,77,.38)}

        .pill{display:inline-flex; gap:8px; align-items:center; padding:8px 12px; border-radius:999px;
            background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.10); color:var(--muted); font-size:13px}
        .card{
            border-radius:var(--radius); border:1px solid rgba(255,255,255,.12);
            background:rgba(255,255,255,.05); box-shadow:0 10px 30px rgba(0,0,0,.30);
            padding:20px;
        }
        .muted{color:var(--muted)}
        .muted2{color:var(--muted2)}
        .ico18{width:18px;height:18px}
        .ico20{width:20px;height:20px}

        /* Admin header */
        .admin-header{
            position:sticky; top:0; z-index:50; backdrop-filter:blur(14px);
            background:rgba(6,9,18,.55); border-bottom:1px solid rgba(255,255,255,.10);
        }
        .admin-header-inner{
            display:flex; align-items:center; justify-content:space-between; padding:12px 0; gap:16px;
        }
        .brand{display:flex; align-items:center; gap:10px; font-weight:900; letter-spacing:.3px}
        .logo{
            width:34px;height:34px;border-radius:12px; display:grid;place-items:center;color:#04140a;
            background:radial-gradient(16px 16px at 30% 30%, rgba(255,255,255,.20), transparent 60%),
                     linear-gradient(180deg, rgba(88,255,122,.95), rgba(34,197,94,.85));
            box-shadow:0 10px 24px rgba(34,197,94,.22); border:1px solid rgba(255,255,255,.22);
        }
        .brand small{display:block; color:var(--muted); font-weight:600; letter-spacing:0; font-size:12px}
        .admin-actions{display:flex; align-items:center; gap:10px}

        /* Admin navigation */
        .admin-nav{
            background:rgba(255,255,255,.04); border-bottom:1px solid rgba(255,255,255,.08);
            overflow-x:auto; scrollbar-width:thin;
        }
        .admin-nav-inner{
            display:flex; gap:6px; padding:10px 0; min-width:max-content;
        }
        .admin-nav a{
            display:flex; align-items:center; gap:8px; padding:8px 14px; border-radius:12px;
            border:1px solid transparent; color:var(--muted); font-size:14px; font-weight:600;
            transition:.12s ease; white-space:nowrap;
        }
        .admin-nav a:hover{
            background:rgba(255,255,255,.06); border-color:rgba(255,255,255,.10); color:var(--text);
        }
        .admin-nav a.active{
            background:rgba(88,255,122,.14); border-color:rgba(88,255,122,.24);
            color:rgba(255,255,255,.95);
        }

        /* alerts */
        .alert{padding:12px 14px; border-radius:12px; margin-bottom:16px; font-size:14px}
        .alert-success{background:rgba(88,255,122,.1); border:1px solid rgba(88,255,122,.3); color:rgba(88,255,122,.95)}
        .alert-error{background:rgba(255,77,77,.1); border:1px solid rgba(255,77,77,.3); color:rgba(255,77,77,.95)}
        .alert-info{background:rgba(56,189,248,.1); border:1px solid rgba(56,189,248,.3); color:rgba(56,189,248,.95)}

        /* pagination */
        .pagination{display:flex; gap:8px; justify-content:center; margin-top:14px; flex-wrap:wrap}
        .pagination nav{display:contents}
        .pagination ul{display:flex; gap:8px; list-style:none; padding:0; margin:0}
        .pagination li{display:contents}
        .pagination a,
        .pagination span{
            min-width:38px; height:38px; display:grid; place-items:center; border-radius:12px;
            border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.05);
            cursor:pointer; transition:.12s ease; color:var(--text); font-size:14px; padding:0 10px;
        }
        .pagination a:hover{background:rgba(255,255,255,.07); border-color:rgba(255,255,255,.20)}
        .pagination .active span{
            background:rgba(88,255,122,.18); border-color:rgba(88,255,122,.28);
            color:rgba(255,255,255,.92); font-weight:900;
        }
        .pagination .disabled span{opacity:.4; cursor:not-allowed}

        /* responsive */
        @media (max-width: 768px){
            .admin-nav-inner{padding:10px 16px}
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Admin Header -->
    <header class="admin-header">
        <div class="container">
            <div class="admin-header-inner">
                <a href="{{ route('admin.dashboard') }}" class="brand">
                    <div class="logo">
                        <svg width="20" height="20" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 70c20-18 40-26 80-30l5 10-70 16-6 10-9 2Z" stroke="currentColor" stroke-width="10" stroke-linejoin="round"/>
                            <circle cx="92" cy="35" r="8" fill="currentColor"/>
                        </svg>
                    </div>
                    <div>
                        <div>Strikeball Shop</div>
                        <small>Адмін панель</small>
                    </div>
                </a>

                <div class="admin-actions">
                    <a href="{{ route('home') }}" class="btn small" target="_blank">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14 21 3"/></svg>
                        На сайт
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn small">Вийти</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Admin Navigation -->
    <nav class="admin-nav">
        <div class="container">
            <div class="admin-nav-inner">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    Панель
                </a>
                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    Замовлення
                </a>
                <a href="{{ route('admin.leads.index') }}" class="{{ request()->routeIs('admin.leads.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path d="M20 8v6M23 11h-6"/></svg>
                    Ліди
                </a>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41 13.42 20.58a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82zM7 7h.01"/></svg>
                    Товари
                </a>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                    Категорії
                </a>
                <a href="{{ route('admin.brands.index') }}" class="{{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3.5 13 3.25-7.5L10 13M3.5 13h6.5M16 16l5-8M21 16l-5-8"/></svg>
                    Бренди
                </a>
                <a href="{{ route('admin.attributes.index') }}" class="{{ request()->routeIs('admin.attributes.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    Атрибути
                </a>
                <a href="{{ route('admin.import.index') }}" class="{{ request()->routeIs('admin.import.*') ? 'active' : '' }}">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg>
                    Імпорт
                </a>
            </div>
        </div>
    </nav>

    <main class="container" style="min-height:calc(100vh - 200px);padding:20px 0 40px;">
        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">✗ {{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
