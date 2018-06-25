<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

        @include('partials.head_inc')
       
    </head>
    <body data-idioma="{{ app()->getLocale() }}" class="container-fluid">

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script> 

        
            <div id="overlay"></div>
            <div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-ripple" id="loader"><div></div><div></div></div></div>

            <nav class="row">
                @include('partials.navbar')
            </nav>

            <div id="content" class="row">
                <div class="col-12 col-sm-10 offset-sm-1">
                        @yield('content')
                </div>
            </div>

            <footer class="row">
               <ul id="footer-navbar" class="col-8 offset-2">
                    <li>[Nome da Empresa] 2018 &copy; {{ __('menus.copyright')}}</li>
               </ul>
               <div id="social-media" class="col-6 offset-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                   <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
               </div>
            </footer>
    
    </body>
</html>
