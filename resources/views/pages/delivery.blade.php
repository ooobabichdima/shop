@extends('layouts.app')

@section('title', 'Доставка - Strikeball Shop')
@section('description', 'Умови доставки страйкбольного обладнання Новою Поштою по всій Україні. Швидка відправка, безкоштовна доставка від 3000 грн.')
@section('keywords', 'доставка страйкбол, нова пошта, безкоштовна доставка')
@section('canonical', route('delivery'))

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
    .page-head h1 {
        margin: 0 0 8px;
        font-size: var(--h1);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin: 24px 0;
    }

    .info-card {
        padding: 24px;
        border-radius: var(--radius);
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05);
        box-shadow: 0 10px 30px rgba(0,0,0,.30);
    }

    .info-card-icon {
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

    .info-card h3 {
        margin: 0 0 12px;
        font-size: 18px;
        font-weight: 780;
    }

    .info-card p {
        margin: 8px 0;
        color: rgba(255,255,255,.80);
        font-size: 14px;
        line-height: 1.6;
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

    .highlight-box {
        padding: 20px;
        border-radius: var(--radius);
        border: 1px solid rgba(88,255,122,.25);
        background: rgba(88,255,122,.08);
        margin: 20px 0;
    }

    .highlight-box p {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: rgba(88,255,122,.95);
    }
</style>
@endpush

@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a> / <span>Доставка</span>
</div>

<div class="page-head">
    <span class="pill">Доставка</span>
    <h1>Доставка та оплата</h1>
</div>

<div class="info-grid">
    <div class="info-card">
        <div class="info-card-icon">📦</div>
        <h3>Нова Пошта</h3>
        <p>Доставка у відділення або поштомат по всій Україні. Найпопулярніший та найшвидший спосіб доставки.</p>
    </div>

    <div class="info-card">
        <div class="info-card-icon">🚚</div>
        <h3>Кур'єр Нової Пошти</h3>
        <p>Адресна доставка до дверей. Доступна у великих містах України.</p>
    </div>

    <div class="info-card">
        <div class="info-card-icon">🏪</div>
        <h3>Самовивіз</h3>
        <p>Безкоштовно з нашого офісу в Києві за попереднім дзвінком.</p>
    </div>
</div>

<div class="card" style="padding:32px;">
    <div class="highlight-box">
        <p>🎁 Безкоштовна доставка при замовленні від 3000 грн!</p>
    </div>

    <div class="content-section">
        <h2>Умови доставки</h2>

        <h3 style="margin-top:24px;">Доставка Новою Поштою</h3>
        <ul>
            <li><strong>Вартість:</strong> згідно тарифів Нової Пошти (оплачує отримувач при отриманні)</li>
            <li><strong>Термін:</strong> 1-3 робочих дні після відправки</li>
            <li><strong>Безкоштовно:</strong> при замовленні від 3000 грн (оплачуємо доставку за вас)</li>
            <li><strong>Упаковка:</strong> надійна упаковка у фірмову коробку</li>
        </ul>

        <h3 style="margin-top:24px;">Кур'єрська доставка</h3>
        <ul>
            <li><strong>Вартість:</strong> згідно тарифів Нової Пошти</li>
            <li><strong>Термін:</strong> наступний день після відправки (для великих міст)</li>
            <li><strong>Безкоштовно:</strong> при замовленні від 5000 грн</li>
        </ul>

        <h3 style="margin-top:24px;">Самовивіз</h3>
        <ul>
            <li><strong>Вартість:</strong> безкоштовно</li>
            <li><strong>Адреса:</strong> м. Київ, вул. Хрещатик, 1</li>
            <li><strong>Графік:</strong> Пн-Пт 9:00-18:00, Сб 10:00-16:00</li>
            <li><strong>Важливо:</strong> попередньо телефонуйте для підтвердження наявності товару</li>
        </ul>
    </div>

    <div class="content-section">
        <h2>Як ми відправляємо</h2>
        <p><strong>Крок 1:</strong> Ви робите замовлення на сайті або за телефоном</p>
        <p><strong>Крок 2:</strong> Ми обробляємо замовлення протягом 1-2 годин (у робочий час)</p>
        <p><strong>Крок 3:</strong> Зв'язуємося з вами для підтвердження</p>
        <p><strong>Крок 4:</strong> Пакуємо товар та відправляємо в той самий або наступний день</p>
        <p><strong>Крок 5:</strong> Надсилаємо вам ТТН для відстеження посилки</p>
    </div>

    <div class="content-section">
        <h2>Способи оплати</h2>
        <ul>
            <li><strong>Готівкою при отриманні</strong> (доступна повна або часткова оплата при отриманні)</li>
            <li><strong>Накладений платіж</strong> Новою Поштою (комісія 20 грн + 2% від суми)</li>
            <li><strong>Безготівковий розрахунок</strong> на банківську карту (передоплата)</li>
            <li><strong>Банківський переказ</strong> для юридичних осіб</li>
        </ul>
    </div>

    <div class="content-section">
        <h2>Часті питання</h2>

        <h3 style="margin-top:20px;">Коли ви відправите моє замовлення?</h3>
        <p>Замовлення, оформлені до 16:00, відправляються в той самий день. Замовлення після 16:00 - наступного робочого дня.</p>

        <h3 style="margin-top:20px;">Чи можна оглянути товар перед оплатою?</h3>
        <p>Так, ви можете оглянути товар у відділенні Нової Пошти перед оплатою. Огляд у присутності співробітника Нової Пошти.</p>

        <h3 style="margin-top:20px;">Що робити, якщо товар пошкоджений при доставці?</h3>
        <p>Негайно складіть акт про пошкодження у відділенні Нової Пошти та зв'яжіться з нами. Ми вирішимо питання заміни або повернення коштів.</p>
    </div>
</div>

@endsection
