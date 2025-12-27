<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>

    <style>
    :root{--bg:#070a0f;--panel:rgba(255,255,255,.06);--text:rgba(255,255,255,.92);--muted:rgba(255,255,255,.65);--line:rgba(255,255,255,.12);--accent:#58ff7a;--accent2:#22c55e;--radius:18px;--max:1180px;--h1:clamp(24px,2.8vw,38px);--h2:clamp(20px,2.2vw,30px);}
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;}
    body{font-family:system-ui,-apple-system,sans-serif;background:radial-gradient(1200px 600px at 12% -10%,rgba(88,255,122,.22),transparent 60%),radial-gradient(900px 500px at 90% 0%,rgba(56,189,248,.18),transparent 60%),linear-gradient(180deg,#05070b,#070a0f 20%,#060912);color:var(--text);line-height:1.45;}
    .container{width:min(var(--max),calc(100% - 32px));margin:0 auto;}
    .btn{display:inline-flex;align-items:center;gap:10px;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);cursor:pointer;text-decoration:none;}
    .btn.primary{background:linear-gradient(180deg,rgba(88,255,122,.95),rgba(34,197,94,.92));border-color:rgba(88,255,122,.35);color:#031107;font-weight:900;}
    .card{border-radius:var(--radius);border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.05);padding:16px;}
    h1{font-size:var(--h1);margin:0;}
    h2{font-size:var(--h2);margin:0;}
    </style>

    @stack('styles')
</head>
<body>
    @include('components.header')

    <main class="container" style="min-height:60vh;padding:20px 0;">
        @if(session('success'))
            <div style="padding:12px;border-radius:12px;background:rgba(88,255,122,.1);border:1px solid rgba(88,255,122,.3);margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="padding:12px;border-radius:12px;background:rgba(255,77,77,.1);border:1px solid rgba(255,77,77,.3);margin-bottom:20px;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
</body>
</html>
