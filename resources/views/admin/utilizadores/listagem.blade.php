@extends('layouts.admin')

@section('content')

<div class="criar-btn col-12 no-padding">
    <a href="{{ route('admin.utilizadores.criar')}}">Criar novo utilizador</a>
</div>

<div id="admin-utilizadores" class="col-12 no-padding">
    <div class="row">
            <div class="col-4 header"><p>Nome</p></div>
            <div class="col-4 header"><p>Email</p></div>
            <div class="col-4 header"><p>Opções</p></div>
    </div>
    @foreach($utilizadores as $utilizador)
    <div class="row">
        <div class="col-4 data designacao"><p>{{$utilizador->nome}}</p></div>
        <div class="col-4 data opcoes"><p>{{$utilizador->email}}</p></div>
        <div class="col-4 data">
                <a href="{{ route('admin.utilizadores.editar', ['id' => $utilizador->id]) }}">Editar</a> | 
                <form action="{{ route('admin.utilizadores.apagar', $utilizador->id) }}" method="POST" id="formulario-apagar-utilizador">
                        <input type="hidden" name="id" value="{{$utilizador->id}}"/>
                        {{ csrf_field() }}
                        <button class="pointer">Apagar</button> 
                </form>
        </div>
    </div>
    @endforeach
</div>

@endsection