@extends('layouts.admin')

@section('title', 'Створити атрибут - Адмін')

@section('content')
<div style="padding:20px 0;">
    <div style="margin-bottom:30px;">
        <a href="{{ route('admin.attributes.index') }}" class="btn small" style="margin-bottom:16px;">
            ← Назад до списку
        </a>
        <h1 style="margin:0;">Створити новий атрибут</h1>
    </div>

    <div class="card" style="padding:24px;max-width:800px;">
        <form method="POST" action="{{ route('admin.attributes.store') }}">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Назва атрибута *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                    placeholder="Наприклад: Колір, Розмір, Матеріал">
                @error('name')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Тип атрибута *</label>
                <select name="type" required id="attributeType"
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;">
                    <option value="select" {{ old('type') == 'select' ? 'selected' : '' }}>📋 Список (випадаючий)</option>
                    <option value="checkbox" {{ old('type') == 'checkbox' ? 'selected' : '' }}>☑️ Чекбокси (багато значень)</option>
                    <option value="range" {{ old('type') == 'range' ? 'selected' : '' }}>📊 Діапазон (мін-макс)</option>
                    <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>📝 Текст</option>
                </select>
                @error('type')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:20px;" id="optionsField">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Варіанти (по одному на рядок)</label>
                <textarea name="options" rows="6"
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;resize:vertical;font-family:monospace;"
                    placeholder="Червоний&#10;Синій&#10;Зелений">{{ old('options') }}</textarea>
                <small style="color:var(--muted);margin-top:4px;display:block;">Кожен варіант на новому рядку</small>
                @error('options')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;font-weight:700;">Порядок сортування</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                    style="width:100%;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.14);
                    background:rgba(0,0,0,.18);color:var(--text);outline:none;font-size:15px;"
                    placeholder="0">
                @error('sort_order')
                    <div style="color:var(--danger);font-size:13px;margin-top:6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:24px;padding:16px;border-radius:14px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);">
                <div style="font-weight:700;margin-bottom:12px;">Налаштування</div>

                <label style="display:flex;gap:10px;align-items:center;padding:8px 0;cursor:pointer;">
                    <input type="checkbox" name="is_filterable" value="1" {{ old('is_filterable', true) ? 'checked' : '' }}
                        style="width:18px;height:18px;accent-color:var(--accent);">
                    <span>Використовувати як фільтр у каталозі</span>
                </label>

                <label style="display:flex;gap:10px;align-items:center;padding:8px 0;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        style="width:18px;height:18px;accent-color:var(--accent);">
                    <span>Активний</span>
                </label>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn primary">
                    💾 Створити атрибут
                </button>
                <a href="{{ route('admin.attributes.index') }}" class="btn">
                    Скасувати
                </a>
            </div>
        </form>
    </div>
</div>

<script>
(function(){
    const typeSelect = document.getElementById('attributeType');
    const optionsField = document.getElementById('optionsField');

    function toggleOptions(){
        const type = typeSelect.value;
        optionsField.style.display = (type === 'select' || type === 'checkbox') ? 'block' : 'none';
    }

    typeSelect.addEventListener('change', toggleOptions);
    toggleOptions();
})();
</script>
@endsection
