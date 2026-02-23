@extends('layouts.app')

@section('title', 'Б/У ринок - Продати свій привід - Strikeball Shop')
@section('description', 'Продайте свій б/у привід через Strikeball Shop. Залиште заявку, і ми допоможемо знайти покупця.')
@section('keywords', 'продати страйкбольний привід, б/у страйкбол, вторинний ринок airsoft')
@section('canonical', route('used-market'))

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
        margin: 0 0 12px;
        font-size: var(--h1);
    }

    .page-head p {
        margin: 0;
        color: var(--muted);
        max-width: 72ch;
    }

    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin: 24px 0;
    }

    .benefit-card {
        padding: 20px;
        border-radius: var(--radius);
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.05);
        box-shadow: 0 10px 30px rgba(0,0,0,.30);
    }

    .benefit-icon {
        font-size: 36px;
        margin-bottom: 12px;
    }

    .benefit-card h3 {
        margin: 0 0 8px;
        font-size: 16px;
        font-weight: 780;
    }

    .benefit-card p {
        margin: 0;
        font-size: 14px;
        color: var(--muted);
        line-height: 1.6;
    }

    .form-section {
        max-width: 700px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: rgba(255,255,255,.90);
    }

    .form-label .required {
        color: rgba(255,100,100,.95);
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,.14);
        background: rgba(0,0,0,.18);
        color: var(--text);
        outline: none;
        font-size: 15px;
        font-family: inherit;
        transition: all .15s ease;
    }

    .form-input:focus {
        border-color: var(--accent);
        background: rgba(0,0,0,.25);
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-select {
        width: 100%;
        padding: 12px 16px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,.14);
        background: rgba(0,0,0,.18);
        color: var(--text);
        outline: none;
        font-size: 15px;
        font-family: inherit;
        cursor: pointer;
    }

    .form-hint {
        margin-top: 6px;
        font-size: 13px;
        color: var(--muted);
    }

    .radio-group {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 12px;
        margin-top: 8px;
    }

    .radio-label {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,.12);
        background: rgba(255,255,255,.03);
        cursor: pointer;
        transition: all .12s ease;
    }

    .radio-label:hover {
        background: rgba(255,255,255,.06);
        border-color: rgba(255,255,255,.20);
    }

    .radio-label input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: var(--accent);
    }

    .radio-label input[type="radio"]:checked + span {
        font-weight: 700;
        color: var(--text);
    }

    .photo-upload {
        padding: 24px;
        border-radius: 14px;
        border: 2px dashed rgba(255,255,255,.20);
        background: rgba(255,255,255,.03);
        text-align: center;
        cursor: pointer;
        transition: all .15s ease;
    }

    .photo-upload:hover {
        border-color: var(--accent);
        background: rgba(88,255,122,.06);
    }

    .photo-upload-icon {
        font-size: 48px;
        margin-bottom: 12px;
        opacity: .5;
    }

    .success-message {
        padding: 20px;
        border-radius: var(--radius);
        border: 1px solid rgba(88,255,122,.25);
        background: rgba(88,255,122,.08);
        margin-bottom: 24px;
        text-align: center;
    }

    .success-message h3 {
        margin: 0 0 8px;
        color: rgba(88,255,122,.95);
        font-size: 20px;
    }

    .success-message p {
        margin: 0;
        color: rgba(255,255,255,.80);
    }
</style>
@endpush

@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a> / <span>Б/У ринок</span>
</div>

<div class="page-head">
    <span class="pill">Б/У ринок</span>
    <h1>Продати свій б/у привід</h1>
    <p>Хочете продати свій страйкбольний привід? Залиште заявку, і ми допоможемо знайти покупця!</p>
</div>

@if(session('success'))
<div class="success-message">
    <h3>✓ Заявка успішно відправлена!</h3>
    <p>{{ session('success') }}</p>
</div>
@endif

<div class="benefits-grid">
    <div class="benefit-card">
        <div class="benefit-icon">🤝</div>
        <h3>Безпечна угода</h3>
        <p>Ми виступаємо посередником та гарантуємо чесність угоди</p>
    </div>

    <div class="benefit-card">
        <div class="benefit-icon">💰</div>
        <h3>Справедлива ціна</h3>
        <p>Допоможемо оцінити ваш привід за ринковою вартістю</p>
    </div>

    <div class="benefit-card">
        <div class="benefit-icon">📸</div>
        <h3>Якісні фото</h3>
        <p>Зробимо професійні фото вашого товару</p>
    </div>

    <div class="benefit-card">
        <div class="benefit-icon">🎯</div>
        <h3>Швидкий продаж</h3>
        <p>Велика аудиторія потенційних покупців</p>
    </div>
