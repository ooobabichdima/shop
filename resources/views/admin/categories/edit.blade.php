@extends('layouts.admin')

@section('title', 'Редагувати категорію - Адмін')

@section('content')
<div style="padding:20px 0;">
    <div style="margin-bottom:30px;">
        <a href="{{ route('admin.categories.index') }}" class="btn" style="margin-bottom:12px;">← Назад до категорій</a>
        <h1 style="margin:0;">Редагувати категорію</h1>
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

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card" style="padding:20px;margin-bottom:16px;">
            <h2 style="margin:0 0 20px;">Основна інформація</h2>

            <div style="display:grid;gap:16px;">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Назва *</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Батьківська категорія</label>
                    <select name="parent_id"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                        <option value="">Без батьківської (головна категорія)</option>
                        @foreach(\App\Models\Category::where('id', '!=', $category->id)->orderBy('name')->get() as $cat)
                            @if(!$cat->parent_id) {{-- Show only root categories as parents --}}
                            <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endif
                        @endforeach
                    </select>
                    <small style="color:var(--muted);margin-top:4px;display:block;">Оберіть, якщо це підкатегорія</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Slug</label>
                    <input type="text" value="{{ $category->slug }}" disabled
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--muted);">
                    <small style="color:var(--muted);margin-top:4px;display:block;">Генерується автоматично з назви</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Опис</label>
                    <textarea name="description" rows="4"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">{{ old('description', $category->description) }}</textarea>
                    <small style="color:var(--muted);margin-top:4px;display:block;">Опис категорії для SEO</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Зображення категорії</label>
                    @if($category->image)
                        <div style="margin-bottom:12px;">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                style="max-width:200px;border-radius:14px;border:1px solid rgba(255,255,255,.14);">
                            <div style="margin-top:8px;color:var(--muted);font-size:14px;">Поточне зображення</div>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                    <small style="color:var(--muted);margin-top:4px;display:block;">Іконка для mega menu та сторінки категорій (рекомендовано 256x256px)</small>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Порядок сортування</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}"
                            style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                        <small style="color:var(--muted);margin-top:4px;display:block;">Чим менше число, тим вище в списку</small>
                    </div>

                    <div style="display:flex;align-items:center;padding-top:28px;">
                        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                                style="width:18px;height:18px;accent-color:var(--accent);">
                            <span style="font-weight:700;">Активна</span>
                        </label>
                    </div>
                </div>

                <div style="padding:12px;border-radius:14px;background:rgba(56,189,248,.1);border:1px solid rgba(56,189,248,.3);">
                    <div style="color:rgba(56,189,248,.95);font-weight:700;margin-bottom:4px;">Статистика</div>
                    <div style="color:rgba(255,255,255,.85);">
                        Товарів у категорії: <b>{{ $category->products->count() }}</b>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="padding:20px;margin-bottom:16px;">
            <h2 style="margin:0 0 12px;">🔍 SEO налаштування</h2>
            <p style="margin:0 0 16px;color:var(--muted);font-size:14px;">Мета-теги для пошукових систем та соціальних мереж</p>

            <div style="display:grid;gap:16px;">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="{{ $category->name }} - Каталог | Strikeball Shop">
                    <small style="color:var(--muted);margin-top:4px;display:block;">Заголовок сторінки в пошукових системах (50-60 символів)</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Meta Description</label>
                    <textarea name="meta_description" rows="3"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="Каталог {{ $category->name }} - купити в інтернет-магазині Strikeball Shop...">{{ old('meta_description', $category->meta_description) }}</textarea>
                    <small style="color:var(--muted);margin-top:4px;display:block;">Опис сторінки в пошукових системах (150-160 символів)</small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords) }}"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="страйкбол, airsoft, {{ strtolower($category->name) }}">
                    <small style="color:var(--muted);margin-top:4px;display:block;">Ключові слова через кому</small>
                </div>
            </div>
        </div>

        <div class="card" style="padding:20px;margin-bottom:16px;">
            <h2 style="margin:0 0 12px;">⚙️ Фільтри та атрибути</h2>
            <p style="margin:0 0 16px;color:var(--muted);font-size:14px;">Оберіть атрибути, які будуть доступні для фільтрації товарів у цій категорії</p>

            @if($attributes->isEmpty())
                <div style="padding:20px;text-align:center;background:rgba(255,255,255,.03);border-radius:14px;border:1px solid rgba(255,255,255,.08);">
                    <div style="color:var(--muted);margin-bottom:12px;">Атрибутів ще немає</div>
                    <a href="{{ route('admin.attributes.create') }}" class="btn primary small">+ Створити перший атрибут</a>
                </div>
            @else
                <div style="display:grid;gap:10px;">
                    @foreach($attributes as $attr)
                    <label style="display:flex;align-items:center;gap:12px;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.05);cursor:pointer;transition:.12s ease;"
                        onmouseover="this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.background='rgba(255,255,255,.05)'">
                        <input type="checkbox" name="attributes[]" value="{{ $attr->id }}"
                            {{ in_array($attr->id, old('attributes', $category->attributes->pluck('id')->toArray())) ? 'checked' : '' }}
                            style="width:18px;height:18px;accent-color:var(--accent);">
                        <div style="flex:1;">
                            <b style="font-size:14px;">{{ $attr->name }}</b>
                            <div style="color:var(--muted);font-size:12px;margin-top:2px;">
                                @php
                                    $typeLabels = [
                                        'text' => '📝 Текст',
                                        'select' => '📋 Список',
                                        'checkbox' => '☑️ Чекбокси',
                                        'range' => '📊 Діапазон'
                                    ];
                                @endphp
                                {{ $typeLabels[$attr->type] ?? $attr->type }}
                                @if($attr->options && count($attr->options) > 0)
                                    • {{ count($attr->options) }} варіантів
                                @endif
                            </div>
                        </div>
                    </label>
                    @endforeach
                </div>

                <div style="margin-top:12px;padding:10px 12px;border-radius:12px;background:rgba(88,255,122,.08);border:1px solid rgba(88,255,122,.18);">
                    <small style="color:var(--muted);font-size:12px;">
                        💡 <b>Підказка:</b> Обрані атрибути будуть відображатися як фільтри в каталозі цієї категорії
                    </small>
                </div>
            @endif
        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn primary">Зберегти зміни</button>
            <a href="{{ route('admin.categories.index') }}" class="btn">Скасувати</a>
        </div>
    </form>
</div>
@endsection
