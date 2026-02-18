@extends('layouts.admin')

@section('title', 'Категорії - Адмін')

@section('content')
<div style="padding:20px 0;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;flex-wrap:wrap;gap:16px;">
        <h1 style="margin:0;">Категорії</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn primary">
            + Додати категорію
        </a>
    </div>

    @if(session('success'))
        <div style="padding:14px 16px; border-radius:14px; margin-bottom:16px; background:rgba(88,255,122,.1); border:1px solid rgba(88,255,122,.3); color:rgba(88,255,122,.95);">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="padding:14px 16px; border-radius:14px; margin-bottom:16px; background:rgba(255,77,77,.1); border:1px solid rgba(255,77,77,.3); color:rgba(255,77,77,.95);">
            {{ session('error') }}
        </div>
    @endif

    <div class="card" style="padding:20px;">
        @if($categories->count() > 0)
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="border-bottom:2px solid rgba(255,255,255,.12);">
                            <th style="text-align:left;padding:10px 12px;color:var(--muted);font-weight:700;">ID</th>
                            <th style="text-align:left;padding:10px 12px;color:var(--muted);font-weight:700;">Назва</th>
                            <th style="text-align:left;padding:10px 12px;color:var(--muted);font-weight:700;">Slug</th>
                            <th style="text-align:center;padding:10px 12px;color:var(--muted);font-weight:700;">Сорт.</th>
                            <th style="text-align:center;padding:10px 12px;color:var(--muted);font-weight:700;">Товарів</th>
                            <th style="text-align:center;padding:10px 12px;color:var(--muted);font-weight:700;">Статус</th>
                            <th style="text-align:center;padding:10px 12px;color:var(--muted);font-weight:700;">Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr style="border-bottom:1px solid rgba(255,255,255,.08);">
                            <td style="padding:10px 12px;">{{ $category->id }}</td>
                            <td style="padding:10px 12px;font-weight:700;">{{ $category->name }}</td>
                            <td style="padding:10px 12px;color:var(--muted);">{{ $category->slug }}</td>
                            <td style="padding:10px 12px;text-align:center;">{{ $category->sort_order }}</td>
                            <td style="padding:10px 12px;text-align:center;">
                                <span style="background:rgba(56,189,248,.15);border:1px solid rgba(56,189,248,.3);padding:4px 8px;border-radius:8px;font-size:12px;">
                                    {{ $category->products->count() }}
                                </span>
                            </td>
                            <td style="padding:10px 12px;text-align:center;">
                                @if($category->is_active)
                                    <span style="color:rgba(88,255,122,.95);">●</span> Активна
                                @else
                                    <span style="color:rgba(255,77,77,.95);">●</span> Неактивна
                                @endif
                            </td>
                            <td style="padding:10px 12px;text-align:center;">
                                <div style="display:flex;gap:6px;justify-content:center;">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn small">Редагувати</a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" style="display:inline;" onsubmit="return confirm('Ви впевнені?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn small" style="background:rgba(255,77,77,.1);border-color:rgba(255,77,77,.3);color:rgba(255,77,77,.95);">Видалити</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top:20px;">
                {{ $categories->links() }}
            </div>
        @else
            <div style="text-align:center;padding:40px 20px;">
                <div style="font-size:48px;margin-bottom:16px;opacity:.5;">📁</div>
                <h3 style="margin:0 0 8px;">Категорій ще немає</h3>
                <p style="color:var(--muted);margin:0 0 20px;">Додайте першу категорію</p>
                <a href="{{ route('admin.categories.create') }}" class="btn primary">
                    + Додати категорію
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
