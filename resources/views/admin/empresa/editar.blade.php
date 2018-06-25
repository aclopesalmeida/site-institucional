@extends('layouts.admin')

@section('content')

    <h1>Editar empresa</h1>

    @include('partials.validacao')

    <form action="{{ route('admin.empresa.editar') }}" method="POST" class="col-12 no-padding" id="formulario-editar-empresa" enctype="multipart/form-data">
<div class="row">
        <div class="col-12 col-lg-7">
            <span>Nome:</span>
            <input type="text" name="nome" value="{{ $empresa->nome }}"/> <br>

            @foreach($empresa->empresas_traducoes as $e)
                <span>Descrição:</span>
                <textarea name="descricao">{{$e->descricao}}</textarea>
            @endforeach

            <span>Morada:</span>
            <input type="text" name="morada" value="{{ $empresa->morada }}"/>

            <span>Telefone:</span>
            <input type="text" name="telefone" value="{{ $empresa->telefone }}">

            <span>Email:</span>
            <input type="email" name="email" value="{{ $empresa->email }}">

            <input type="hidden" name="id" value="{{$empresa->id}}">

            {{ csrf_field() }}

            <button class="crud-btn">Editar empresa</button>
    </div>
    <div class="col-12 col-lg-5">
        <span>Imagem atual:</span>
        <img src="{{ asset('/imagens/' . $empresa->imagem) }}" alt="{{ $empresa->imagem }}" class="img-fluid"/>
        <input type="file" name="imagem">
    </div>
</div>
    </form>
@endsection