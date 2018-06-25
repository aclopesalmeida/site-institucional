

        @foreach($posts as $post)
            @foreach($post->post_traducoes as $p) 
            <div class="post">    
                <a href="{{ route('blog.post', ['post_name' => str_replace(" ", "-", trim($p->titulo)), 'post_id' => $post->id]) }}">
                    <h2>{{$p->titulo}}</h2>
                    @if(!is_null($post->imagem))
                     <img src="{{ asset('imagens/' . $post->imagem) }}" alt="{{ $p->titulo}}" class="img-fluid">
                    @endif
                    <p>{!! Illuminate\Support\Str::words($p->corpo, 100) !!}</p>
                </a>

                @if(count($post->tags) > 0)
                <p class="post-tags">Tags:
                    @foreach($post->tags as $tag)
                        @foreach($tag->tags_traducoes as $t)
                            @if($t->idioma_codigo == App::getLocale())
                            <a class="post-tag" href="{{ route('blog.posts_por_tag', ['tag_id' => $tag->id, 'tag_name' => $t->nome]) }}"> {{ $t->nome }}{{ $loop->parent->last ? '' : ', '}}</a>
                            @endif
                        @endforeach
                    @endforeach
                </p>
                @endif
            </div>   
            @endforeach
        @endforeach



            
