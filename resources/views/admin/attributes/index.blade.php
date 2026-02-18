@extends('layouts.app')

@section('title', 'Атрибути товарів - Адмін')

@section('content')
<div style="padding:20px 0;">
    <div style="margin-bottom:30px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;">
        <div>
            <h1 style="margin:0;">⚙️ Атрибути товарів</h1>
            <p style="margin:8px 0 0;color:var(--muted);">Налаштування фільтрів та характеристик для категорій</p>
        </div>
        <a href="{{ route('admin.attributes.create') }}" class="btn primary">
            + Створити атрибут
        </a>
    </div>

    @if(session('success'))
        <div style="padding:14px;border-radius:14px;background:rgba(88,255,122,.12);border:1px solid rgba(88,255,122,.25);margin-bottom:20px;">
            <b style="color:rgba(88,255,122,.95);">✓ {{ session('success') }}</b>
        </div>
    @endif

    <div class="card" style="padding:0;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:rgba(0,0,0,.14);border-bottom:1px solid rgba(255,255,255,.10);">
                    <th style="padding:14px;text-align:left;font-weight:900;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);">ID</th>
                    <th style="padding:14px;text-align:left;font-weight:900;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);">Назва</th>
                    <th style="padding:14px;text-align:left;font-weight:900;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);">Slug</th>
                    <th style="padding:14px;text-align:left;font-weight:900;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);">Тип</th>
                    <th style="padding:14px;text-align:left;font-weight:900;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);">Категорій</th>
                    <th style="padding:14px;text-align:left;font-weight:900;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);">Сорт.</th>
                    <th style="padding:14px;text-align:left;font-weight:900;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);">Статус</th>
                    <th style="padding:14px;text-align:left;font-weight:900;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);">Дії</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attributes as $attribute)
                <tr style="border-bottom:1px solid rgba(255,255,255,.06);">
                    <td style="padding:14px;">{{ $attribute->id }}</td>
                    <td style="padding:14px;"><b>{{ $attribute->name }}</b></td>
                    <td style="padding:14px;color:var(--muted);font-size:13px;">{{ $attribute->slug }}</td>
                    <td style="padding:14px;">
                        @php
                            $typeLabels = [
                                'text' => '📝 Текст',
                                'select' => '📋 Список',
                                'checkbox' => '☑️ Чекбокси',
                                'range' => '📊 Діапазон'
                            ];
                        @endphp
                        <span style="font-size:13px;">{{ $typeLabels[$attribute->type] ?? $attribute->type }}</span>
                    </td>
                    <td style="padding:14px;">{{ $attribute->categories->count() }}</td>
                    <td style="padding:14px;">{{ $attribute->sort_order }}</td>
                    <td style="padding:14px;">
                        @if($attribute->is_active)
                            <span style="padding:4px 8px;border-radius:8px;background:rgba(88,255,122,.12);border:1px solid rgba(88,255,122,.25);color:rgba(88,255,122,.95);font-size:11px;font-weight:900;">АКТИВНИЙ</span>
                        @else
                            <span style="padding:4px 8px;border-radius:8px;background:rgba(255,77,77,.12);border:1px solid rgba(255,77,77,.25);color:rgba(255,77,77,.95);font-size:11px;font-weight:900;">НЕАКТИВНИЙ</span>
                        @endif
                    </td>
                    <td style="padding:14px;">
                        <div style="display:flex;gap:8px;">
                            <a href="{{ route('admin.attributes.edit', $attribute) }}" class="btn small">Редагувати</a>
                            <form method="POST" action="{{ route('admin.attributes.destroy', $attribute) }}" style="margin:0;" onsubmit="return confirm('Видалити атрибут?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn small" style="border-color:rgba(255,77,77,.3);background:rgba(255,77,77,.1);color:rgba(255,77,77,.95);">Видалити</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="padding:40px;text-align:center;color:var(--muted);">
                        <div style="font-size:48px;margin-bottom:16px;">⚙️</div>
                        <div style="font-size:16px;">Атрибутів ще немає</div>
                        <div style="font-size:14px;margin-top:8px;">Створіть перший атрибут для фільтрів</div>
                        <a href="{{ route('admin.attributes.create') }}" class="btn primary" style="margin-top:16px;">+ Створити атрибут</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $attributes->links() }}
    </div>
</div>
@endsection
