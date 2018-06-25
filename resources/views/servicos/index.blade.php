@extends('layouts.main')

@section('content')

        <h1>{{ __('menus.servicos') }}</h1>


        <div class="row">
        @foreach($servicos as $servico)
            @foreach($servico->servicos_traducoes as $s)
            <div class="col-12 col-lg-6">
                <div class="servico">
                <h2>{{$s->designacao}}</h2>
                <img src="{{ asset('/imagens/' . $servico->imagem)}}" alt="{{ $servico->desginacao }}" class="img-fluid"/>
                <p>{{$s->descricao}}</p>
                </div>
            </div>
            @endforeach
        @endforeach
    </div>


@endsection