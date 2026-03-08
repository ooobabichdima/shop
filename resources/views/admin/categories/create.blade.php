@extends('layouts.admin')

@section('title', 'Додати категорію - Адмін')

@section('content')
<div style="padding:20px 0;">
    <div style="margin-bottom:30px;">
        <a href="{{ route('admin.categories.index') }}" class="btn" style="margin-bottom:12px;">← Назад до категорій</a>
        <h1 style="margin:0;">Додати категорію</h1>
    </div>

    @if($errors->any())
        <div style="padding:14px 16px; border-radius:14px; margin-bottom:16px; background:rgba(255,77,77,.1); border:1px solid rgba(255,77,77,.3); color:rgba(255,77,77,.95);">
            <div style="font-weight:700;margin-bottom:8px;">Помилки валідації:</div>
            <ul style="margin:0;padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="card" style="padding:20px;margin-bottom:16px;">
            <h2 style="margin:0 0 20px;">Основна інформація</h2>

            <div style="display:grid;gap:16px;">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Назва *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Батьківська категорія</label>
                    <select name="parent_id"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                        <option value="">Без батьківської (головна категорія)</option>
                        @foreach(\App\Models\Category::whereNull('parent_id')->orderBy('name')->get() as $cat)
                        <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    <small style="color:var(--muted);margin-top:4px;display:block;">Оберіть, якщо це підкатегорія</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Опис</label>
                    <textarea name="description" rows="4"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">{{ old('description') }}</textarea>
                    <small style="color:var(--muted);margin-top:4px;display:block;">Опис категорії для SEO</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Зображення категорії</label>
                    <input type="file" name="image" accept="image/*"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                    <small style="color:var(--muted);margin-top:4px;display:block;">Іконка для mega menu та сторінки категорій (рекомендовано 256x256px)</small>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Порядок сортування</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                            style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                        <small style="color:var(--muted);margin-top:4px;display:block;">Чим менше число, тим вище в списку</small>
                    </div>

                    <div style="display:flex;align-items:center;padding-top:28px;">
                        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                style="width:18px;height:18px;accent-color:var(--accent);">
                            <span style="font-weight:700;">Активна</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="padding:20px;margin-bottom:16px;">
            <h2 style="margin:0 0 12px;">🔍 SEO налаштування</h2>
            <p style="margin:0 0 16px;color:var(--muted);font-size:14px;">Мета-теги для пошукових систем (опціонально)</p>

            <div style="display:grid;gap:16px;">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="Назва категорії - Каталог | Strikeball Shop">
                    <small style="color:var(--muted);margin-top:4px;display:block;">Заголовок в пошукових системах (50-60 символів)</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Meta Description</label>
                    <textarea name="meta_description" rows="3"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="Купити в інтернет-магазині Strikeball Shop...">{{ old('meta_description') }}</textarea>
                    <small style="color:var(--muted);margin-top:4px;display:block;">Опис в пошукових системах (150-160 символів)</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="страйкбол, airsoft, ключові слова">
                    <small style="color:var(--muted);margin-top:4px;display:block;">Ключові слова через кому</small>
                </div>
            </div>
        </div>

        <div class="card" style="padding:20px;margin-bottom:16px;">
            <h2 style="margin:0 0 12px;">🏠 Відображення на головній</h2>
            <p style="margin:0 0 16px;color:var(--muted);font-size:14px;">Налаштування показу категорії в блоці "Рекомендовані категорії" на головній сторінці</p>

            <div style="display:grid;gap:16px;">
                <div>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                        <input type="checkbox" name="show_on_home" value="1" {{ old('show_on_home') ? 'checked' : '' }}
                            style="width:18px;height:18px;accent-color:var(--accent);">
                        <span style="font-weight:700;">Показувати на головній сторінці</span>
                    </label>
                    <small style="color:var(--muted);margin-top:4px;display:block;margin-left:28px;">Категорія буде доступна у переключателі категорій</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Порядок на головній</label>
                    <input type="number" name="home_sort_order" value="{{ old('home_sort_order', 0) }}"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                    <small style="color:var(--muted);margin-top:4px;display:block;">Порядок відображення в табах (чим менше число, тим лівіше)</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Назва для головної (опційно)</label>
                    <input type="text" name="home_title" value="{{ old('home_title') }}"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="Назва для відображення">
                    <small style="color:var(--muted);margin-top:4px;display:block;">Альтернативна назва для відображення на головній</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Опис для головної (опційно)</label>
                    <textarea name="home_description" rows="3"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="Короткий опис для блоку на головній...">{{ old('home_description') }}</textarea>
                    <small style="color:var(--muted);margin-top:4px;display:block;">Буде показано у великій лівій картці</small>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn primary">Створити категорію</button>
            <a href="{{ route('admin.categories.index') }}" class="btn">Скасувати</a>
        </div>
    </form>
</div>
@endsection
