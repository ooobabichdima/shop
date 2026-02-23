@extends('layouts.app')

@section('title', 'Оплата - Strikeball Shop')
@section('description', 'Способи оплати в інтернет-магазині Strikeball Shop: готівка, банківська карта, накладений платіж, безготівковий розрахунок.')
@section('keywords', 'оплата страйкбол, способи оплати, накладений платіж')
@section('canonical', route('payment'))

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

    .payment-methods {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin: 24px 0;
    }

    .payment-card {
        padding: 24px;
        border-radius: var(--radius);
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05);
        box-shadow: 0 10px 30px rgba(0,0,0,.30);
        transition: transform .12s ease;
    }
    .payment-card:hover {
        transform: translateY(-2px);
    }

    .payment-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        font-size: 28px;
        margin-bottom: 16px;
        border: 1px solid rgba(255,255,255,.10);
        background: radial-gradient(80px 80px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
                    linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
    }

    .payment-card h3 {
        margin: 0 0 12px;
        font-size: 18px;
        font-weight: 780;
    }

    .payment-card p {
        margin: 8px 0;
        color: rgba(255,255,255,.75);
        font-size: 14px;
        line-height: 1.6;
    }

    .payment-card .pros {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid rgba(255,255,255,.10);
        font-size: 13px;
        color: var(--muted);
    }

    .content-section {
        margin-bottom: 32px;
    }

    .content-section h2 {
        font-size: 24px;
        margin: 0 0 16px;
    }

    .content-section p, .content-section ul {
        color: rgba(255,255,255,.80);
        line-height: 1.7;
        margin: 12px 0;
    }

    .content-section ul {
        padding-left: 24px;
    }

    .content-section li {
        margin: 8px 0;
    }
</style>
@endpush

@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a> / <span>Оплата</span>
</div>

<div class="page-head">
    <span class="pill">Оплата</span>
    <h1>Способи оплати</h1>
</div>

<div class="payment-methods">
    <div class="payment-card">
        <div class="payment-icon">💵</div>
        <h3>Готівка при отриманні</h3>
        <p>Оплата готівкою кур'єру або у відділенні Нової Пошти після огляду товару.</p>
        <div class="pros">
            ✓ Найпопулярніший спосіб<br>
            ✓ Можна оглянути товар<br>
            ✓ Без комісій
        </div>
    </div>

    <div class="payment-card">
        <div class="payment-icon">💳</div>
        <h3>Оплата на карту</h3>
        <p>Передоплата на банківську карту ПриватБанку або Monobank. Швидка обробка замовлення.</p>
        <div class="pros">
            ✓ Швидка відправка<br>
            ✓ Без комісій<br>
            ✓ Зручно онлайн
        </div>
    </div>

    <div class="payment-card">
        <div class="payment-icon">📦</div>
        <h3>Накладений платіж</h3>
        <p>Оплата через Нову Пошту при отриманні товару. Комісія Нової Пошти 20 грн + 2% від суми.</p>
        <div class="pros">
            ✓ Безпечно<br>
            ✓ Зручно для регіонів<br>
            ✗ Є комісія НП
        </div>
    </div>

    <div class="payment-card">
        <div class="payment-icon">🏦</div>
        <h3>Безготівковий розрахунок</h3>
        <p>Оплата за реквізитами для юридичних осіб та ФОП. Виставляємо рахунок.</p>
        <div class="pros">
            ✓ Для юросіб<br>
            ✓ З ПДВ та без ПДВ<br>
            ✓ Повний пакет документів
        </div>
    </div>
</div>

