@extends('layouts.admin')

@section('content')

    <h1>Criar novo utilizador</h1>

    <form method="POST" action="{{route('admin.utilizadores.criar')}}">
        <input type="text" name="nome" placeholder="Nome"/>
        
        <input type="email" name="email" placeholder="Email"/>

        <input type="password" placeholder="Password" name="password"/>

        <input type="password" placeholder="Confirmar password" name="password_confirmation"/>

        {{ csrf_field() }}

        <button class="crud-btn">Criar novo utilizador</button>
</form>

@endsection