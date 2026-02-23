@extends('layouts.app')

@section('title', 'Про нас - Strikeball Shop')
@section('description', 'Інтернет-магазин Strikeball Shop - якісне страйкбольне обладнання з 2018 року. Офіційний дилер провідних брендів.')
@section('keywords', 'про нас strikeball shop, магазин страйкбол україна')
@section('canonical', route('about'))

@push('styles')
<style>
    .page-head {
        padding: 24px;
        border-radius: var(--radius2);
        border: 1px solid rgba(255,255,255,.12);
        margin: 16px 0 24px;
        background: radial-gradient(700px 240px at 20% 0%, rgba(88,255,122,.18), transparent 60%),
                    radial-gradient(520px 220px at 86% 10%, rgba(56,189,248,.14), transparent 55%),
                    linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));
        box-shadow: var(--shadow);
    }

    .about-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 24px 0;
    }

    .stat-card {
        padding: 24px;
        text-align: center;
        border-radius: var(--radius);
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05);
        box-shadow: 0 10px 30px rgba(0,0,0,.30);
    }

    .stat-number {
        font-size: 48px;
        font-weight: 900;
        line-height: 1;
        background: linear-gradient(135deg, rgba(88,255,122,.95), rgba(56,189,248,.95));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        margin-top: 8px;
        color: var(--muted);
        font-size: 14px;
    }

    .content-section {
        margin-bottom: 32px;
    }

    .content-section h2 {
        font-size: 24px;
        margin: 0 0 16px;
    }

    .content-section p {
        color: rgba(255,255,255,.80);
        line-height: 1.7;
        margin: 12px 0;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin: 24px 0;
    }

    .value-card {
        padding: 20px;
        border-radius: var(--radius);
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05);
    }

    .value-icon {
        font-size: 36px;
        margin-bottom: 12px;
    }

    .value-card h3 {
        margin: 0 0 8px;
        font-size: 18px;
    }

    .value-card p {
        margin: 0;
        font-size: 14px;
        color: var(--muted);
    }
</style>
@endpush

@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a> / <span>Про нас</span>
</div>

<div class="page-head">
    <span class="pill">Про нас</span>
    <h1>Strikeball Shop - ваш провідник у світ страйкболу</h1>
</div>

<div class="about-stats">
    <div class="stat-card">
        <div class="stat-number">6+</div>
        <div class="stat-label">Років на ринку</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">5000+</div>
        <div class="stat-label">Задоволених клієнтів</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">2000+</div>
        <div class="stat-label">Товарів в асортименті</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">30+</div>
        <div class="stat-label">Відомих брендів</div>
    </div>
</div>

