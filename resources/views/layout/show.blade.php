@extends('layouts.master')

@section('content')
<div class="blog-post">
    <h2 class="blog-post-title">{{$post->title}}</h2>
    @can('update', $post)
    <a href="/posts/{{$post->code}}/edit">Изменить статью</a>
    @endcan
    <br>
    @showAdminEditLink($post)

    <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}}</p>
    {{$post->detail_text}}
    <hr>

    @include('posts.tags', ['tags' => $post->tags])
    <hr>
    <a href="/">Вернуться на главную</a>
</div>
@endsection