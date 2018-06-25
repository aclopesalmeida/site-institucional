@extends('layouts.main')

@section('content')

        <h1>Blog</h1>

        <div class="row">
                @if(count($posts) > 0)
                        <div class="col-12 col-xl-8 posts">
                                @include('partials.post_resumo')
                        </div>


                        <aside class="col-12 col-xl-4 tags">
                                <div class="row">
                                        <div class="col-12" id="filtering">
                                                @include('partials.filtering')
                                        </div>
                                        <div class="col-12">
                                                @if(count($tags) > 0)
                                                <h2>Tags</h2>
                                                <div class="row">
                                                @foreach($tags as $tag)
                                                @foreach($tag->tags_traducoes as $t)
                                                        <div class="col-6 col-sm-4"><a href="{{ route('blog.posts_por_tag', ['tag_name' => $t->nome, 'tag_id' => $tag->id]) }}" class="tag">{{ $t->nome }}</a></diV>
                                                @endforeach
                                                @endforeach
                                                </div>
                                        <p><a href="{{ route('blog.tags') }}" id="tags-btn">Ver todas as tags</a></p>
                                        </div>
                                        @endif 
                                </div>
                        </aside> 
                    
                @else
                        <p>{{ _('mensagens.sem_posts') }}</p>
                @endif
        </div>

@endsection