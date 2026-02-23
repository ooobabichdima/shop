@extends('admin.layout')
@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:20px">
<h1>Категорії блогу</h1>
<a href="{{ route('admin.blog.categories.create') }}" class="btn btn-primary">Додати категорію</a>
</div>
<table class="admin-table">
<tr><th>Назва</th><th>Slug</th><th>Статей</th><th>Активна</th><th>Дії</th></tr>
@foreach($categories as $category)
<tr>
<td>{{ $category->name }}</td>
<td>{{ $category->slug }}</td>
<td>{{ $category->posts_count }}</td>
<td>{{ $category->is_active ? 'Так' : 'Ні' }}</td>
<td>
<a href="{{ route('admin.blog.categories.edit', $category) }}">Редагувати</a>
<form method="POST" action="{{ route('admin.blog.categories.destroy', $category) }}" style="display:inline">@csrf @method('DELETE')<button type="submit" onclick="return confirm('Видалити?')">Видалити</button></form>
</td>
</tr>
@endforeach
</table>
{{ $categories->links() }}
@endsection
