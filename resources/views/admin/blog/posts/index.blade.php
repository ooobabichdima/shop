@extends('admin.layout')
@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:20px">
<h1>Статті блогу</h1>
<a href="{{ route('admin.blog.posts.create') }}" class="btn btn-primary">Додати статтю</a>
</div>
<table class="admin-table">
<tr><th>Заголовок</th><th>Автор</th><th>Статус</th><th>Дата публікації</th><th>Дії</th></tr>
@foreach($posts as $post)
<tr>
<td><a href="{{ route('admin.blog.posts.edit', $post) }}">{{ $post->title }}</a></td>
<td>{{ $post->author->name }}</td>
<td>{{ $post->status }}</td>
<td>{{ $post->published_at?->format('d.m.Y') }}</td>
<td>
<a href="{{ route('admin.blog.posts.edit', $post) }}">Редагувати</a>
<form method="POST" action="{{ route('admin.blog.posts.destroy', $post) }}" style="display:inline">@csrf @method('DELETE')<button type="submit" onclick="return confirm('Видалити?')">Видалити</button></form>
</td>
</tr>
@endforeach
</table>
{{ $posts->links() }}
@endsection
