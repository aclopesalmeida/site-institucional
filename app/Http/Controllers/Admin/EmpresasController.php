<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\IEmpresaRepository;
use App\Interfaces\IEmpresaTraducaoRepository;
use App\Utilities\GerirImagens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class EmpresasController extends Controller
{
    private $empresaRepo;
    private $empresaTraduRepo;


    public function __construct(IEmpresaRepository $empresa_repository, IEmpresaTraducaoRepository $empresa_tradu_repository) 
    {
        $this->empresaRepo = $empresa_repository;
        $this->empresaTraduRepo = $empresa_tradu_repository;
    }
    

    public function getEditar(Request $request)
    {
        $idioma = $request['idioma'] ?? App::getLocale();

        $empresa = $this->empresaRepo->get(1,['empresas_traducoes'], ['empresas_traducoes' => ['idioma_codigo' => $idioma]]);

        return view('admin.empresa.editar')->with('empresa', $empresa);
    }


    public function postEditar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'descricao' => 'required',
            'morada' => 'required|string',
            'telefone' => 'required|string',
            'email' => 'required|email',
            'imagem' => 'image|mimes:jpg,jpeg,png|nullable'       
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }


        $dados = [
            'nome' => $request['nome'],
            'morada' => $request['morada'],
            'telefone' => $request['telefone'],
            'email' => $request['email']
        ];

        if(!is_null($request['imagem'])) 
        {
            $nomeImagem = GerirImagens::guardar($request, 'empresa', 'imagem');
            $dados['imagem'] = $nomeImagem;
        }

        $idioma = App::getLocale();

        $this->empresaRepo->editar($request['id'], $dados);
        $this->empresaTraduRepo->editar(
            $request['id'],
            ['descricao' => $request['descricao']], 
            ['empresa_id' => $request['id'],
            'idioma_codigo' => $idioma]
        );

        return redirect()->route('admin.empresa.editar');
    }
}
