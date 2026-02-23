@extends('layouts.admin')
@section('title', 'Склади - Адмін')
@section('content')
<div style="padding:20px 0;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
        <h1 style="margin:0;">Склади</h1>
        <a href="{{ route('admin.warehouses.create') }}" class="btn btn-primary">Додати склад</a>
    </div>

    @if(session('success'))
        <div style="padding:14px 16px;border-radius:14px;margin-bottom:16px;background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.3);color:rgba(34,197,94,.95);">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="padding:14px 16px;border-radius:14px;margin-bottom:16px;background:rgba(255,77,77,.1);border:1px solid rgba(255,77,77,.3);color:rgba(255,77,77,.95);">
            {{ session('error') }}
        </div>
    @endif

    <div class="card" style="overflow:hidden;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Назва</th>
                    <th>Код</th>
                    <th>Місто</th>
                    <th>Адреса</th>
                    <th>Телефон</th>
                    <th>Статус</th>
                    <th style="width:140px;">Дії</th>
                </tr>
            </thead>
            <tbody>
                @forelse($warehouses as $warehouse)
                <tr>
                    <td style="font-weight:700;">{{ $warehouse->name }}</td>
                    <td><code style="background:var(--surface2);padding:4px 8px;border-radius:6px;">{{ $warehouse->code }}</code></td>
                    <td>{{ $warehouse->city ?? '-' }}</td>
                    <td>{{ $warehouse->address ? Str::limit($warehouse->address, 40) : '-' }}</td>
                    <td>{{ $warehouse->phone ?? '-' }}</td>
                    <td>
                        @if($warehouse->is_active)
                            <span class="tag tag-success">Активний</span>
                        @else
                            <span class="tag tag-muted">Неактивний</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:8px;">
                            <a href="{{ route('admin.warehouses.edit', $warehouse) }}" class="btn btn-sm">Редагувати</a>
                            <form method="POST" action="{{ route('admin.warehouses.destroy', $warehouse) }}" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Видалити склад?')">Видалити</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;color:var(--muted);">
                        Складів поки немає. <a href="{{ route('admin.warehouses.create') }}">Додати перший склад</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($warehouses->hasPages())
        <div style="margin-top:20px;">
            {{ $warehouses->links() }}
        </div>
    @endif
</div>
@endsection
