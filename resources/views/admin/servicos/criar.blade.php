@extends('layouts.admin')


@section('content')

<h1>Selecione uma das seguintes opções.</h1>

<h2>1. Criar um novo serviço.</h2>

@include('partials.validacao')

    <form action="{{ route('admin.servicos.criar') }}" method="POST" class="admin-servicos-criar col-12 no-padding" enctype="multipart/form-data">

        <input type="text" name="designacao" placeholder="Designação"/>
        <textarea name="descricao" placeholder="Descreva o serviço aqui."></textarea>

        <input type="file" name="imagem"/>

        <input type="hidden" name="traducao" value="false">

        {{ csrf_field() }}

        <button class="crud-btn">Criar serviço</button>
</form>


<h2 class="margin-top">2. Criar uma tradução para um serviço existente.</h2>

@include('partials.validacao')

    <form action="{{ route('admin.servicos.criar') }}" method="POST" class="admin-servicos-criar col-12 no-padding">


        <select name="servico">
                @if(count($servicos) > 0)
                    <option selected disabled>Selecione o serviço</option>
                    @foreach($servicos as $servico)
                        @foreach($servico->servicos_traducoes as $s)
                            <option value="{{$servico->id}}">{{$s->designacao}}</option>
                        @endforeach
                    @endforeach
                @else 
                    <option selected disabled>Sem servicos criados.</option>
                @endif
        </select>

        <select name="lingua" required>
            <option disabled selected>Selecione o idioma</option>
            <option value="en">Inglês</option>
        </select>

        <input type="text" name="designacao" placeholder="Designação"/><br>
        <textarea name="descricao" placeholder="Descreva o serviço aqui."></textarea>


        {{ csrf_field() }}

        <input type="hidden" name="traducao" value="true">
       
        <button class="crud-btn">Criar tradução</button>
</form>




@endsection