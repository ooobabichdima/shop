@extends('layouts.app')
@section('title', $post->meta_title ?: $post->title)
@section('content')
<div class="crumbs">
    <a href="{{ route('home') }}">Головна</a><span class="crumbs-sep">/</span><a href="{{ route('blog.index') }}">Блог</a><span class="crumbs-sep">/</span><span>{{ $post->title }}</span>
</div>
<article style="max-width:800px;margin:40px auto">
    <h1 style="margin-bottom:16px">{{ $post->title }}</h1>
    <div style="color:var(--text3);font-size:14px;margin-bottom:24px">
        <span>{{ $post->published_at->format('d F Y') }}</span> • 
        <span>{{ $post->author->name }}</span> • 
        <span>{{ $post->views }} переглядів</span>
    </div>
    @if($post->featured_image)
    <img src="{{ asset('storage/' . $post->featured_image) }}" style="width:100%;border-radius:var(--radius-lg);margin-bottom:32px" alt="{{ $post->title }}">
    @endif
    <div style="line-height:1.8;font-size:16px">{!! $post->content !!}</div>
</article>
@endsection
