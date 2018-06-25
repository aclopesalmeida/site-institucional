@extends('layouts.admin')


@section('content')

    <h1>Selecione uma das seguintes opções.</h1>

    <h2>1. Criar um novo post.</h2>

    @include('partials.validacao')

    <form action="{{ route('admin.posts.criar') }}" method="POST" class="admin-posts-criar" class="col-12 no-padding" enctype="multipart/form-data">

        <input type="text" name="titulo" placeholder="Título"/>

        <textarea name="corpo" class="posts-editor"></textarea>

        <span class="margin-top">Selecione uma imagem:</span>
        <input type="file" name="imagem"/>     

        {{ csrf_field() }}

        <!--tags-->
        <select name="tags[]" multiple>
            <option disabled>Selecione as tags desejadas</option>
            @foreach($tags as $tag)
                @foreach($tag->tags_traducoes as $t)
                    <option value="{{$tag->id}}" >{{$t->nome}}</option>
                @endforeach
            @endforeach
        </select>

        <button class="crud-btn">Criar post</button>
</form>

<h2 class="margin-top">2. Criar uma tradução para um post existente.</h2>

@include('partials.validacao')

    <form action="{{ route('admin.posts.criar') }}" method="POST" class="admin-posts-criar col-12 no-padding">

    <input type="text" name="titulo" placeholder="Título" value="{{ Request::old('titulo') }}"/>
            
    <textarea name="corpo" class="posts-editor">{{ Request::old('corpo') }}</textarea>
    
    {{ csrf_field() }}

        <select name="post">
                @if(count($posts) > 0)
                    <option selected disabled>Selecione o post</option>
                    @foreach($posts as $post)
                        @foreach($post->post_traducoes as $p)
                            <option value="{{$post->id}}">{{$p->titulo}}</option>
                        @endforeach
                    @endforeach
                @else 
                    <option selected disabled>Sem posts criados.</option>
                @endif
        </select>

        <select name="lingua" required>
            <option disabled selected>Selecione o idioma</option>
            <option value="en">Inglês</option>
        </select>

        {{ csrf_field() }}

        <input type="hidden" name="traducao" value="true">
       
        <button class="crud-btn">Criar tradução</button>
</form>


@endsection