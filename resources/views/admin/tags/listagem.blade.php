@extends('layouts.admin')

@section('content')
    <div class="criar-btn col-12 no-padding">
            <a href="{{route('admin.tags.criar')}}">Criar nova tag</a>
    </div>
      
    <div id="admin-tags" class="col-12" >
        <div class="row">
            <div class="col-4 header no-padding"><p>Tag</p></div>
            <div class="header col-8"><p>Opções</p></div>
        </div>
        @foreach($tags as $tag)
            @foreach($tag->tags_traducoes as $t)
                <div class="row admin-tag">
                    <div class="col-4 data designacao">
                        <p>{{$t->nome}}</p>
                    </div>
                    <div class="col-8 data opcoes">
                        <div>
                            <a href="{{route('admin.tags.editar', $tag->id)}}" class="admin-tags-editar">Editar</a> 
                            | 
                            <form action="{{ route('admin.tags.apagar', $tag->id) }}" method="POST" id="formulario-apagar-tag">
                                <input type="hidden" name="id" value="{{$tag->id}}"/>
                                {{ csrf_field() }}
                                <button class="pointer">Apagar</button> 
                            </form>
                        </div>
                    </div>
                <div class="admin-tag-dialog" title="Editar tag">
                        <form action="#" method="POST">
                            <input type="text" name="nome" value="{{$t->nome}}"/>
                            <input type="hidden" name="tid" value="{{$tag->id}}"/>
                            {{ csrf_field() }}
                        </form>
                </div>
                
            </div> <!--end row-->
                @endforeach
        @endforeach
    </div>

@endsection