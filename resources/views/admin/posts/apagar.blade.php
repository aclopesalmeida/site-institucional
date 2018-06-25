@extends('layouts.admin')


@section('content')
<div class="ver-apagar-painel col-12">
    <h1>Tem a certeza que deseja apagar este post?</h1>
            
    @include('partials.post')

    <form action="" method="POST">
        <input type="hidden" name="id" value="{{ $post->id }}"/>
        {{ csrf_field() }}
            <button class="crud-btn">Apagar</button>
    </form>
</div>




@endsection