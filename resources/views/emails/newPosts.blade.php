Здравствуйте, мы подготовили для вас новые статьи за эту неделю:

@foreach($posts as $post)
    <h2>{{$post->title}}</h2>
    <p>{{$post->preview_text}}</p>
    <a href="/posts/{{$post->code}}">Читать на сайте</a>
@endforeach