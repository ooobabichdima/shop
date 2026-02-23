@extends('layouts.app')
@section('title', 'Блог - Strikeball Shop')
@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a><span class="crumbs-sep">/</span><span>Блог</span>
</div>
<h1 style="margin:24px 0">Блог</h1>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:16px;margin-bottom:40px">
@foreach($posts as $post)
    <a href="{{ route('blog.show', $post->slug) }}" class="card" style="padding:0;display:block">
        @if($post->featured_image)
        <img src="{{ asset('storage/' . $post->featured_image) }}" style="width:100%;height:200px;object-fit:cover" alt="{{ $post->title }}">
        @endif
        <div style="padding:20px">
            <h3 style="margin:0 0 8px;font-size:18px">{{ $post->title }}</h3>
            <p style="color:var(--text3);font-size:14px;margin:0">{{ Str::limit($post->excerpt, 120) }}</p>
            <div style="margin-top:12px;font-size:12px;color:var(--text3)">{{ $post->published_at->format('d.m.Y') }}</div>
        </div>
    </a>
@endforeach
</div>
{{ $posts->links() }}
@endsection
