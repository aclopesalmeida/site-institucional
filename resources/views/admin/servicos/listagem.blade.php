@extends('layouts.admin')

@section('content')
    <div class="criar-btn col-12 no-padding">
        <a href="{{ route('admin.servicos.criar') }}">Criar novo serviço</a>
    </div>
    
    <div id="admin-servicos" class="col-12">
        @if(count($servicos) > 0)
            <div class="row">
                <div class="col-4 no-padding header">
                    <p>Serviço</p>
                </div>
                <div class="col-8 header">
                    <p>Opções</p>
                </div>
            </div>
            @foreach($servicos as $servico)
                @foreach($servico->servicos_traducoes as $s)
                <div class="row">
                    <div class="col-4 data designacao">
                        <p>{{$s->designacao}}</p>
                    </div>
                    <div class="col-8 data opcoes">
                        <div>
                            <a href="{{route('admin.servicos.servico', $servico->id)}}">Ver</a> 
                            |
                            <a href="{{ route('admin.servicos.editar', $servico->id) }}">Editar</a> 
                            |
                            <a href="{{route('admin.servicos.apagar', $servico->id) }}">Apagar</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endforeach
        {{ $servicos->links() }}
        @else
            <p>Não há serviços criados.</p>
        @endif



@endsection