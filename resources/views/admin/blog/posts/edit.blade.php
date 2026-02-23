@extends('admin.layout')
@section('content')
<h1>Редагувати статтю</h1>
<form method="POST" action="{{ route('admin.blog.posts.update', $post) }}" enctype="multipart/form-data">
@csrf @method('PUT')
<label>Заголовок*<input type="text" name="title" value="{{ $post->title }}" required></label>
<label>Slug<input type="text" name="slug" value="{{ $post->slug }}"></label>
<label>Короткий опис<textarea name="excerpt" rows="3">{{ $post->excerpt }}</textarea></label>
<label>Контент*<textarea name="content" rows="15" required>{{ $post->content }}</textarea></label>
<label>Зображення<input type="file" name="featured_image" accept="image/*"></label>
@if($post->featured_image)<img src="{{ asset('storage/'.$post->featured_image) }}" style="max-width:200px">@endif
<label>Статус*<select name="status"><option value="draft" {{ $post->status=='draft'?'selected':'' }}>Чернетка</option><option value="published" {{ $post->status=='published'?'selected':'' }}>Опубліковано</option></select></label>
<label>Дата публікації<input type="datetime-local" name="published_at" value="{{ $post->published_at?->format('Y-m-d\TH:i') }}"></label>
<button type="submit" class="btn btn-primary">Зберегти</button>
</form>
@endsection
