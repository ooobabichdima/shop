@extends('layouts.app')

@section('title', 'Контакти - Strikeball Shop')
@section('description', 'Контактна інформація інтернет-магазину Strikeball Shop. Телефон, email, адреса та графік роботи.')
@section('keywords', 'контакти strikeball shop, телефон магазину страйкбол, адреса магазину')
@section('canonical', route('contacts'))

@push('styles')
<style>
    .contacts-head {
        padding: 24px;
        border-radius: var(--radius2);
        border: 1px solid rgba(255,255,255,.12);
        margin: 16px 0 24px;
        background: radial-gradient(700px 240px at 20% 0%, rgba(88,255,122,.18), transparent 60%),
                    radial-gradient(520px 220px at 86% 10%, rgba(56,189,248,.14), transparent 55%),
                    linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));
        box-shadow: var(--shadow);
    }
    .contacts-head h1 {
        margin: 0 0 12px;
        font-size: var(--h1);
    }
    .contacts-head p {
        margin: 0;
        color: var(--muted);
        max-width: 72ch;
    }

    .contacts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .contact-card {
        padding: 24px;
        border-radius: var(--radius);
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05);
        box-shadow: 0 10px 30px rgba(0,0,0,.30);
    }

    .contact-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        font-size: 24px;
        margin-bottom: 16px;
        border: 1px solid rgba(255,255,255,.10);
        background: radial-gradient(80px 80px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
                    linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
    }

    .contact-card h3 {
        margin: 0 0 12px;
        font-size: 18px;
        font-weight: 780;
    }

    .contact-card p {
        margin: 8px 0;
        color: rgba(255,255,255,.80);
        font-size: 15px;
        line-height: 1.6;
    }

    .contact-card a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
    }
    .contact-card a:hover {
        text-decoration: underline;
    }

    .contact-card .meta {
        color: var(--muted);
        font-size: 13px;
        margin-top: 4px;
    }

    @media (max-width: 768px) {
        .contacts-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a> / <span>Контакти</span>
</div>

<div class="contacts-head">
    <span class="pill">Контакти</span>
    <h1>Зв'яжіться з нами</h1>
    <p>Маєте питання? Наша команда завжди готова вам допомогти. Оберіть зручний спосіб зв'язку.</p>
</div>

<div class="contacts-grid">
    <div class="contact-card">
        <div class="contact-icon">📞</div>
        <h3>Телефон</h3>
        <p><a href="tel:+380123456789">+38 (012) 345-67-89</a></p>
        <p class="meta">Пн-Пт: 9:00 - 18:00<br>Сб: 10:00 - 16:00<br>Нд: вихідний</p>
    </div>

    <div class="contact-card">
        <div class="contact-icon">✉️</div>
        <h3>Email</h3>
        <p><a href="mailto:info@strikeball-shop.com">info@strikeball-shop.com</a></p>
        <p class="meta">Відповідаємо протягом 24 годин</p>
    </div>

    <div class="contact-card">
        <div class="contact-icon">💬</div>
        <h3>Telegram</h3>
        <p><a href="https://t.me/strikeballshop" target="_blank" rel="noopener">@strikeballshop</a></p>
        <p class="meta">Швидка відповідь в робочий час</p>
    </div>

    <div class="contact-card">
        <div class="contact-icon">📍</div>
        <h3>Адреса</h3>
        <p>м. Київ, вул. Хрещатик, 1</p>
        <p class="meta">Самовивіз за домовленістю</p>
    </div>

    <div class="contact-card">
        <div class="contact-icon">🕐</div>
        <h3>Графік роботи</h3>
        <p>
            Понеділок - П'ятниця: 9:00 - 18:00<br>
            Субота: 10:00 - 16:00<br>
            Неділя: вихідний
        </p>
        <p class="meta">Самовивіз лише за попереднім дзвінком</p>
    </div>

    <div class="contact-card">
        <div class="contact-icon">📱</div>
        <h3>Соціальні мережі</h3>
        <p>
            <a href="https://instagram.com/strikeballshop" target="_blank" rel="noopener">Instagram</a><br>
            <a href="https://facebook.com/strikeballshop" target="_blank" rel="noopener">Facebook</a><br>
            <a href="https://t.me/strikeballshop_channel" target="_blank" rel="noopener">Telegram канал</a>
        </p>
        <p class="meta">Слідкуйте за новинами та акціями</p>
    </div>
</div>

<div class="card" style="padding:32px;">
    <h2 style="margin-top:0;">Форма зворотного зв'язку</h2>
    <p style="color:var(--muted);margin-bottom:24px;">Залиште ваше повідомлення, і ми зв'яжемося з вами найближчим часом</p>

    <form method="POST" action="{{ route('contact.submit') }}" style="max-width:600px;">
        @csrf
        <div style="display:grid;gap:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;">Ім'я *</label>
                <input type="text" name="name" required class="in" style="width:100%;" placeholder="Ваше ім'я">
            </div>

            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;">Телефон *</label>
                <input type="tel" name="phone" required class="in" style="width:100%;" placeholder="+38 (0__) ___-__-__">
            </div>

            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;">Email</label>
                <input type="email" name="email" class="in" style="width:100%;" placeholder="email@example.com">
            </div>

            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;">Повідомлення *</label>
                <textarea name="message" required rows="6" class="in" style="width:100%;resize:vertical;" placeholder="Ваше питання або повідомлення"></textarea>
            </div>

            <button type="submit" class="btn primary">Відправити повідомлення</button>
        </div>
    </form>
</div>

@if(session('success'))
<script>
    alert('{{ session('success') }}');
</script>
@endif

@endsection
