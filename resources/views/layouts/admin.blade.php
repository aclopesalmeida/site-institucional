<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

     @include('partials.head_inc')
     
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name') }} - - CMS</title>


    </head>
    <body data-idioma={{App::getLocale()}} class="container-fluid" id="admin">

         
        <div id="overlay"></div>
        <div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-ripple" id="loader"><div></div><div></div></div></div>


        @if(Auth::check())
                @include('partials.admin-navbar')
        @endif

        <div id="admin-content" class="row">
            <div class="col-12 col-sm-10 offset-sm-1">
                    @yield('content')
            </div>
        </div>
    </body>
</html>
