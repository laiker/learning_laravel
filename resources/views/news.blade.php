@extends('layouts.master')

@section('content')

    <h3 class="pb-3 mb-4 font-italic border-bottom">
    Свежие статьи
    </h3>

    
    @foreach($news as $new)
      <div class="blog-post">
        <h2 class="blog-post-title"><a href="/news/{{$new->code}}">{{$new->title}}</a></h2>
        <p class="blog-post-meta">{{$new->created_at->toFormattedDateString()}}</p>
        {{$new->preview_text}}
        @include('news.tags', ['tags' => $new->tags])
      </div>
    @endforeach

    <nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
    </nav>
@endsection