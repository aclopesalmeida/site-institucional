@extends('layouts.main')


@section('content')

<div class="col-12 col-sm-10 offset-sm-1 post">
    @foreach($post->post_traducoes as $p)
        <h1 class="post-titulo">{{$p->titulo }}</h1>
    @endforeach
        @include('partials.post')
</div>


@endsection