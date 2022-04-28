@extends('layouts.master')
@section('content')
<div class="container">
<h1>Отправить уведомление</h1>

    <div class="bd-example">
        @include('layout.errors')
        <form action="/service" method="POST">
        @csrf
        <div class="form-group">
            <label for="inputTitle">Заголовок уведомления</label>
            <input id="inputTitle" type="text" name="title" class="form-control" placeholder="Введите заголовок уведомления">
        </div>
        <div class="form-group">
            <label for="inputText">Текст  ведомления</label>
            <textarea name="text" class="form-control" id="inputText" placeholder="Введите описание проблемы"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</div>
@endsection