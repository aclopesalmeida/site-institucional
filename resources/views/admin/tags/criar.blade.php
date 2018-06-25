@extends('layouts.admin')

@section('content')
<h1>Selecione uma das seguintes opções.</h1>

@include('partials.validacao')

<h2>1. Crie uma nova tag.</h2>
    <form action="{{route('admin.tags.criar')}}" method="POST">
        <input placeholder="Nome da tag" name="nome" type="text"/>
        {{ csrf_field() }}
        <button class="crud-btn">Criar tag</button>
    </form>

    <h2 class="margin-top">2. Crie uma tradução para uma tag existente.</h2>
    <form action="{{route('admin.tags.criar')}}" method="POST">
        <select name="tag">
            @if(count($tags) > 0)
                <option selected disabled>Selecione a tag</option>
                @foreach($tags as $tag)
                    @foreach($tag->tags_traducoes as $t)
                        <option value="{{$tag->id}}">{{$t->nome}}</option>
                    @endforeach
                @endforeach
            @else 
                <option selected disabled>Sem tags criadas.</option>
            @endif
        </select>
        
        <select name="lingua">
            <option disabled selected>Selecione o idioma</option>
            <option value="en">Inglês</option>
        </select>
        <input placeholder="Tradução" name="traducao" type="text"/>
        {{ csrf_field() }}
        <button class="crud-btn">Criar tradução</button>
    </form>


@endsection