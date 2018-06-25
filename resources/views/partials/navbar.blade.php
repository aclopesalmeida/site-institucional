
    <div class="col-10 offset-1">
        <div class="row">
            <div class="col-lg-6 col-xl-3" id="logotipo-container">
            <a href="{{ route('home') }}"><img src="{{ asset('/imagens/logotipo.png') }}" alt="logotipo" id="logotipo"></a>
            </div>
            <span class="icone-menu"><i class="fas fa-bars"></i></span>  
            <span class="fechar-nav-btn pointer"><i class="far fa-times-circle"></i></span>  
            <div class="col-xl-7 offset-xl-2" id="nav-ul-container">
                <ul>
                    <li><a href="{{route('home') }}">{{ __('menus.empresa') }}</a></li>
                    <li><a href="{{route('servicos') }}">{{ __('menus.servicos') }}</a></li>
                    <li><a href="{{ route('blog.posts') }}">Blog</a></li>
                    <li><a href="{{route('contactos') }}">{{ __('menus.contactos') }}</a></li>
                    <li class="idioma-controlos">
                        <a href="{{route('mudarIdioma', 'pt')}}">PT</a> | <a href="{{route('mudarIdioma', 'en')}}">EN</a>
                    </li>
                </ul>
            </div>
        </div>
</div>

