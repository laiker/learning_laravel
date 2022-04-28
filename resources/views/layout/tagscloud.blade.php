@php
$tagsCloud = $tagsCloud ?? collect();
@endphp

@if($tagsCloud->isNotEmpty())
    <div class="p-3 mb-3 bg-light rounded">
        <h4 class="font-italic">Облако тегов</h4>
        @foreach($tagsCloud as $tag)
            <a class="badge badge-primary" href="/tag/{{$tag->name}}">{{$tag->name}}</a>
        @endforeach
    </div>
@endif