@extends('layouts.admin')
@section('title', 'Редагувати склад - Адмін')
@section('content')
<div style="padding:20px 0;">
    <div style="margin-bottom:30px;">
        <a href="{{ route('admin.warehouses.index') }}" class="btn" style="margin-bottom:12px;">← Назад до складів</a>
        <h1 style="margin:0;">Редагувати склад</h1>
    </div>

    <form method="POST" action="{{ route('admin.warehouses.update', $warehouse) }}">
        @csrf
        @method('PUT')

        <div class="card" style="padding:20px;margin-bottom:16px;">
            <h2 style="margin:0 0 20px;">Інформація про склад</h2>

            <div style="display:grid;gap:16px;">
                <div style="display:grid;grid-template-columns:2fr 1fr;gap:16px;">
                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Назва складу *</label>
                        <input type="text" name="name" value="{{ old('name', $warehouse->name) }}" required
                            style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                            placeholder="Головний склад">
                    </div>

                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Код складу *</label>
                        <input type="text" name="code" value="{{ old('code', $warehouse->code) }}" required
                            style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                            placeholder="MAIN">
                        <small style="color:var(--muted);margin-top:4px;display:block;">Наприклад: MAIN, KYIV, LVIV</small>
                    </div>
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Місто</label>
                    <input type="text" name="city" value="{{ old('city', $warehouse->city) }}"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="Київ">
                </div>

                <div>
                    <label style="display:block;margin-bottom:8px;font-weight:700;">Адреса</label>
                    <textarea name="address" rows="2"
                        style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                        placeholder="вул. Хрещатик, 1">{{ old('address', $warehouse->address) }}</textarea>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Телефон</label>
                        <input type="text" name="phone" value="{{ old('phone', $warehouse->phone) }}"
                            style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);"
                            placeholder="+380 12 345 67 89">
                    </div>

                    <div>
                        <label style="display:block;margin-bottom:8px;font-weight:700;">Порядок сортування</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $warehouse->sort_order) }}"
                            style="width:100%;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);color:var(--text);">
                    </div>
                </div>

                <div>
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $warehouse->is_active) ? 'checked' : '' }}
                            style="width:18px;height:18px;accent-color:var(--accent);">
                        <span style="font-weight:700;">Активний</span>
                    </label>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">Зберегти зміни</button>
            <a href="{{ route('admin.warehouses.index') }}" class="btn">Скасувати</a>
        </div>
    </form>
</div>
@endsection
