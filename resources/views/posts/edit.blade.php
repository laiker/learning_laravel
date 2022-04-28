@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Редактирование статьи</h1>
    @include('layout.errors')
    <div class="bd-example">
        <form action="/posts/{{$post->code}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="post-code">Код статьи</label>
            <input type="text" name="code" value="{{ old('code', $post->code) }}" class="form-control" id="post-code" placeholder="Введите код статьи">
        </div>
        <div class="form-group">
            <label for="post-title">Название статьи</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" id="post-title" placeholder="Введите название статьи">
        </div>
        <div class="form-group">
            <label for="post-preview">Анонсный текст статьи</label>
            <input type="text" name="preview_text" value="{{ old('preview_text',$post->preview_text) }}" class="form-control" id="post-preview" placeholder="Введите текст анонса">
        </div>
        <div class="form-group">
            <label for="post-detail">Детальный текст статьи</label>
            <textarea name="detail_text" class="form-control" id="post-detail" placeholder="Введите детальный текст">{{ old( 'detail_text', $post->detail_text)}}</textarea>
        </div>
        <div class="form-group">
            <label for="post-preview">Теги статьи</label>
            <input type="text" name="tags" value="{{ old('tags',$post->tags->pluck('name')->implode(',')) }}" class="form-control" id="post-tags" placeholder="Введите теги статьи">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" value="1" @if($post->published) checked @endif name="published" class="form-check-input" id="post-published">
            <label class="form-check-label"  for="post-published">Опубликован</label>
        </div>
        <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
        <form method="POST" action="/posts/{{$post->code}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
    </div>
</div>
@endsection