</div>

<div class="card" style="padding:32px;">
    <div class="form-section">
        <h2 style="margin-top:0;">Форма подачі заявки</h2>
        <p style="color:var(--muted);margin-bottom:32px;">
            Заповніть форму нижче, і наш менеджер зв'яжеться з вами протягом 24 годин для уточнення деталей.
        </p>

        <form method="POST" action="{{ route('used-market.submit') }}" enctype="multipart/form-data">
            @csrf

            <h3 style="margin:0 0 20px;font-size:18px;">Контактна інформація</h3>

            <div class="form-group">
                <label class="form-label">
                    Ваше ім'я <span class="required">*</span>
                </label>
                <input type="text" name="name" class="form-input" required placeholder="Введіть ваше ім'я">
            </div>

            <div class="form-group">
                <label class="form-label">
                    Телефон <span class="required">*</span>
                </label>
                <input type="tel" name="phone" class="form-input" required placeholder="+38 (0__) ___-__-__">
                <div class="form-hint">Наш менеджер зв'яжеться з вами за цим номером</div>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Email
                </label>
                <input type="email" name="email" class="form-input" placeholder="email@example.com">
                <div class="form-hint">Опціонально, але бажано</div>
            </div>

            <hr style="margin:32px 0;border:none;border-top:1px solid rgba(255,255,255,.12);">

            <h3 style="margin:0 0 20px;font-size:18px;">Інформація про товар</h3>

            <div class="form-group">
                <label class="form-label">
                    Назва товару <span class="required">*</span>
                </label>
                <input type="text" name="item_name" class="form-input" required placeholder="Наприклад: Cyma CM.028 AK-47">
                <div class="form-hint">Вкажіть бренд та модель привода</div>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Опис товару <span class="required">*</span>
                </label>
                <textarea name="item_description" class="form-input form-textarea" required placeholder="Розкажіть про ваш привід: що входить в комплект, чи є апгрейди, як довго використовували, причина продажу тощо"></textarea>
                <div class="form-hint">Чим детальніше опис, тим швидше знайдеться покупець</div>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Бажана ціна, грн <span class="required">*</span>
                </label>
                <input type="number" name="price" class="form-input" required min="0" step="1" placeholder="5000">
                <div class="form-hint">Вкажіть ціну, за яку хочете продати. Ми можемо допомогти скоригувати її</div>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Стан товару <span class="required">*</span>
                </label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="condition" value="excellent" required>
                        <span>Відмінний</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="condition" value="good" required>
                        <span>Хороший</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="condition" value="fair" required>
                        <span>Задовільний</span>
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="condition" value="parts" required>
                        <span>На запчастини</span>
                    </label>
                </div>
                <div class="form-hint" style="margin-top:12px;">
                    <strong>Відмінний:</strong> як новий, без пошкоджень<br>
                    <strong>Хороший:</strong> незначні сліди використання<br>
                    <strong>Задовільний:</strong> є подряпини, потребує косметичного ремонту<br>
                    <strong>На запчастини:</strong> не працює або серйозно пошкоджений
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Фото товару
                </label>
                <input type="file" name="photos[]" multiple accept="image/*" id="photoInput" style="display:none;">
                <div class="photo-upload" onclick="document.getElementById('photoInput').click();">
                    <div class="photo-upload-icon">📷</div>
                    <p style="margin:0;font-weight:600;">Натисніть, щоб вибрати фото</p>
                    <p style="margin:8px 0 0;font-size:13px;color:var(--muted);">Можна вибрати кілька фото (до 10)</p>
                </div>
                <div class="form-hint">
                    Фото значно підвищують шанси на продаж. Зробіть фото з різних ракурсів, включаючи всі недоліки.
                    Якщо зараз немає можливості - вкажіть посилання на фото у додатковій інформації нижче.
                </div>
                <div id="selectedPhotos" style="margin-top:12px;color:var(--muted);font-size:14px;"></div>
            </div>

            <button type="submit" class="btn primary" style="width:100%;margin-top:32px;padding:16px;">
                Відправити заявку
            </button>

            <p style="margin-top:16px;font-size:13px;color:var(--muted);text-align:center;">
                Відправляючи заявку, ви погоджуєтесь з <a href="{{ route('privacy') }}" style="color:var(--accent);">Політикою конфіденційності</a>
            </p>
        </form>
    </div>
