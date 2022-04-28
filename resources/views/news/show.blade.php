@extends('layouts.master')

@section('content')

<div class="blog-post">
    <h2 class="blog-post-title">{{$news->title}}</h2>
    @can('update', $news)
    <a href="/news/{{$news->code}}/edit">Изменить статью</a>
    @endcan
    <br>

    <p class="blog-post-meta">{{$news->created_at->toFormattedDateString()}}</p>
    {{$news->detail_text}}
    <hr>

    @include('news.tags', ['tags' => $news->tags])
    <hr>
    @include('comments', ['comments' => $news->comments])
    <hr>
    <a href="/news">Вернуться к новостям</a>
</div>
@endsection