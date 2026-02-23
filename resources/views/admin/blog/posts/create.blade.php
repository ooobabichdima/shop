@extends('admin.layout')
@section('content')
<h1>Додати статтю</h1>
<form method="POST" action="{{ route('admin.blog.posts.store') }}" enctype="multipart/form-data">
@csrf
<label>Заголовок*<input type="text" name="title" required></label>
<label>Slug<input type="text" name="slug"></label>
<label>Короткий опис<textarea name="excerpt" rows="3"></textarea></label>
<label>Контент*<textarea name="content" rows="15" required></textarea></label>
<label>Зображення<input type="file" name="featured_image" accept="image/*"></label>
<label>Статус*<select name="status"><option value="draft">Чернетка</option><option value="published">Опубліковано</option></select></label>
<label>Дата публікації<input type="datetime-local" name="published_at"></label>
<label>Meta Title<input type="text" name="meta_title"></label>
<label>Meta Description<textarea name="meta_description" rows="2"></textarea></label>
<button type="submit" class="btn btn-primary">Зберегти</button>
</form>
@endsection