</div>

<div class="card" style="padding:32px;margin-top:24px;">
    <h2 style="margin-top:0;">Як це працює</h2>

    <div style="display:grid;gap:20px;">
        <div style="display:flex;gap:16px;align-items:flex-start;">
            <div style="min-width:40px;height:40px;border-radius:50%;background:var(--accent);color:#000;display:grid;place-items:center;font-weight:900;font-size:18px;">1</div>
            <div>
                <h4 style="margin:0 0 6px;">Ви залишаєте заявку</h4>
                <p style="margin:0;color:var(--muted);font-size:14px;">Заповнюєте форму вище з описом та фото вашого привода</p>
            </div>
        </div>

        <div style="display:flex;gap:16px;align-items:flex-start;">
            <div style="min-width:40px;height:40px;border-radius:50%;background:var(--accent);color:#000;display:grid;place-items:center;font-weight:900;font-size:18px;">2</div>
            <div>
                <h4 style="margin:0 0 6px;">Ми зв'язуємося з вами</h4>
                <p style="margin:0;color:var(--muted);font-size:14px;">Наш менеджер телефонує протягом 24 годин, уточнює деталі та допомагає з ціноутворенням</p>
            </div>
        </div>

        <div style="display:flex;gap:16px;align-items:flex-start;">
            <div style="min-width:40px;height:40px;border-radius:50%;background:var(--accent);color:#000;display:grid;place-items:center;font-weight:900;font-size:18px;">3</div>
            <div>
                <h4 style="margin:0 0 6px;">Розміщуємо оголошення</h4>
                <p style="margin:0;color:var(--muted);font-size:14px;">Публікуємо ваш товар на нашому сайті та в соцмережах з професійним описом</p>
            </div>
        </div>

        <div style="display:flex;gap:16px;align-items:flex-start;">
            <div style="min-width:40px;height:40px;border-radius:50%;background:var(--accent);color:#000;display:grid;place-items:center;font-weight:900;font-size:18px;">4</div>
            <div>
                <h4 style="margin:0 0 6px;">Знаходимо покупця</h4>
                <p style="margin:0;color:var(--muted);font-size:14px;">Організовуємо зустріч або доставку, допомагаємо з оформленням угоди</p>
            </div>
        </div>

        <div style="display:flex;gap:16px;align-items:flex-start;">
            <div style="min-width:40px;height:40px;border-radius:50%;background:var(--accent);color:#000;display:grid;place-items:center;font-weight:900;font-size:18px;">5</div>
            <div>
                <h4 style="margin:0 0 6px;">Ви отримуєте гроші</h4>
                <p style="margin:0;color:var(--muted);font-size:14px;">Після успішної угоди ви отримуєте оплату за ваш товар</p>
            </div>
        </div>
    </div>

    <div style="margin-top:32px;padding:20px;border-radius:var(--radius);border:1px solid rgba(56,189,248,.20);background:rgba(56,189,248,.08);">
        <h4 style="margin:0 0 8px;color:rgba(56,189,248,.95);">💡 Наша комісія</h4>
        <p style="margin:0;color:rgba(255,255,255,.80);font-size:14px;">
            За наші послуги ми беремо комісію <strong>10%</strong> від суми продажу. Це включає розміщення оголошення,
            пошук покупця, організацію угоди та гарантію безпеки для обох сторін.
        </p>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('photoInput')?.addEventListener('change', function(e) {
    const files = e.target.files;
    const container = document.getElementById('selectedPhotos');

    if (files.length > 0) {
        const fileNames = Array.from(files).map(f => f.name).join(', ');
        container.textContent = `Вибрано ${files.length} файл(ів): ${fileNames}`;
        container.style.color = 'rgba(88,255,122,.90)';
    } else {
        container.textContent = '';
    }
});
</script>
@endpush

@endsection
