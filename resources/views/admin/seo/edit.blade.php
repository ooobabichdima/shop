@extends('layouts.admin')

@section('title', 'Редагувати SEO - ' . $seoPage->page_name)

@section('content')
<div style="padding:20px 0;">
    <div style="margin-bottom:30px;">
        <a href="{{ route('admin.seo.index') }}" class="btn" style="margin-bottom:12px;">← Назад до списку</a>
        <h1 style="margin:0;">🔍 {{ $seoPage->page_name }}</h1>
        <p style="color:var(--muted);margin-top:4px;">Сторінка: <code style="padding:2px 6px;border-radius:6px;background:rgba(255,255,255,.08);">/{{ $seoPage->page_key }}</code></p>
    </div>

    @if($errors->any())
        <div class="alert alert-error">
            <div style="font-weight:700;margin-bottom:8px;">Помилки валідації:</div>
            <ul style="margin:0;padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.seo.update', $seoPage) }}">
        @csrf
        @method('PUT')

        <div class="card" style="padding:20px;margin-bottom:16px;">
            <h2 style="margin:0 0 12px;">🏷️ Базові мета-теги</h2>
            <p style="margin:0 0 16px;color:var(--muted);font-size:14px;">Ці теги використовуються пошуковими системами</p>

            <div style="display:grid;gap:16px;">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $seoPage->meta_title) }}"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                    <small style="color:var(--muted);margin-top:4px;display:block;">
                        Заголовок сторінки в пошукових системах (рекомендовано 50-60 символів)
                    </small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Meta Description</label>
                    <textarea name="meta_description" rows="4"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">{{ old('meta_description', $seoPage->meta_description) }}</textarea>
                    <small style="color:var(--muted);margin-top:4px;display:block;">
                        Опис сторінки в пошукових системах (рекомендовано 150-160 символів)
                    </small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $seoPage->meta_keywords) }}"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                    <small style="color:var(--muted);margin-top:4px;display:block;">
                        Ключові слова через кому (опціонально)
                    </small>
                </div>
            </div>
        </div>

        <div class="card" style="padding:20px;margin-bottom:16px;">
            <h2 style="margin:0 0 12px;">📱 Open Graph (соціальні мережі)</h2>
            <p style="margin:0 0 16px;color:var(--muted);font-size:14px;">Як сторінка відображатиметься при поширенні в Facebook, Twitter</p>

            <div style="display:grid;gap:16px;">
                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">OG Title</label>
                    <input type="text" name="og_title" value="{{ old('og_title', $seoPage->og_title) }}"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="{{ $seoPage->meta_title }}">
                    <small style="color:var(--muted);margin-top:4px;display:block;">
                        Якщо порожньо, використається Meta Title
                    </small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">OG Description</label>
                    <textarea name="og_description" rows="3"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="{{ $seoPage->meta_description }}">{{ old('og_description', $seoPage->og_description) }}</textarea>
                    <small style="color:var(--muted);margin-top:4px;display:block;">
                        Якщо порожньо, використається Meta Description
                    </small>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">OG Image URL</label>
                    <input type="text" name="og_image" value="{{ old('og_image', $seoPage->og_image) }}"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="/images/og-default.jpg">
                    <small style="color:var(--muted);margin-top:4px;display:block;">
                        Повний URL або шлях до зображення (рекомендовано 1200x630px)
                    </small>
                </div>
            </div>
        </div>

        <div class="card" style="padding:20px;margin-bottom:16px;">
            <h2 style="margin:0 0 12px;">⚙️ Налаштування</h2>

            <div style="display:flex;align-items:center;">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $seoPage->is_active) ? 'checked' : '' }}
                        style="width:18px;height:18px;accent-color:var(--accent);">
                    <span style="font-weight:700;">Активна (використовувати ці SEO налаштування)</span>
                </label>
            </div>
        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn primary">💾 Зберегти зміни</button>
            <a href="{{ route('admin.seo.index') }}" class="btn">Скасувати</a>
        </div>
    </form>
</div>
@endsection
