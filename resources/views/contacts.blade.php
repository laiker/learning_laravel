@extends('layouts.master')
@section('content')
<div class="container">
<h1>Контакты</h1>
<p>Текст контактов</p>

    <div class="bd-example">
        @include('layout.errors')
        <form action="/contacts" method="POST">
        @csrf
        <div class="form-group">
            <label for="ticket-email">Email</label>
            <input type="text" name="email" class="form-control" id="ticket-email" placeholder="Введите email">
        </div>
        <div class="form-group">
            <label for="ticket-message">Опишите вашу проблему</label>
            <textarea name="message" class="form-control" id="ticket-message" placeholder="Введите описание проблемы"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</div>
@endsection