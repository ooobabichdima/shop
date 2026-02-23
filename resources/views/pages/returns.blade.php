@extends('layouts.app')

@section('title', 'Повернення та обмін - Strikeball Shop')
@section('description', 'Умови повернення та обміну товарів в інтернет-магазині Strikeball Shop. Повернення коштів протягом 14 днів.')
@section('keywords', 'повернення товару, обмін страйкбол, повернення коштів')
@section('canonical', route('returns'))

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

    .content-section {
        margin-bottom: 32px;
    }

    .content-section h2 {
        font-size: 24px;
        margin: 0 0 16px;
    }

    .content-section h3 {
        font-size: 18px;
        margin: 24px 0 12px;
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

    .info-box {
        padding: 20px;
        border-radius: var(--radius);
        border: 1px solid rgba(56,189,248,.25);
        background: rgba(56,189,248,.08);
        margin: 20px 0;
    }

    .step-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
        margin: 20px 0;
    }

    .step-card {
        padding: 20px;
        border-radius: var(--radius);
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05);
    }

    .step-number {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--accent);
        color: #000;
        display: grid;
        place-items: center;
        font-weight: 900;
        font-size: 18px;
        margin-bottom: 12px;
    }

    .step-card h4 {
        margin: 0 0 8px;
        font-size: 16px;
    }

    .step-card p {
        margin: 0;
        font-size: 14px;
        color: var(--muted);
    }
</style>
@endpush

@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a> / <span>Повернення та обмін</span>
</div>

<div class="page-head">
    <span class="pill">Повернення</span>
    <h1>Повернення та обмін товарів</h1>
</div>

