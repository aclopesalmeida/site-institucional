@extends('layouts.admin')


@section('content')

    <h1>Editar serviço</h1>

    @include('partials.validacao')

    <form action="{{ route('admin.servicos.editar', $servico->id) }}" method="POST" class="admin-formulario-criar-editar col-12" enctype="multipart/form-data">

        @foreach($servico->servicos_traducoes as $s)
            <span>Designação:</span>
            <input type="text" name="designacao" value="{{$s->designacao}}"/>

            <span>Descrição:</span>
            <textarea name="descricao">{{$s->descricao}}</textarea>

            <span>Selecione a imagem:</span>
            <input type="file" name="imagem"/>

            <span>Selecione o idioma:</span>
            <select name="lingua">
                <option value="pt" {{$s->idioma_codigo == 'pt' ? 'selected' : ''}}>Português</option>
                <option value="en" {{$s->idioma_codigo == 'en' ? 'selected' : ''}}>Inglês</option>
            </select>

            <input type="hidden" value="{{$servico->id}}" name="servico_id"/>

            {{ csrf_field() }}

            <button class="crud-btn">Editar serviço</button>
        @endforeach
    </form>


@endsection