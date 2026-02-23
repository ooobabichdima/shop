@extends('layouts.app')
@section('title', $category->name . ' - Блог')
@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a><span class="crumbs-sep">/</span><a href="{{ route('blog.index') }}">Блог</a><span class="crumbs-sep">/</span><span>{{ $category->name }}</span>
</div>
<h1 style="margin:24px 0">{{ $category->name }}</h1>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:16px;margin-bottom:40px">
@foreach($posts as $post)
    <a href="{{ route('blog.show', $post->slug) }}" class="card" style="padding:0;display:block">
        <div style="padding:20px">
            <h3 style="margin:0 0 8px;font-size:18px">{{ $post->title }}</h3>
            <p style="color:var(--text3);font-size:14px;margin:0">{{ Str::limit($post->excerpt, 120) }}</p>
        </div>
    </a>
@endforeach
</div>
{{ $posts->links() }}
@endsection
