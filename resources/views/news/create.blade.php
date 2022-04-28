@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Создание статьи</h1>
    @include('layout.errors')
    <div class="bd-example">
        <form action="/news" method="POST">
        @csrf
        <div class="form-group">
            <label for="post-code">Код статьи</label>
            <input type="text" value="{{ old('code') }}" name="code" class="form-control" id="post-code" placeholder="Введите код статьи">
        </div>
        <div class="form-group">
            <label for="post-title">Название статьи</label>
            <input type="text" value="{{ old('title') }}" name="title" class="form-control" id="post-title" placeholder="Введите название статьи">
        </div>
        <div class="form-group">
            <label for="post-preview">Анонсный текст статьи</label>
            <input type="text" value="{{ old('preview_text') }}" name="preview_text" class="form-control" id="post-preview" placeholder="Введите текст анонса">
        </div>
        <div class="form-group">
            <label for="post-detail">Детальный текст статьи</label>
            <textarea name="detail_text" class="form-control" id="post-detail" placeholder="Введите детальный текст">{{ old('detail_text') }}</textarea>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" value="1" @if(old('published')) checked @endif name="published" class="form-check-input" id="post-published">
            <label class="form-check-label" for="post-published">Опубликован</label>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</div>
@endsection
