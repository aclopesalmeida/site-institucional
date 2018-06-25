@extends('layouts.admin')

@section('content')

<h1>Editar utilizador</h1>

@include('partials.validacao')

<form action="{{route('admin.utilizadores.editar', $utilizador->id)}}" method="POST" id="formulario-editar-utilizador">


    <span>Nome:</span> <input type="text" value="{{$utilizador->nome}}" name="nome">
    
    <span>Email:</span> <input type="email" value="{{$utilizador->email}}" name="email">

    <span>Password:</span> <input type="password" name="password">

    <span>Nova Password</span><input type="password" name="novaPassword"/>
    
    <span>Confirmar password:</span> <input type="password" name="novaPassword_confirmation">

    <input type="hidden" value="{{$utilizador->id}}" name="id"/>

    {{ csrf_field() }}

    <button class="crud-btn">Editar utilizador</button>
</form>

@endsection