@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    <div class="tags">
        @foreach($tags as $tag)
            <a class="badge badge-secondary" href="/tag/{{$tag->name}}">{{$tag->name}}</a>
        @endforeach
    </div>
@endif