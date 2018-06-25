@extends('layouts.main')

@section('content')

        <h1>{{ __('menus.contactos') }}</h1>

        <div class="row" id="contactos">
            <form action="" method="POST" id="formulario-contactos" class="col-6">
                @include('partials.validacao')

                <input name="nome" placeholder="{{ __('outros.nome') }}"/>

                <input name="email" placeholder="Email"/>

                <textarea name="mensagem" placeholder="{{ __('outros.mensagem') }}"></textarea><br>


                {{ csrf_field() }}

            <button id="form-btn-contactos">{{ __('outros.enviar-btn') }}</button>
            </form>

            <div class="col-6" id="info">
                <p><span><i class="fas fa-map-marker"></i></span> {{ $empresa->morada }}</p>
                <p><span><i class="fas fa-phone"></i></span> {{ $empresa->telefone }}</p>
                <p><span><i class="fas fa-envelope"></i></span> {{ $empresa->email }}</p>
            </div>
        </div>

@endsection