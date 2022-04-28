@extends('layouts.admin')

@section('content')

<div class="container">
    <h1>Создание новости</h1>
    @include('layout.errors')
    <div class="bd-example">
        <form action="/news" method="POST">
        @csrf
        <div class="form-group">
            <label for="news-code">Код новости</label>
            <input type="text" value="{{ old('code') }}" name="code" class="form-control" id="news-code" placeholder="Введите код новости">
        </div>
        <div class="form-group">
            <label for="news-title">Название новости</label>
            <input type="text" value="{{ old('title') }}" name="title" class="form-control" id="news-title" placeholder="Введите название новости">
        </div>
        <div class="form-group">
            <label for="news-preview">Анонсный текст новости</label>
            <input type="text" value="{{ old('preview_text') }}" name="preview_text" class="form-control" id="news-preview" placeholder="Введите текст анонса">
        </div>
        <div class="form-group">
            <label for="news-detail">Детальный текст новости</label>
            <textarea name="detail_text" class="form-control" id="news-detail" placeholder="Введите детальный текст">{{ old('detail_text') }}</textarea>
        </div>
        <div class="form-group">
            <label for="news-preview">Теги новости</label>
            <input type="text" name="tags" value="" class="form-control" id="news-tags" placeholder="Введите теги новости">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" value="1" @if(old('published')) checked @endif name="published" class="form-check-input" id="news-published">
            <label class="form-check-label" for="news-published">Опубликован</label>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</div>

@endsection
