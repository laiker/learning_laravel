@extends('layouts.master')

@section('content')

    <h3 class="pb-3 mb-4 font-italic border-bottom">
    Статьи и новости по тегу {{$elements->get('name')}}
    </h3>

    
    @foreach($elements['items'] as $element)
      <div class="blog-post">
        <h2 class="blog-post-title"><a href="/posts/{{$element->code}}">{{$element->title}}</a></h2>
        <p class="blog-post-meta">{{$element->created_at->toFormattedDateString()}}</p>
        {{$element->preview_text}}

        @include('posts.tags', ['tags' => $element->tags])
      </div>
    @endforeach

    <nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
    </nav>
@endsection