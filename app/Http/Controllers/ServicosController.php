<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Interfaces\IServicoRepository;

class ServicosController extends Controller
{
    private $servicoRepo;


    public function __construct(IServicoRepository $servico_repository)
    {
        $this->servicoRepo = $servico_repository;
    }


    public function index(Request $request)
    {
        $idioma = $request['idioma'] ?? App::getLocale();

        $servicos = $this->servicoRepo->getAll(['servicos_traducoes'], ['servicos_traducoes' => ['idioma_codigo' => $idioma]]);

        return view('servicos.index')->with('servicos', $servicos);

    }
}
