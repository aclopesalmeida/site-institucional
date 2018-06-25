@extends('layouts.admin')


@section('content')
<div class="col-12 ver-apagar-painel">
        <h1>Tem a certeza que deseja apagar este serviço?<h1>
                
            @foreach($servico->servicos_traducoes as $s)
                <h2>{{$s->designacao}}</h2>
            @endforeach
        
           @include('partials.servico')
        
            <form action="{{ route('admin.servicos.apagar', ['servico_id' => $servico->id]) }}" method="POST" class="col-12">
                <input type="hidden" name="id" value="{{ $servico->id }}"/>
                {{ csrf_field() }}
                <button class="crud-btn">Apagar</button>
            </form>
</div>

 



@endsection