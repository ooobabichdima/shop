@extends('admin.layout')
@section('content')
<h1>Редагувати категорію</h1>
<form method="POST" action="{{ route('admin.blog.categories.update', $category) }}">
@csrf @method('PUT')
<label>Назва*<input type="text" name="name" value="{{ $category->name }}" required></label>
<label>Slug<input type="text" name="slug" value="{{ $category->slug }}"></label>
<label>Опис<textarea name="description" rows="3">{{ $category->description }}</textarea></label>
<label>Порядок сортування<input type="number" name="sort_order" value="{{ $category->sort_order }}"></label>
<label><input type="checkbox" name="is_active" value="1" {{ $category->is_active?'checked':'' }}> Активна</label>
<button type="submit" class="btn btn-primary">Зберегти</button>
</form>
@endsection
