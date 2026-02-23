<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#0b0f14" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Strikeball Shop — Інтернет-магазин страйкбольного обладнання')</title>
    <meta name="description" content="@yield('description', 'Каталог страйкбольного обладнання: приводи, магазини, кулі, захист. Доставка по Україні, гарантія, допомога з підбором.')" />
    <meta name="keywords" content="@yield('keywords', 'страйкбол, airsoft, привод, aeg, магазин, кулі, захист, тактичне спорядження')" />
    <link rel="canonical" href="@yield('canonical', url()->current())" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:url" content="@yield('og_url', url()->current())" />
    <meta property="og:title" content="@yield('og_title', 'Strikeball Shop — Інтернет-магазин страйкбольного обладнання')" />
    <meta property="og:description" content="@yield('og_description', 'Каталог страйкбольного обладнання')" />
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="@yield('twitter_url', url()->current())" />
    <meta property="twitter:title" content="@yield('twitter_title', 'Strikeball Shop')" />
    <meta property="twitter:description" content="@yield('twitter_description', 'Каталог страйкбольного обладнання')" />
    <meta property="twitter:image" content="@yield('twitter_image', asset('images/og-default.jpg'))" />

    @stack('structured_data')

    <style>
        :root{
            --bg:#070a0f;--panel:rgba(255,255,255,.06);--panel2:rgba(255,255,255,.08);
            --text:rgba(255,255,255,.92);--muted:rgba(255,255,255,.65);--muted2:rgba(255,255,255,.45);
            --line:rgba(255,255,255,.12);--accent:#58ff7a;--accent2:#22c55e;--danger:#ff4d4d;--warn:#ffcc00;
            --shadow:0 18px 60px rgba(0,0,0,.55);--radius:18px;--radius2:24px;--max:1180px;
            --h1:clamp(26px,3vw,40px);--h2:clamp(20px,2.2vw,30px);--p:15px;
        }
        *{box-sizing:border-box}
        html{
            height:100%;
            scroll-behavior:smooth;
        }
        html:focus-within{
            scroll-behavior:smooth;
        }
        body{
            height:100%;
            margin:0;
            font-family: ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial,"Noto Sans","Helvetica Neue",sans-serif;
            background:
                radial-gradient(1200px 600px at 12% -10%, rgba(88,255,122,.22), transparent 60%),
                radial-gradient(900px 500px at 90% 0%, rgba(56,189,248,.18), transparent 60%),
                radial-gradient(900px 500px at 20% 110%, rgba(168,85,247,.14), transparent 65%),
                linear-gradient(180deg, #05070b, #070a0f 20%, #060912);
            color:var(--text);
            line-height:1.45;
            overflow-x:hidden;
            background-attachment:fixed;
        }
        @media (prefers-reduced-motion: reduce){
            html:focus-within{
                scroll-behavior:auto;
            }
            *,*::before,*::after{
                animation-duration:0.01ms !important;
                animation-iteration-count:1 !important;
                transition-duration:0.01ms !important;
            }
        }
        a{color:inherit; text-decoration:none}
        button,input,select,textarea{font:inherit}
        .container{width:min(var(--max), calc(100% - 32px)); margin:0 auto}
        .grid{display:grid; gap:16px}
        .row{display:flex; align-items:center; gap:12px}
        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:10px;
            padding:12px 14px;
            border-radius:14px;
            border:1px solid rgba(255,255,255,.14);
            background:rgba(255,255,255,.06);
            color:var(--text);
            cursor:pointer;
            transition:all .2s cubic-bezier(0.4, 0, 0.2, 1);
            white-space:nowrap;
            position:relative;
            overflow:hidden;
        }
        .btn::before{
            content:'';
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:linear-gradient(135deg, rgba(255,255,255,.1), transparent);
            opacity:0;
            transition:opacity .2s ease;
        }
        .btn:hover{
            transform:translateY(-2px);
            border-color:rgba(255,255,255,.25);
            background:rgba(255,255,255,.10);
            box-shadow:0 8px 24px rgba(0,0,0,.20);
        }
        .btn:hover::before{
            opacity:1;
        }
        .btn.primary{
            background:linear-gradient(180deg, rgba(88,255,122,.95), rgba(34,197,94,.92));
            border-color:rgba(88,255,122,.35);
            color:#031107;
            font-weight:900;
            box-shadow:0 16px 40px rgba(34,197,94,.22);
        }
        .btn.primary:hover{
            transform:translateY(-3px) scale(1.02);
            box-shadow:0 20px 50px rgba(34,197,94,.35);
            filter:brightness(1.1);
        }
        .btn.small{padding:10px 12px; border-radius:12px; font-size:14px}
        .pill{display:inline-flex; gap:8px; align-items:center; padding:8px 12px; border-radius:999px;
            background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.10); color:var(--muted); font-size:13px}
        .card{
            border-radius:var(--radius);
            border:1px solid rgba(255,255,255,.12);
            background:rgba(255,255,255,.05);
            box-shadow:0 10px 30px rgba(0,0,0,.30);
            transition:all .25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card:hover{
            transform:translateY(-2px);
            border-color:rgba(255,255,255,.20);
            box-shadow:0 20px 50px rgba(0,0,0,.40);
        }
        .muted{color:var(--muted)}
        .muted2{color:var(--muted2)}
        .star{color:rgba(255,204,0,.9)}
        .strike{color:rgba(255,255,255,.45); text-decoration:line-through; font-weight:700; margin-left:8px}
        .ico18{width:18px;height:18px}
        .ico20{width:20px;height:20px}

        /* header */
        .topbar{position:sticky; top:0; z-index:50; backdrop-filter:blur(14px); background:rgba(6,9,18,.55); border-bottom:1px solid rgba(255,255,255,.10)}
        .topbar-inner{display:flex; align-items:center; justify-content:space-between; padding:12px 0; gap:16px}
        .brand{display:flex; align-items:center; gap:10px; font-weight:900; letter-spacing:.3px}
        .logo{
            width:34px;height:34px;border-radius:12px; display:grid;place-items:center;color:#04140a;
            background:radial-gradient(16px 16px at 30% 30%, rgba(255,255,255,.20), transparent 60%),
                     linear-gradient(180deg, rgba(88,255,122,.95), rgba(34,197,94,.85));
            box-shadow:0 10px 24px rgba(34,197,94,.22); border:1px solid rgba(255,255,255,.22);
        }
        .brand small{display:block; color:var(--muted); font-weight:600; letter-spacing:0}
        .nav{display:flex; align-items:center; gap:10px; color:var(--muted); font-size:14px}
        .nav a{padding:10px 10px;border-radius:12px;border:1px solid transparent}
        .nav a:hover{background:rgba(255,255,255,.06);border-color:rgba(255,255,255,.10);color:var(--text)}
        .search{
            flex:1; display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:16px;
            background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.12); min-width:240px;
        }
        .search input{width:100%; background:transparent; border:none; outline:none; color:var(--text); font-size:14px}
        .search input::placeholder{color:rgba(255,255,255,.45)}
        .actions{display:flex; align-items:center; gap:10px}
        .iconbtn{
            width:42px; height:42px; border-radius:14px; background:rgba(255,255,255,.06);
            border:1px solid rgba(255,255,255,.12); display:grid; place-items:center; cursor:pointer;
            transition:background .12s ease, transform .12s ease, border-color .12s ease; position:relative;
        }
        .iconbtn:hover{background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.22); transform:translateY(-1px)}
        .badge{position:absolute; top:8px; right:8px; background:linear-gradient(180deg, rgba(255,77,77,.95), rgba(239,68,68,.9));
            border:1px solid rgba(255,255,255,.18); color:#120202; font-weight:900; border-radius:999px; padding:2px 6px; font-size:11px; line-height:1}
        .burger{display:none}
        #mobileMenu{display:none; padding:0 0 14px}

        /* breadcrumbs */
        .crumbs{
            padding:20px 0 12px;
            color:rgba(255,255,255,.55);
            font-size:14px;
            display:flex;
            align-items:center;
            gap:8px;
            flex-wrap:wrap;
            font-weight:500;
        }
        .crumbs a{
            color:rgba(255,255,255,.75);
            text-decoration:none;
            transition:all .2s ease;
            padding:4px 8px;
            border-radius:6px;
            display:inline-flex;
            align-items:center;
            gap:4px;
        }
        .crumbs a:hover{
            color:var(--accent);
            background:rgba(88,255,122,.08);
        }
        .crumbs span{
            color:rgba(255,255,255,.92);
            font-weight:600;
        }
        .crumbs::before{
            content:'🏠';
            font-size:16px;
            margin-right:4px;
            opacity:.7;
        }

        /* pagination */
        .pagination{display:flex; gap:8px; justify-content:center; margin-top:14px; flex-wrap:wrap}
        .pagination nav{display:contents}
        .pagination ul{display:flex; gap:8px; list-style:none; padding:0; margin:0}
        .pagination li{display:contents}
        .pagination a,
        .pagination span{
            min-width:42px; height:42px; display:grid; place-items:center; border-radius:14px;
            border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.05);
            cursor:pointer; transition:.12s ease; color:var(--text); font-size:14px; padding:0 12px;
        }
        .pagination a:hover{background:rgba(255,255,255,.07); border-color:rgba(255,255,255,.20)}
        .pagination .active span{
            background:rgba(88,255,122,.18); border-color:rgba(88,255,122,.28);
            color:rgba(255,255,255,.92); font-weight:900;
        }
        .pagination .disabled span{opacity:.4; cursor:not-allowed}

        /* footer */
        .footer{
            padding:22px 0 32px; border-top:1px solid rgba(255,255,255,.10); background:rgba(0,0,0,.10); margin-top:40px
        }
        .footer-grid{display:grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap:16px}
        .footer-grid h5{margin:0 0 10px; font-size:14px}
        .footer-grid a{color:var(--muted); display:block; padding:6px 0; font-size:13px}
        .footer-grid a:hover{color:var(--text)}
        .copyright{margin-top:18px; display:flex; justify-content:space-between; gap:10px; color:rgba(255,255,255,.55); font-size:12px; flex-wrap:wrap}

        /* alerts */
        .alert{padding:14px 16px; border-radius:14px; margin-bottom:16px}
        .alert-success{background:rgba(88,255,122,.1); border:1px solid rgba(88,255,122,.3); color:rgba(88,255,122,.95)}
        .alert-error{background:rgba(255,77,77,.1); border:1px solid rgba(255,77,77,.3); color:rgba(255,77,77,.95)}
        .alert-info{background:rgba(56,189,248,.1); border:1px solid rgba(56,189,248,.3); color:rgba(56,189,248,.95)}

        /* page animations */
        @keyframes fadeInUp{
            from{
                opacity:0;
                transform:translateY(20px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }
        .container > *{
            animation:fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) backwards;
        }
        .container > *:nth-child(1){animation-delay:0.05s}
        .container > *:nth-child(2){animation-delay:0.1s}
        .container > *:nth-child(3){animation-delay:0.15s}
        .container > *:nth-child(4){animation-delay:0.2s}
        .container > *:nth-child(5){animation-delay:0.25s}

        /* input focus styles */
        input:focus,
        select:focus,
        textarea:focus{
            outline:2px solid rgba(88,255,122,.4);
            outline-offset:2px;
        }

        /* selection styles */
        ::selection{
            background:rgba(88,255,122,.3);
            color:rgba(255,255,255,.95);
        }

        /* responsive */
        @media (max-width: 980px){
            .nav{display:none}
            .burger{display:inline-flex}
            .search{min-width:0}
            .footer-grid{grid-template-columns:1.6fr 1fr 1fr}
        }
        @media (max-width: 560px){
            .search{display:none}
            .footer-grid{grid-template-columns:1fr 1fr}
        }
    </style>

    @stack('styles')
</head>
<body>
    @include('components.header')

    <main class="container" style="min-height:60vh;padding-bottom:40px;">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
</body>
</html>
