@extends('layouts.app')

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

    <form method="POST" action="{{ route('admin.categories.store') }}">
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
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Опис</label>
                    <textarea name="description" rows="4"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">{{ old('description') }}</textarea>
                    <small style="color:var(--muted);margin-top:4px;display:block;">Опис категорії для SEO</small>
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

        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn primary">Створити категорію</button>
            <a href="{{ route('admin.categories.index') }}" class="btn">Скасувати</a>
        </div>
    </form>
</div>
@endsection
