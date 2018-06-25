@extends('layouts.main')


@section('content')


<div class=" tags">
    <h1>Tags</h1>
    @forelse($tags as $tag)
    @foreach($tag->tags_traducoes as $t)
        <p class="tag"><a href="{{route('blog.posts_por_tag', ['tag_name' => str_replace(' ', '-', trim($t->nome)), 'tag_id' => $tag->id])}}">&bull; {{ $t->nome }}</a></p>
    @endforeach
@empty
    <p>{{ _('mensagens.sem_tags')}}</p>
@endforelse
       


</div>




@endsection