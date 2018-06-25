<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;

class GerirIdioma
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $idioma = Cookie::get('institucional-idioma-cook');
        if (is_null($idioma)) {
            $cookie = Cookie::make('institucional-idioma-cook', App::getLocale());
            return $next($request)->withCookie($cookie);
        };

        App::setLocale($idioma);
        
        return $next($request);
    }
}