<div class="card" style="padding:32px;">
    <div class="content-section">
        <h2>Як оплатити замовлення</h2>

        <h3 style="margin-top:24px;">Готівкою при отриманні</h3>
        <p><strong>Крок 1:</strong> Оформіть замовлення на сайті або за телефоном</p>
        <p><strong>Крок 2:</strong> Дочекайтеся дзвінка менеджера для підтвердження</p>
        <p><strong>Крок 3:</strong> Отримайте ТТН для відстеження</p>
        <p><strong>Крок 4:</strong> Оплатіть товар при отриманні у відділенні або кур'єру</p>
        <p style="color:var(--muted);font-size:14px;margin-top:16px;">
            💡 Ви можете оглянути товар перед оплатою у присутності співробітника Нової Пошти
        </p>
    </div>

    <div class="content-section">
        <h3>Оплата на карту (передоплата)</h3>
        <p><strong>Крок 1:</strong> Оформіть замовлення</p>
        <p><strong>Крок 2:</strong> Отримайте реквізити для оплати від менеджера</p>
        <p><strong>Крок 3:</strong> Здійсніть переказ на вказану картку</p>
        <p><strong>Крок 4:</strong> Надішліть скріншот оплати менеджеру</p>
        <p><strong>Крок 5:</strong> Ми відправимо товар протягом 1-2 годин</p>

        <div style="margin-top:20px;padding:16px;border-radius:var(--radius);background:rgba(56,189,248,.08);border:1px solid rgba(56,189,248,.20);">
            <p style="margin:0;color:rgba(56,189,248,.95);font-weight:600;">Номер карти для оплати:</p>
            <p style="margin:8px 0 0;font-size:18px;font-weight:800;letter-spacing:1px;">5168 7422 1234 5678</p>
            <p style="margin:4px 0 0;color:var(--muted);font-size:13px;">ПриватБанк | Отримувач: Іванов Іван Іванович</p>
        </div>
    </div>

    <div class="content-section">
        <h3>Накладений платіж</h3>
        <p>При виборі цього способу:</p>
        <ul>
            <li>Ви оплачуєте товар при отриманні у відділенні Нової Пошти</li>
            <li>Додається комісія Нової Пошти: 20 грн + 2% від суми замовлення</li>
            <li>Гроші переводяться на наш рахунок протягом 1-2 робочих днів</li>
            <li>Ви можете оглянути товар перед оплатою</li>
        </ul>
        <p style="color:var(--muted);font-size:14px;margin-top:16px;">
            💡 Рекомендуємо для замовлень до 2000 грн. Для більших сум вигідніше оплата на карту.
        </p>
    </div>

    <div class="content-section">
        <h3>Безготівковий розрахунок</h3>
        <p>Для юридичних осіб та ФОП ми пропонуємо:</p>
        <ul>
            <li>Роботу з ПДВ та без ПДВ</li>
            <li>Виставлення рахунку</li>
            <li>Повний пакет документів (накладна, рахунок-фактура, сертифікати)</li>
            <li>Можливість відстрочки платежу для постійних клієнтів</li>
        </ul>
        <p style="margin-top:16px;">
            Для отримання реквізитів та оформлення замовлення зв'яжіться з нашим менеджером за телефоном
            <a href="tel:+380123456789" style="color:var(--accent);font-weight:600;">+38 (012) 345-67-89</a>
        </p>
    </div>

    <div class="content-section">
        <h2>Часті питання</h2>

        <h3 style="margin-top:20px;">Чи безпечно платити на карту?</h3>
        <p>Так, це абсолютно безпечно. Ми працюємо з 2018 року та маємо сотні позитивних відгуків. Після оплати ви отримуєте ТТН протягом 1-2 годин.</p>

        <h3 style="margin-top:20px;">Чи можна оплатити частково?</h3>
        <p>Так, ви можете оплатити частину суми на карту, а решту готівкою при отриманні. Узгодьте це з менеджером.</p>

        <h3 style="margin-top:20px;">Чи є розстрочка або кредит?</h3>
        <p>Наразі ми працюємо над впровадженням сервісів ПриватБанк Частинами та Monobank Оплата Частинами. Слідкуйте за оновленнями.</p>
    </div>
</div>

@endsection
