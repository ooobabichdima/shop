<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#0a0a0a" />
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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @stack('structured_data')

    <style>
        :root{
            --bg:#0a0a0a;
            --surface:#111111;
            --surface2:#1a1a1a;
            --surface3:#222222;
            --text:#f5f5f5;
            --text2:#a3a3a3;
            --text3:#737373;
            --border:#262626;
            --border2:#404040;
            --accent:#f59e0b;
            --accent2:#fbbf24;
            --accent-glow:rgba(245,158,11,.15);
            --danger:#ef4444;
            --success:#22c55e;
            --info:#3b82f6;
            --radius:12px;
            --radius-lg:20px;
            --max:1240px;
            --font:'Inter',ui-sans-serif,system-ui,-apple-system,sans-serif;
            --shadow-sm:0 1px 2px rgba(0,0,0,.4);
            --shadow:0 4px 24px rgba(0,0,0,.5);
            --shadow-lg:0 12px 48px rgba(0,0,0,.6);
            --transition:all .2s cubic-bezier(.4,0,.2,1);
        }
        *{box-sizing:border-box;margin:0;padding:0}
        html{height:100%;scroll-behavior:smooth}
        body{
            min-height:100vh;
            font-family:var(--font);
            background:var(--bg);
            color:var(--text);
            line-height:1.5;
            overflow-x:hidden;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
        }
        /* Noise texture overlay */
        body::before{
            content:'';
            position:fixed;
            inset:0;
            opacity:.03;
            background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            background-repeat:repeat;
            pointer-events:none;
            z-index:9999;
        }

        a{color:inherit;text-decoration:none}
        button,input,select,textarea{font:inherit;color:inherit}
        img{max-width:100%;display:block}
        ul{list-style:none}

        .container{width:min(var(--max),100% - 48px);margin-inline:auto}
        .grid{display:grid;gap:16px}
        .flex{display:flex;align-items:center;gap:12px}

        /* ═══ BUTTONS ═══ */
        .btn{
            display:inline-flex;align-items:center;justify-content:center;gap:8px;
            padding:11px 22px;border-radius:var(--radius);font-weight:600;font-size:14px;
            border:1px solid var(--border);background:var(--surface2);color:var(--text);
            cursor:pointer;transition:var(--transition);white-space:nowrap;letter-spacing:.01em;
        }
        .btn:hover{background:var(--surface3);border-color:var(--border2);transform:translateY(-1px);box-shadow:var(--shadow-sm)}
        .btn:active{transform:translateY(0)}
        .btn-primary{
            background:var(--accent);border-color:var(--accent);color:#000;font-weight:700;
            box-shadow:0 0 0 0 var(--accent-glow);
        }
        .btn-primary:hover{
            background:var(--accent2);border-color:var(--accent2);
            box-shadow:0 0 30px var(--accent-glow);transform:translateY(-1px);
        }
        .btn-ghost{background:transparent;border-color:transparent}
        .btn-ghost:hover{background:var(--surface);border-color:var(--border)}
        .btn-sm{padding:8px 14px;font-size:13px;border-radius:8px}
        .btn-lg{padding:14px 32px;font-size:16px;border-radius:14px}
        .btn-icon{width:40px;height:40px;padding:0;border-radius:10px;flex-shrink:0}

        /* ═══ TAGS ═══ */
        .tag{
            display:inline-flex;gap:6px;align-items:center;
            padding:5px 12px;border-radius:6px;font-size:12px;font-weight:600;letter-spacing:.04em;text-transform:uppercase;
            background:var(--surface2);border:1px solid var(--border);color:var(--text2);
        }
        .tag-accent{background:var(--accent-glow);border-color:rgba(245,158,11,.3);color:var(--accent2)}
        .tag-success{background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.25);color:var(--success)}
        .tag-danger{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.25);color:var(--danger)}
        .tag-info{background:rgba(59,130,246,.1);border-color:rgba(59,130,246,.25);color:var(--info)}

        /* ═══ CARDS ═══ */
        .card{
            border-radius:var(--radius-lg);border:1px solid var(--border);
            background:var(--surface);overflow:hidden;transition:var(--transition);
        }
        .card:hover{border-color:var(--border2);box-shadow:var(--shadow)}

        /* ═══ TOP BAR ═══ */
        .toputil{
            background:var(--surface);border-bottom:1px solid var(--border);font-size:13px;color:var(--text3);
        }
        .toputil-inner{
            display:flex;align-items:center;justify-content:space-between;padding:6px 0;gap:16px;
        }
        .toputil a{transition:color .15s ease}
        .toputil a:hover{color:var(--accent)}
        .toputil-links{display:flex;gap:20px;align-items:center}

        /* ═══ HEADER ═══ */
        .header{
            position:sticky;top:0;z-index:100;
            background:rgba(10,10,10,.8);
            backdrop-filter:blur(20px) saturate(180%);
            -webkit-backdrop-filter:blur(20px) saturate(180%);
            border-bottom:1px solid var(--border);
        }
        .header-inner{
            display:flex;align-items:center;padding:14px 0;gap:20px;
        }
        .brand{display:flex;align-items:center;gap:12px;flex-shrink:0}
        .brand-mark{
            width:42px;height:42px;border-radius:10px;display:grid;place-items:center;
            background:linear-gradient(135deg,var(--accent),#d97706);
            box-shadow:0 4px 16px var(--accent-glow);
            font-size:20px;font-weight:900;color:#000;
            position:relative;overflow:hidden;
        }
        .brand-mark::after{
            content:'';position:absolute;top:-50%;left:-50%;width:200%;height:200%;
            background:linear-gradient(45deg,transparent 40%,rgba(255,255,255,.15) 50%,transparent 60%);
            animation:shimmer 3s infinite;
        }
        @keyframes shimmer{0%{transform:translateX(-100%)}100%{transform:translateX(100%)}}
        .brand-text{font-weight:800;font-size:18px;letter-spacing:-.02em;line-height:1.2}
        .brand-text small{display:block;font-size:11px;font-weight:500;color:var(--text3);letter-spacing:.06em;text-transform:uppercase}

        .nav{display:flex;align-items:center;gap:2px;margin-left:16px}
        .nav a{
            padding:8px 14px;border-radius:8px;font-size:14px;font-weight:500;color:var(--text2);
            transition:var(--transition);position:relative;
        }
        .nav a:hover{color:var(--text);background:var(--surface2)}
        .nav a.active{color:var(--accent)}

        .header-search{
            flex:1;max-width:380px;margin-left:auto;position:relative;
        }
        .header-search input{
            width:100%;padding:10px 16px 10px 40px;border-radius:10px;
            border:1px solid var(--border);background:var(--surface2);
            font-size:14px;color:var(--text);outline:none;transition:var(--transition);
        }
        .header-search input::placeholder{color:var(--text3)}
        .header-search input:focus{border-color:var(--accent);background:var(--surface);box-shadow:0 0 0 3px var(--accent-glow)}
        .header-search svg{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--text3)}

        .header-actions{display:flex;align-items:center;gap:8px;flex-shrink:0}
        .cart-btn{position:relative}
        .cart-badge{
            position:absolute;top:-4px;right:-4px;
            min-width:18px;height:18px;border-radius:99px;
            background:var(--accent);color:#000;font-size:11px;font-weight:800;
            display:grid;place-items:center;padding:0 5px;line-height:1;
            border:2px solid var(--bg);
        }
        .burger{display:none}
        #mobileMenu{display:none;padding:16px 0}
        #mobileMenu .grid{gap:4px}
        #mobileMenu a{
            display:block;padding:12px 16px;border-radius:10px;font-weight:500;
            color:var(--text2);transition:var(--transition);
        }
        #mobileMenu a:hover{background:var(--surface2);color:var(--text)}

        /* ═══ BREADCRUMBS ═══ */
        .crumbs{
            padding:20px 0 8px;display:flex;align-items:center;gap:6px;flex-wrap:wrap;
            font-size:13px;color:var(--text3);
        }
        .crumbs a{color:var(--text2);transition:color .15s ease;font-weight:500}
        .crumbs a:hover{color:var(--accent)}
        .crumbs span{color:var(--text);font-weight:600}
        .crumbs-sep{color:var(--text3);margin:0 2px;font-size:11px}

        /* ═══ PAGINATION ═══ */
        .pagination{display:flex;gap:6px;justify-content:center;margin-top:24px;flex-wrap:wrap}
        .pagination nav{display:contents}
        .pagination ul{display:flex;gap:6px;list-style:none}
        .pagination li{display:contents}
        .pagination a,
        .pagination span{
            min-width:40px;height:40px;display:grid;place-items:center;border-radius:10px;
            border:1px solid var(--border);background:var(--surface);
            cursor:pointer;transition:var(--transition);color:var(--text);font-size:14px;font-weight:500;padding:0 10px;
        }
        .pagination a:hover{background:var(--surface2);border-color:var(--border2)}
        .pagination .active span{
            background:var(--accent);border-color:var(--accent);color:#000;font-weight:700;
        }
        .pagination .disabled span{opacity:.3;cursor:not-allowed}

        /* ═══ FOOTER ═══ */
        .footer{
            margin-top:80px;border-top:1px solid var(--border);
            background:var(--surface);position:relative;overflow:hidden;
        }
        .footer::before{
            content:'';position:absolute;top:0;left:50%;transform:translateX(-50%);
            width:400px;height:1px;
            background:linear-gradient(90deg,transparent,var(--accent),transparent);
        }
        .footer-main{padding:48px 0 32px}
        .footer-grid{display:grid;grid-template-columns:1.8fr 1fr 1fr 1fr;gap:40px}
        .footer-brand p{color:var(--text3);font-size:13px;line-height:1.7;margin-top:16px;max-width:320px}
        .footer-col h4{
            font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;
            color:var(--text3);margin-bottom:16px;
        }
        .footer-col a{
            display:block;padding:6px 0;font-size:14px;color:var(--text2);
            transition:all .15s ease;
        }
        .footer-col a:hover{color:var(--accent);transform:translateX(4px)}
        .footer-bottom{
            padding:20px 0;border-top:1px solid var(--border);
            display:flex;justify-content:space-between;gap:16px;
            color:var(--text3);font-size:12px;flex-wrap:wrap;
        }

        /* ═══ ALERTS ═══ */
        .alert{padding:14px 18px;border-radius:var(--radius);margin-bottom:16px;font-size:14px;font-weight:500}
        .alert-success{background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.2);color:var(--success)}
        .alert-error{background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:var(--danger)}
        .alert-info{background:rgba(59,130,246,.08);border:1px solid rgba(59,130,246,.2);color:var(--info)}

        /* ═══ FORM ELEMENTS ═══ */
        input:focus,select:focus,textarea:focus{
            outline:none;border-color:var(--accent) !important;
            box-shadow:0 0 0 3px var(--accent-glow) !important;
        }
        ::selection{background:rgba(245,158,11,.25);color:var(--text)}

        /* ═══ UTILITY ═══ */
        .muted{color:var(--text2)}
        .muted2{color:var(--text3)}
        .star{color:var(--accent)}
        .strike{color:var(--text3);text-decoration:line-through;font-weight:500;margin-left:8px;font-size:.85em}
        .ico18{width:18px;height:18px}
        .ico20{width:20px;height:20px}
        .text-accent{color:var(--accent)}
        .divider{height:1px;background:var(--border);margin:32px 0}
        .section-label{
            font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;
            color:var(--accent);margin-bottom:8px;
        }

        /* ═══ RESPONSIVE ═══ */
        @media(max-width:980px){
            .nav{display:none}
            .burger{display:flex !important}
            .header-search{max-width:none}
            .toputil{display:none}
            .footer-grid{grid-template-columns:1fr 1fr}
        }
        @media(max-width:640px){
            .header-search{display:none}
            .footer-grid{grid-template-columns:1fr}
            .container{width:min(var(--max),100% - 32px)}
        }

        @media(prefers-reduced-motion:reduce){
            *,*::before,*::after{
                animation-duration:.01ms !important;
                transition-duration:.01ms !important;
            }
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
