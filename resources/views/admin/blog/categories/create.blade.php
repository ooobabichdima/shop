@extends('admin.layout')
@section('content')
<h1>Додати категорію</h1>
<form method="POST" action="{{ route('admin.blog.categories.store') }}">
@csrf
<label>Назва*<input type="text" name="name" required></label>
<label>Slug<input type="text" name="slug"></label>
<label>Опис<textarea name="description" rows="3"></textarea></label>
<label>Порядок сортування<input type="number" name="sort_order" value="0"></label>
<label><input type="checkbox" name="is_active" value="1" checked> Активна</label>
<button type="submit" class="btn btn-primary">Зберегти</button>
</form>
@endsection
