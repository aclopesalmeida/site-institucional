@extends('layouts.admin')


@section('content')

    <h1>Editar post</h1>

    @include('partials.validacao')

    @foreach($post->post_traducoes as $p)

    <form action="{{ route('admin.posts.editar', ['post_id' => $post->id, 'post_name' => str_replace(' ', '-', trim($p->titulo))]) }}" method="POST" class="admin-formulario-criar-editar col-12" enctype="multipart/form-data">

        <span>Título:</span>
        <input type="text" name="titulo" value="{{$p->titulo}}"/>

        <textarea name="corpo" class="posts-editor">{{$p->corpo}}</textarea>

        <span class="margin-top">Imagem atual:</span>
         <img src="{{ asset('imagens/' . $post->imagem) }}" alt="{{ $p->titulo}}">
        
         <p>Selecione uma imagem:</p>
        <input type="file" name="imagem"/>

        <input type="hidden" value="{{$post->id}}" name="post_id"/>
        <input type="hidden" value="{{$p->titulo}}" name="post_nome"/>

        <span>Selecione o idioma:</span>
        <select name="lingua">
            <option value="pt" {{$p->idioma_codigo == 'pt' ? 'selected' : ''}}>Português</option>
            <option value="en" {{$p->idioma_codigo == 'en' ? 'selected' : ''}}>Inglês</option>
        </select>

        {{ csrf_field() }}

        <!--tags-->
        <span class="margin-top">Selecione as tags:</span>
        <select name="tags[]" multiple>
            @foreach($tags as $tag)
                @foreach($tag->tags_traducoes as $t)
                    @foreach($postTags as $post_tag)
                        @if($tag->id === $post_tag->id)
                            <option value="{{$tag->id}}" selected>{{$t->nome}}</option>
                            <?php continue 2; ?>
                        @endif
                    @endforeach
                    <option value="{{$tag->id}}">{{$t->nome}}</option>
                @endforeach
            @endforeach
        </select>
    <button class="crud-btn">Editar post</button>
</form>
@endforeach


@endsection