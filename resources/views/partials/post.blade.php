@foreach($post->post_traducoes as $p)

    @if(Auth::check())
        <div class="post-opcoes">
            <a href="{{route('admin.posts.editar', ['post_id' => $post->id, 'post_name' => str_replace(' ', '-', trim($p->titulo))])}}">Editar</a> 
                |
            <a href="{{route('admin.posts.apagar', ['post_id' => $post->id, 'post_name' => str_replace(' ', '-', trim($p->titulo))])}}">Apagar</a>
        </div>
    @endif
    
    @if(!is_null($post->imagem))
        <img src="{{ asset('imagens/' . $post->imagem) }}" alt="{{ $p->titulo}}" class="img-fluid">
    @endif

    <p class="margin-top">{!! $p->corpo !!}</p>


    @if(count($tags) > 0)
    <p class="post-tags">Tags:
        @foreach($tags as $tag)
            @foreach($tag->tags_traducoes as $t)
                <a class="post-tag" href="{{ route('blog.posts_por_tag', ['tag_id' => $tag->id, 'tag_name' => $t->nome]) }}"> {{ $t->nome }}{{ $loop->parent->last ? '' : ', '}}</a>
            @endforeach
        @endforeach
    </p>
    @endif
@endforeach


