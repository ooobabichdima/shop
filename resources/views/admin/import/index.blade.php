@extends('layouts.admin')

@section('title', 'Імпорт прайсу - Адмін')

@section('content')
<div style="padding:20px 0;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;flex-wrap:wrap;gap:16px;">
        <div>
            <h1 style="margin:0 0 8px;">Імпорт прайсу постачальника</h1>
            <p style="color:var(--muted);margin:0;">Завантажте CSV файл для оновлення цін та залишків</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn">← Назад до товарів</a>
    </div>

    @if(session('success'))
        <div class="card" style="padding:16px;margin-bottom:20px;border-color:rgba(88,255,122,.30);background:rgba(88,255,122,.10);">
            <div style="color:rgba(88,255,122,.95);font-weight:700;margin-bottom:8px;">✓ {{ session('success') }}</div>
            @if(session('import_log'))
                <details style="margin-top:12px;">
                    <summary style="cursor:pointer;color:rgba(255,255,255,.80);font-size:14px;">Показати деталі імпорту</summary>
                    <div style="margin-top:12px;padding:12px;border-radius:12px;background:rgba(0,0,0,.18);max-height:300px;overflow-y:auto;">
                        @foreach(session('import_log') as $logEntry)
                            <div style="padding:4px 0;font-size:13px;color:rgba(255,255,255,.75);font-family:monospace;">{{ $logEntry }}</div>
                        @endforeach
                    </div>
                </details>
            @endif
        </div>
    @endif

    @if(session('error'))
        <div class="card" style="padding:16px;margin-bottom:20px;border-color:rgba(255,77,77,.30);background:rgba(255,77,77,.10);">
            <div style="color:rgba(255,77,77,.95);font-weight:700;">✗ {{ session('error') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="card" style="padding:16px;margin-bottom:20px;border-color:rgba(255,77,77,.30);background:rgba(255,77,77,.10);">
            <div style="color:rgba(255,77,77,.95);font-weight:700;margin-bottom:8px;">Помилки валідації:</div>
            <ul style="margin:0;padding-left:20px;color:rgba(255,77,77,.85);">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="padding:30px;">
        <h2 style="margin:0 0 20px;font-size:20px;">Завантажити файл</h2>

        <form method="POST" action="{{ route('admin.import.process') }}" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Формат файлу</label>
                <div style="display:flex;gap:16px;flex-wrap:wrap;">
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                        <input type="radio" name="format" value="csv" checked style="width:18px;height:18px;accent-color:var(--accent);">
                        <span>CSV (розділювач крапка з комою)</span>
                    </label>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;opacity:.5;">
                        <input type="radio" name="format" value="excel" disabled style="width:18px;height:18px;">
                        <span>Excel (буде доступно пізніше)</span>
                    </label>
                </div>
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Виберіть файл</label>
                <input type="file" name="file" accept=".csv,.txt" required
                    style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                <div style="margin-top:8px;color:var(--muted);font-size:13px;">
                    Максимальний розмір файлу: 10 МБ. Підтримувані формати: CSV (.csv, .txt)
                </div>
            </div>

            <button type="submit" class="btn primary" style="padding:12px 24px;">
                📤 Завантажити та імпортувати
            </button>
        </form>
    </div>

    <div class="card" style="padding:24px;margin-top:20px;">
        <h3 style="margin:0 0 16px;">📋 Формат CSV файлу</h3>
        <p style="color:rgba(255,255,255,.85);margin:0 0 12px;">
            Файл має містити наступні колонки у вказаному порядку, розділені крапкою з комою (;):
        </p>

        <div style="overflow-x:auto;margin:16px 0;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead>
                    <tr style="border-bottom:2px solid rgba(255,255,255,.12);">
                        <th style="text-align:left;padding:10px 12px;color:var(--muted);font-weight:700;">#</th>
                        <th style="text-align:left;padding:10px 12px;color:var(--muted);font-weight:700;">Колонка</th>
                        <th style="text-align:left;padding:10px 12px;color:var(--muted);font-weight:700;">Опис</th>
                        <th style="text-align:center;padding:10px 12px;color:var(--muted);font-weight:700;">Обов'язкова</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom:1px solid rgba(255,255,255,.08);">
                        <td style="padding:10px 12px;color:var(--muted);">1</td>
                        <td style="padding:10px 12px;font-weight:700;">SKU</td>
                        <td style="padding:10px 12px;color:rgba(255,255,255,.85);">Артикул товару (унікальний код)</td>
                        <td style="padding:10px 12px;text-align:center;color:rgba(88,255,122,.95);">✓</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,.08);">
                        <td style="padding:10px 12px;color:var(--muted);">2</td>
                        <td style="padding:10px 12px;font-weight:700;">Name</td>
                        <td style="padding:10px 12px;color:rgba(255,255,255,.85);">Назва товару</td>
                        <td style="padding:10px 12px;text-align:center;color:rgba(88,255,122,.95);">✓</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,.08);">
                        <td style="padding:10px 12px;color:var(--muted);">3</td>
                        <td style="padding:10px 12px;font-weight:700;">Price</td>
                        <td style="padding:10px 12px;color:rgba(255,255,255,.85);">Ціна (число)</td>
                        <td style="padding:10px 12px;text-align:center;color:rgba(88,255,122,.95);">✓</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,.08);">
                        <td style="padding:10px 12px;color:var(--muted);">4</td>
                        <td style="padding:10px 12px;font-weight:700;">Old Price</td>
                        <td style="padding:10px 12px;color:rgba(255,255,255,.85);">Стара ціна для відображення знижки</td>
                        <td style="padding:10px 12px;text-align:center;color:var(--muted);">—</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,.08);">
                        <td style="padding:10px 12px;color:var(--muted);">5</td>
                        <td style="padding:10px 12px;font-weight:700;">Stock</td>
                        <td style="padding:10px 12px;color:rgba(255,255,255,.85);">Залишок на складі (ціле число)</td>
                        <td style="padding:10px 12px;text-align:center;color:var(--muted);">—</td>
                    </tr>
                    <tr style="border-bottom:1px solid rgba(255,255,255,.08);">
                        <td style="padding:10px 12px;color:var(--muted);">6</td>
                        <td style="padding:10px 12px;font-weight:700;">Category</td>
                        <td style="padding:10px 12px;color:rgba(255,255,255,.85);">Назва категорії (створюється автоматично)</td>
                        <td style="padding:10px 12px;text-align:center;color:var(--muted);">—</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 12px;color:var(--muted);">7</td>
                        <td style="padding:10px 12px;font-weight:700;">Brand</td>
                        <td style="padding:10px 12px;color:rgba(255,255,255,.85);">Назва бренду (створюється автоматично)</td>
                        <td style="padding:10px 12px;text-align:center;color:var(--muted);">—</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h4 style="margin:20px 0 12px;">Приклад файлу:</h4>
        <div style="padding:16px;border-radius:12px;background:rgba(0,0,0,.28);border:1px solid rgba(255,255,255,.10);overflow-x:auto;">
            <pre style="margin:0;font-family:monospace;font-size:13px;color:rgba(255,255,255,.85);white-space:pre;"><code>sku;name;price;old_price;stock;category;brand
AEG-001;АЕГ Tokyo Marui AK47;8500;9500;15;Автомати;Tokyo Marui
PISTOL-012;Пістолет Glock 17;3200;;8;Пістолети;Cybergun
VEST-05;Розвантажувальний жилет Tactical;1800;2100;25;Екіпірування;Condor</code></pre>
        </div>

        <div style="margin-top:16px;padding:14px;border-radius:12px;background:rgba(56,189,248,.10);border:1px solid rgba(56,189,248,.20);">
            <div style="color:rgba(56,189,248,.95);font-weight:700;margin-bottom:6px;">💡 Підказка</div>
            <ul style="margin:0;padding-left:20px;color:rgba(255,255,255,.85);font-size:14px;">
                <li>Якщо SKU вже існує в базі - товар буде оновлено</li>
                <li>Якщо SKU новий - буде створено новий товар</li>
                <li>Категорії та бренди створюються автоматично, якщо не існують</li>
                <li>Перший рядок файлу (заголовки) буде пропущено</li>
            </ul>
        </div>
    </div>
</div>
@endsection
