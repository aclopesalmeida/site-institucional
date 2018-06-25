@extends('layouts.admin')

@section('content')
<div class="criar-btn col-12 no-padding">
        <a href="{{ route('admin.posts.criar') }}">Criar novo post</a> 
</div>

<div id="admin-filtering" class="col-12">
    @include('partials.filtering')
</div>

    
    <div id="admin-posts" class="col-12">
        @include('partials.admin-posts')
    </div>


@endsection