<div class="card" style="padding:32px;">
    <div class="highlight-box">
        <p style="margin:0;font-size:16px;font-weight:600;color:rgba(88,255,122,.95);">
            ✓ Повернення протягом 14 днів без пояснення причин<br>
            ✓ Повернення коштів протягом 3-5 робочих днів<br>
            ✓ Безкоштовний обмін на інший товар
        </p>
    </div>

    <div class="content-section">
        <h2>Умови повернення</h2>
        <p>Згідно із Законом України "Про захист прав споживачів", ви маєте право повернути товар належної якості протягом 14 днів з моменту покупки.</p>

        <h3>Товар можна повернути, якщо:</h3>
        <ul>
            <li>Збережено товарний вигляд та споживчі властивості товару</li>
            <li>Наявна оригінальна упаковка (коробка, пакет, плівка)</li>
            <li>Збережено всі ярлики, пломби, комплектуючі</li>
            <li>Товар не використовувався</li>
            <li>Наявний чек або інший документ, що підтверджує купівлю</li>
            <li>Не минуло 14 днів з моменту покупки</li>
        </ul>

        <div class="info-box">
            <p style="margin:0;font-weight:600;color:rgba(56,189,248,.95);">
                💡 Зверніть увагу: товар повинен бути в тому ж стані, в якому ви його отримали. Сліди експлуатації, подряпини або пошкодження є підставою для відмови у поверненні.
            </p>
        </div>
    </div>

    <div class="content-section">
        <h2>Як повернути товар</h2>
        <div class="step-cards">
            <div class="step-card">
                <div class="step-number">1</div>
                <h4>Зв'яжіться з нами</h4>
                <p>Телефонуйте або пишіть нам про бажання повернути товар. Ми узгодимо всі деталі.</p>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <h4>Упакуйте товар</h4>
                <p>Покладіть товар в оригінальну упаковку з усіма комплектуючими та чеком.</p>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <h4>Відправте нам</h4>
                <p>Відправте Новою Поштою на нашу адресу. Ми оплатимо доставку при отриманні.</p>
            </div>

            <div class="step-card">
                <div class="step-number">4</div>
                <h4>Отримайте гроші</h4>
                <p>Після перевірки товару ми повернемо кошти протягом 3-5 робочих днів.</p>
            </div>
        </div>
    </div>

    <div class="content-section">
        <h2>Обмін товару</h2>
        <p>Якщо вам не підійшов розмір, колір або модель - ми з радістю обміняємо товар на інший!</p>

        <h3>Умови обміну:</h3>
        <ul>
            <li>Обмін здійснюється <strong>безкоштовно</strong> (ми оплачуємо доставку)</li>
            <li>Товар повинен відповідати умовам повернення (не використаний, в упаковці)</li>
            <li>Обмін на товар <strong>такої ж</strong> або <strong>вищої вартості</strong></li>
            <li>Якщо новий товар дорожчий - доплачуєте різницю</li>
            <li>Якщо новий товар дешевший - повертаємо різницю</li>
        </ul>

        <p>Для обміну зв'яжіться з нашим менеджером та повідомте, який товар ви хочете отримати замість поточного.</p>
    </div>

    <div class="content-section">
        <h2>Повернення коштів</h2>
        <p><strong>Терміни повернення:</strong> 3-5 робочих днів після отримання та перевірки товару</p>

        <h3>Способи повернення коштів:</h3>
        <ul>
            <li><strong>На банківську карту</strong> - найшвидший спосіб (1-2 дні)</li>
            <li><strong>Готівкою</strong> - при самовивозі з нашого офісу</li>
            <li><strong>На розрахунковий рахунок</strong> - для юридичних осіб (3-5 днів)</li>
        </ul>

        <p style="color:var(--muted);font-size:14px;margin-top:16px;">
            * Вартість доставки товару до вас (якщо ви її оплачували) не компенсується при поверненні
        </p>
    </div>

    <div class="content-section">
        <h2>Товари, що не підлягають поверненню</h2>
        <p>Згідно з постановою КМУ №172, не підлягають поверненню:</p>
        <ul>
            <li><strong>Боєприпаси</strong> (кулі BB) - після розкриття упаковки</li>
            <li><strong>Витратні матеріали</strong> (газ, силікон, мастила) - після використання</li>
            <li><strong>Білизна</strong> (базовий шар, термобілизна) - з гігієнічних міркувань</li>
            <li><strong>Товари зі слідами використання</strong></li>
            <li><strong>Товари на замовлення</strong> (індивідуальне маркування, кастомізація)</li>
        </ul>
    </div>

    <div class="content-section">
        <h2>Повернення бракованого товару</h2>
        <p>Якщо товар виявився неякісним або несправним:</p>
        <ul>
            <li>Повернення можливе <strong>в будь-який час</strong> протягом гарантійного терміну</li>
            <li>Ми <strong>повністю оплачуємо</strong> доставку туди і назад</li>
            <li>Ви можете вибрати: <strong>ремонт</strong>, <strong>обмін</strong> або <strong>повернення коштів</strong></li>
            <li>Детальніше читайте на сторінці <a href="{{ route('warranty') }}" style="color:var(--accent);font-weight:600;">Гарантія</a></li>
        </ul>
    </div>

    <div class="content-section">
        <h2>Часті питання</h2>

        <h3>Чи можу я повернути товар, якщо він мені просто не сподобався?</h3>
        <p>Так, ви маєте право повернути товар належної якості протягом 14 днів без пояснення причин, якщо він не використовувався і збережена упаковка.</p>

        <h3>Хто оплачує доставку при поверненні?</h3>
        <p>При поверненні товару належної якості (не брак) доставку до нас оплачує покупець. Ми оплачуємо доставку при отриманні. При поверненні бракованого товару ми оплачуємо доставку в обидва боки.</p>

        <h3>Чи можна повернути товар, купленийний на акції або зі знижкою?</h3>
        <p>Так, акційні товари повертаються на загальних умовах. Ви отримаєте ту суму, яку заплатили.</p>

        <h3>Як швидко повернуться гроші?</h3>
        <p>Після отримання та перевірки товару ми повертаємо кошти протягом 3-5 робочих днів на карту або готівкою.</p>
    </div>

    <div class="content-section">
        <h2>Контакти для повернення</h2>
        <p>
            📞 Телефон: <a href="tel:+380123456789" style="color:var(--accent);font-weight:600;">+38 (012) 345-67-89</a><br>
            ✉️ Email: <a href="mailto:returns@strikeball-shop.com" style="color:var(--accent);font-weight:600;">returns@strikeball-shop.com</a><br>
            💬 Telegram: <a href="https://t.me/strikeballshop" target="_blank" rel="noopener" style="color:var(--accent);font-weight:600;">@strikeballshop</a>
        </p>
        <p style="margin-top:16px;padding:16px;border-radius:var(--radius);background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.10);">
            <strong>Адреса для повернення:</strong><br>
            Відділення Нової Пошти №1, м. Київ<br>
            Отримувач: Strikeball Shop<br>
            Телефон: +38 (012) 345-67-89
        </p>
    </div>
</div>

@endsection
