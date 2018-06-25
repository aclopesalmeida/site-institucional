@extends('layouts.admin')

@section('content')

<div class="col-12 ver-servico">
        @foreach($servico->servicos_traducoes as $s)
            <h1>{{$s->designacao}}</h1>
        @endforeach

    @include('partials.servico')

    <a href="{{ route('admin.servicos.editar', $servico->id) }}" class="crud-btn">Editar</a>
</div>

@endsection

   