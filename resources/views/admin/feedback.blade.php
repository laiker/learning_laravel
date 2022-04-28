@extends('layouts.master')

@section('content')

<table class="table">
  <thead>
    <tr>
      <th scope="col">Номер</th>
      <th scope="col">Email</th>
      <th scope="col">Дата создания</th>
      <th scope="col">Сообщение</th>
    </tr>
  </thead>
  <tbody>
    @foreach($tickets as $ticket)
    <tr>
      <th scope="row">{{$ticket->id}}</th>
      <td>{{$ticket->email}}</td>
      <td>{{$ticket->created_at->toFormattedDateString()}}</td>
      <td>{{$ticket->message}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection