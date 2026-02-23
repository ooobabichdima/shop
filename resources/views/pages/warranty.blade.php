@extends('layouts.app')

@section('title', 'Гарантія - Strikeball Shop')
@section('description', 'Гарантійні умови на страйкбольне обладнання. Гарантійне та післягарантійне обслуговування.')
@section('keywords', 'гарантія страйкбол, гарантійне обслуговування, ремонт приводу')
@section('canonical', route('warranty'))

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

    .warranty-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .warranty-table th, .warranty-table td {
        padding: 12px;
        text-align: left;
        border: 1px solid rgba(255,255,255,.12);
    }

    .warranty-table th {
        background: rgba(255,255,255,.08);
        font-weight: 700;
    }

    .warranty-table td {
        background: rgba(255,255,255,.03);
    }

    .highlight-box {
        padding: 20px;
        border-radius: var(--radius);
        border: 1px solid rgba(88,255,122,.25);
        background: rgba(88,255,122,.08);
        margin: 20px 0;
    }

    .warning-box {
        padding: 20px;
        border-radius: var(--radius);
        border: 1px solid rgba(255,204,0,.25);
        background: rgba(255,204,0,.08);
        margin: 20px 0;
    }
</style>
@endpush

@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a> / <span>Гарантія</span>
</div>

<div class="page-head">
    <span class="pill">Гарантія</span>
    <h1>Гарантійне обслуговування</h1>
</div>

<div class="card" style="padding:32px;">
    <div class="highlight-box">
        <p style="margin:0;font-size:16px;font-weight:600;color:rgba(88,255,122,.95);">
            ✓ Офіційна гарантія на всі товари від виробника<br>
            ✓ Гарантійний та післягарантійний ремонт<br>
            ✓ Підтримка та консультації протягом усього терміну експлуатації
        </p>
    </div>

    <div class="content-section">
        <h2>Терміни гарантії</h2>
        <table class="warranty-table">
            <thead>
                <tr>
                    <th>Тип товару</th>
                    <th>Термін гарантії</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Приводи (AEG, GBB, Spring)</td>
                    <td><strong>6 місяців</strong></td>
                </tr>
                <tr>
                    <td>Оптика та прицільні пристрої</td>
                    <td><strong>3 місяці</strong></td>
                </tr>
                <tr>
                    <td>Акумулятори та зарядні пристрої</td>
                    <td><strong>3 місяці</strong></td>
                </tr>
                <tr>
                    <td>Тактичне спорядження</td>
                    <td><strong>6 місяців</strong></td>
                </tr>
                <tr>
                    <td>Захисне спорядження</td>
                    <td><strong>6 місяців</strong></td>
                </tr>
                <tr>
                    <td>Апгрейд та запчастини</td>
                    <td><strong>3 місяці</strong></td>
                </tr>
                <tr>
                    <td>Одяг та взуття</td>
                    <td><strong>14 днів</strong> (обмін)</td>
                </tr>
            </tbody>
        </table>
        <p style="color:var(--muted);font-size:14px;">
            * Термін гарантії відраховується з дати продажу (дати видачі товару покупцю)
        </p>
    </div>

    <div class="content-section">
        <h2>Гарантійні випадки</h2>
        <p>Гарантія поширюється на:</p>
        <ul>
            <li><strong>Заводський брак:</strong> дефекти матеріалів або збірки, допущені виробником</li>
            <li><strong>Несправності, що виникли при правильній експлуатації</strong> відповідно до інструкції</li>
            <li><strong>Відмова компонентів</strong> без зовнішнього механічного впливу</li>
        </ul>

        <h3>Що робити при виявленні несправності:</h3>
        <p><strong>Крок 1:</strong> Зв'яжіться з нами за телефоном або email</p>
        <p><strong>Крок 2:</strong> Опишіть проблему та надішліть фото/відео (якщо можливо)</p>
        <p><strong>Крок 3:</strong> Наш фахівець проконсультує вас та визначить, чи є це гарантійним випадком</p>
        <p><strong>Крок 4:</strong> За необхідності відправте товар до нас (ми оплатимо зворотну доставку)</p>
        <p><strong>Крок 5:</strong> Отримайте відремонтований або заміну товару</p>
    </div>

    <div class="content-section">
        <h2>Негарантійні випадки</h2>
        <div class="warning-box">
            <p style="margin:0;font-weight:600;color:rgba(255,204,0,.95);">⚠️ Гарантія НЕ поширюється на:</p>
        </div>
        <ul>
            <li><strong>Механічні пошкодження:</strong> удари, падіння, тріщини, сколи</li>
            <li><strong>Самостійна розбирання або ремонт</strong> (втрата гарантійних пломб)</li>
            <li><strong>Неправильна експлуатація:</strong> перегрів, використання неякісних акумуляторів або куль</li>
            <li><strong>Експлуатація за межами допустимих умов</strong> (наприклад, використання зимою GBB приводу)</li>
            <li><strong>Пошкодження від вологи</strong> (якщо привід не захищений від води)</li>
            <li><strong>Природний знос:</strong> витерті гумки Hop-Up, зношені шестерні після тривалої експлуатації</li>
            <li><strong>Використання неоригінальних запчастин</strong> без узгодження з нами</li>
            <li><strong>Відсутність чека або гарантійного талону</strong></li>
        </ul>
    </div>

    <div class="content-section">
        <h2>Післягарантійний ремонт</h2>
        <p>Після закінчення терміну гарантії ми продовжуємо надавати послуги ремонту:</p>
        <ul>
            <li><strong>Діагностика:</strong> безкоштовна оцінка несправності</li>
            <li><strong>Ремонт:</strong> оплата за роботу + вартість запчастин</li>
            <li><strong>Апгрейд:</strong> покращення характеристик вашого привода</li>
            <li><strong>Технічне обслуговування:</strong> чищення, змащування, регулювання</li>
        </ul>
        <p>Вартість ремонту обговорюється індивідуально після діагностики. Ми завжди узгоджуємо вартість з вами перед початком робіт.</p>
    </div>

    <div class="content-section">
        <h2>Обмін та повернення</h2>
        <p>Якщо товар вам не підійшов:</p>
        <ul>
            <li><strong>Протягом 14 днів</strong> з дати покупки ви можете повернути або обміняти товар</li>
            <li>Товар повинен бути в оригінальній упаковці, без слідів використання</li>
            <li>Повернення коштів здійснюється протягом 3-5 робочих днів</li>
            <li>Детальніше про умови повернення читайте на сторінці <a href="{{ route('returns') }}" style="color:var(--accent);font-weight:600;">Повернення та обмін</a></li>
        </ul>
    </div>

    <div class="content-section">
        <h2>Контакти для гарантійного обслуговування</h2>
        <p>
            📞 Телефон: <a href="tel:+380123456789" style="color:var(--accent);font-weight:600;">+38 (012) 345-67-89</a><br>
            ✉️ Email: <a href="mailto:warranty@strikeball-shop.com" style="color:var(--accent);font-weight:600;">warranty@strikeball-shop.com</a><br>
            💬 Telegram: <a href="https://t.me/strikeballshop" target="_blank" rel="noopener" style="color:var(--accent);font-weight:600;">@strikeballshop</a>
        </p>
        <p style="margin-top:20px;color:var(--muted);font-size:14px;">
            Ми завжди на зв'язку та готові допомогти вирішити будь-яке питання. Ваше задоволення - наш пріоритет!
        </p>
    </div>
</div>

@endsection