<div class="card" style="padding:32px;">
    <div class="content-section">
        <h2>Хто ми</h2>
        <p>
            <strong>Strikeball Shop</strong> - це провідний інтернет-магазин страйкбольного обладнання в Україні.
            Ми почали свою роботу у 2018 році з однієї простої мети: зробити страйкбол доступним для кожного.
        </p>
        <p>
            За ці роки ми виросли з невеликої команди ентузіастів у професійну компанію з повним циклом обслуговування:
            від консультації при виборі першого привода до післягарантійного обслуговування та апгрейду.
        </p>
        <p>
            Сьогодні нам довіряють тисячі гравців по всій Україні - від новачків до досвідчених страйкболістів та
            команд. Ми пишаємося тим, що змогли допомогти багатьом людям знайти своє хобі та спільноту однодумців.
        </p>
    </div>

    <div class="content-section">
        <h2>Наші цінності</h2>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">✓</div>
                <h3>Якість</h3>
                <p>Працюємо тільки з перевіреними виробниками. Кожен товар проходить контроль якості перед відправкою.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">🤝</div>
                <h3>Чесність</h3>
                <p>Завжди говоримо правду про товар. Не приховуємо недоліки і даємо об'єктивні рекомендації.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">⚡</div>
                <h3>Швидкість</h3>
                <p>Відправляємо замовлення в день оформлення. Оперативно відповідаємо на запитання та вирішуємо проблеми.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">💡</div>
                <h3>Експертність</h3>
                <p>Наша команда - досвідчені страйкболісти. Ми знаємо продукцію зсередини і можемо дати професійну пораду.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">🛡️</div>
                <h3>Надійність</h3>
                <p>Офіційна гарантія, підтримка після покупки, власний сервісний центр. Ми відповідаємо за свої товари.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">❤️</div>
                <h3>Спільнота</h3>
                <p>Розвиваємо страйкбольну спільноту в Україні. Організовуємо івенти, підтримуємо команди та новачків.</p>
            </div>
        </div>
    </div>

    <div class="content-section">
        <h2>Що ми пропонуємо</h2>
        <ul style="color:rgba(255,255,255,.80);line-height:1.8;font-size:15px;">
            <li><strong>Великий асортимент:</strong> понад 2000 найменувань від 30+ брендів</li>
            <li><strong>Офіційне дилерство:</strong> працюємо напряму з виробниками, гарантуємо оригінальність</li>
            <li><strong>Консультації:</strong> допоможемо підібрати обладнання під ваші потреби та бюджет</li>
            <li><strong>Сервісний центр:</strong> гарантійний та післягарантійний ремонт, апгрейд</li>
            <li><strong>Швидка доставка:</strong> відправка в день замовлення, доставка по всій Україні</li>
            <li><strong>Гнучкі умови оплати:</strong> готівка, карта, накладений платіж, для юросіб</li>
            <li><strong>Офлайн точка:</strong> можна оглянути та протестувати товар (за домовленістю)</li>
        </ul>
    </div>

    <div class="content-section">
        <h2>Наша місія</h2>
        <p>
            Ми хочемо, щоб <strong>кожен</strong> в Україні мав можливість займатися страйкболом незалежно від
            досвіду та бюджету. Тому ми пропонуємо обладнання в різних цінових категоріях - від початкових
            моделей для новачків до топових приводів для професіоналів.
        </p>
        <p>
            Ми віримо, що страйкбол - це не просто хобі, а спосіб життя. Це командна робота, дисципліна,
            активний відпочинок на природі та чудова можливість знайти нових друзів.
        </p>
        <p>
            Наша мета - зробити український страйкбол кращим: більше гравців, більше команд, більше якісних
            івентів. І ми рухаємося до цієї мети разом з вами!
        </p>
    </div>

    <div class="content-section">
        <h2>Чому нам довіряють</h2>
        <p><strong>Відгуки наших клієнтів:</strong></p>
        <div style="display:grid;gap:16px;margin-top:20px;">
            <div style="padding:20px;border-radius:var(--radius);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.10);">
                <p style="margin:0 0 12px;font-style:italic;">"Купував свій перший привід тут. Менеджер допоміг підібрати все необхідне, пояснив як користуватися. Доставка швидка, товар якісний. Рекомендую!"</p>
                <p style="margin:0;color:var(--muted);font-size:14px;">— Олексій, Київ</p>
            </div>

            <div style="padding:20px;border-radius:var(--radius);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.10);">
                <p style="margin:0 0 12px;font-style:italic;">"Замовляю тут вже третій рік. Великий вибір, адекватні ціни, швидка доставка. Є проблема - завжди допоможуть вирішити. Топовий магазин!"</p>
                <p style="margin:0;color:var(--muted);font-size:14px;">— Дмитро, Львів</p>
            </div>

            <div style="padding:20px;border-radius:var(--radius);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.10);">
                <p style="margin:0 0 12px;font-style:italic;">"Привід зламався через місяць. Здав на гарантію - за тиждень повернули відремонтований. Працює чудово. Дякую за сервіс!"</p>
                <p style="margin:0;color:var(--muted);font-size:14px;">— Андрій, Одеса</p>
            </div>
        </div>
    </div>

    <div class="content-section">
        <h2>Зв'яжіться з нами</h2>
        <p>
            Маєте питання? Хочете стати нашим партнером? Або просто хочете поговорити про страйкбол?
        </p>
        <p>
            Ми завжди раді спілкуванню! Пишіть, телефонуйте, завітайте в гості.
        </p>
        <p style="margin-top:20px;">
            📞 Телефон: <a href="tel:+380123456789" style="color:var(--accent);font-weight:600;">+38 (012) 345-67-89</a><br>
            ✉️ Email: <a href="mailto:info@strikeball-shop.com" style="color:var(--accent);font-weight:600;">info@strikeball-shop.com</a><br>
            💬 Telegram: <a href="https://t.me/strikeballshop" target="_blank" rel="noopener" style="color:var(--accent);font-weight:600;">@strikeballshop</a><br>
            📍 Адреса: м. Київ, вул. Хрещатик, 1
        </p>
        <p style="margin-top:20px;">
            <a href="{{ route('contacts') }}" class="btn primary">Детальніше про контакти</a>
        </p>
    </div>
</div>

@endsection
