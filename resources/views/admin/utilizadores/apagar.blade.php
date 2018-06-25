@extends('layouts.admin')

@section('content')

<form action="{{route('admin.utilizadores.apagar', $utilizador->id)}}" method="POST">
    <span>Nome: {{$utilizador->nome}}</span>
    
    <span>Email: {{$utilizador->email}}</span>

    <input type="hidden" value="{{$utilizador->id}}" name="id" id="uid"/>

    {{ csrf_field() }}

    <button class="editar-apagar-btn">Apagar utilizador</button>
</form>

<div id="dialog" title="Apagar utilizador">
    <p>Tem a certeza que deseja apagar este utilizador?</p>
  </div>

@endsection