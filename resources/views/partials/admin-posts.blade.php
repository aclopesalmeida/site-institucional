
        @if(count($posts) > 0)
                <div class="row">
                    <div class="col-4 no-padding header"><p>Post</p></div>
                    <div class="col-8 header"><p>Opções</p></div>
                </div>
                @foreach($posts as $post)
                    @foreach($post->post_traducoes as $p)
                    <div class="row">
                        <div class="col-4 data designacao">
                            <p>{{$p->titulo}}</p>
                        </div>
                        <div class="col-8 data opcoes">
                                <div>
                                <a href="{{route('blog.post', ['post_name' => str_replace(' ', '-', trim($p->titulo)), 'id' => $post->id,])}}">Ver | </a> 
                                <a href="{{route('admin.posts.editar', ['post_id' => $post->id, 'post_name' => str_replace(' ', '-', trim($p->titulo))])}}">Editar | </a> 
                                <a href="{{route('admin.posts.apagar', ['post_id' => $post->id, 'post_name' => str_replace(' ', '-', trim($p->titulo))])}}">Apagar</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endforeach
                <div class="row no-padding">{{ $posts->links() }}</div>
        @else
            <p>Não há posts criados.</p>
        @endif
    