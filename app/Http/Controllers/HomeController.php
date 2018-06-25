<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\IEmpresaRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    private $empresaRepo;

    public function __construct(IEmpresaRepository $empresa_repo)
    {
        $this->empresaRepo = $empresa_repo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idioma = $request['idioma'] ?? App::getLocale();
        $empresa = $this->empresaRepo->get(1, [
            'empresas_traducoes'], ['empresas_traducoes' => ['idioma_codigo' => $idioma]]);

        return view('home.index')->with('empresa', $empresa);
    }


    public function mudarIdioma(Request $request)
    {

        if(!is_null($request['idioma'])) {
            $cookie = Cookie::make('institucional-idioma-cook', $request['idioma'], 360);
            return redirect()->back()->withCookie($cookie);
        }
    }
}
