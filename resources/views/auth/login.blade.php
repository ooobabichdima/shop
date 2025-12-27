@extends('layouts.app')

@section('title', 'Вхід - Strikeball Shop')

@section('content')
<div style="padding:40px 0;">
    <div class="card" style="max-width:400px;margin:0 auto;">
        <h1 style="margin-bottom:24px;text-align:center;">Вхід</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div style="margin-bottom:16px;">
                <label style="display:block;margin-bottom:4px;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       style="width:100%;padding:12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);">
                @error('email')<div style="color:rgba(255,77,77,.9);font-size:14px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;margin-bottom:4px;">Пароль</label>
                <input type="password" name="password" required
                       style="width:100%;padding:12px;border-radius:12px;border:1px solid rgba(255,255,255,.14);background:rgba(255,255,255,.06);color:var(--text);">
                @error('password')<div style="color:rgba(255,77,77,.9);font-size:14px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:flex;align-items:center;gap:8px;">
                    <input type="checkbox" name="remember">
                    <span>Запам'ятати мене</span>
                </label>
            </div>

            <button type="submit" class="btn primary" style="width:100%;justify-content:center;">
                Увійти
            </button>
        </form>

        <div style="margin-top:20px;text-align:center;color:rgba(255,255,255,.65);font-size:14px;">
            <p>Тестовий адмін: admin@example.com / password</p>
        </div>
    </div>
</div>
@endsection
