
<nav id="admin-nav" class="row">  
    <span class="icone-menu"><i class="fas fa-bars"></i></span>  
    <span class="fechar-nav-btn pointer"><i class="far fa-times-circle"></i></span>  
    <div id="admin-nav-ul-container" class="col-10 offset-1 no-padding">
        <ul id="admin-nav-ul">
            <li><a href="{{ route('admin.home') }}">Home</a></li>
            <li>
                <a href="#">Conteúdos</a>
                <ul class="submenu">
                    <li><a href="{{ route('admin.empresa.editar') }}">Empresa</a></li>
                    <li><a href="{{ route('admin.servicos') }}">Serviços</a></li>
                    <li><a href="{{ route('admin.posts') }}">Posts</a></li>
                    <li><a href="{{ route('admin.tags') }}">Tags</a></li>
                    <li><a href="{{ route('home') }}">Ver website</a></li>
                </ul>
            </li>
        <li><a href="{{ route('admin.utilizadores') }}">Utilizadores</a></li>
        <li><a href="{{ route('admin.logout') }}">Logout</a></li>
        <li class="idioma-controlos">
                <a href="{{route('mudarIdioma', 'pt')}}" class="{{ App::getLocale() == 'pt' ? 'selecionado' : ''}}">PT</a> | <a href="{{route('mudarIdioma', 'en')}}" class="{{ App::getLocale() == 'en' ? 'selecionado' : ''}}">EN</a>
            </li>
            </ul>
        </div>
    </nav>