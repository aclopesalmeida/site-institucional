@extends('layouts.main')


@section('content')


    <div id="img-apresentacao">
        <img src="{{ asset('imagens/img_apresentacao.png') }}" alt="{{$empresa->nome}}" class="img-fluid">
    </div>


    
        <div class="row">
            <h1 class="col-12">{{$empresa->nome}}</h1>
            <div class="col-12">
                <div class="row" id="empresa">
                <div class="col-8">
                        @foreach($empresa->empresas_traducoes as $e)
                            <p>{{$e->descricao}}</p>
                        @endforeach
                </div>
                <div class="col-4">
                    <img src="{{ asset('imagens/' . $empresa->imagem) }}" alt="{{$empresa->nome}}" class="img-fluid"/>
                </div>
            </div>
            </div>
        </div>



@endsection