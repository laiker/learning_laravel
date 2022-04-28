@extends('layouts.master')

@section('content')
<div class="blog-post">
    <h2 class="blog-post-title">{{$post->title}}</h2>
    @can('update', $post)
    <a href="/news/{{$post->code}}/edit">Изменить статью</a>
    @endcan
    <br>
    @showAdminEditLink($post)

    <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}}</p>
    {{$post->detail_text}}
    <hr>

    @include('news.tags', ['tags' => $post->tags])
    <hr>
    @include('comments', ['comments' => $post->comments])
    <hr>
    <h2>История изменений</h2>
    @forelse($post->history as $item)
        <p>{{$item->email}} - {{$item->pivot->created_at}} - {{$item->pivot->before}} - {{$item->pivot->after}}</p>
    @empty
        <p>Нет истории изменений</p>
    @endforelse
    <hr>
    <a href="/">Вернуться на главную</a>
</div>
@endsection