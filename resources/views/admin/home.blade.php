@extends('layouts.admin')

@section('content')

@if(Auth::guest())
    <div class="col-12">
        <div class="row" id="admin-home-login">
            <div class="col-12">
            <form method="POST" action="{{route('admin.home')}}" id="formulario-admin" class="col-4 offset-4">
                <input type="text" placeholder="Email" name="email"/><br>
                <input type="password" placeholder="Password" name="password"/>

                {{csrf_field() }}
                <button>Login</button>
            </form>
            <p id="info-teste" class="col-4 offset-4">
                Para fins de teste utilize, por favor, as seguintes credenciais:<br>
                Email: teste@teste.com | Password: teste
            </p>
        </div>
    </div>
</div>
@else

<div id="painel-controlo" class="col-12">
    <div>      
        <h1 class="col-12">Bem-vindo(a) {{ Auth::user()->nome }}!</h1>
        <p class="col-12">Escolha um dos menus para começar a gerir os conteúdos do seu website.</p>
    </div> 
</div>


    @endif




@endsection

