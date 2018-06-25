<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\EnviarEmail;
use App\Interfaces\IEmpresaRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\App;

class ContactosController extends Controller
{
    private $empresaRepo;

    public function __construct(IEmpresaRepository $empresa_repository)
    {
        $this->empresaRepo = $empresa_repository;
    }


    public function index(Request $request)
    {
        $idioma = App::getLocale();

        $empresa = $this->empresaRepo->get(1, ['empresas_traducoes'], ['empresas_traducoes' => ['idioma_codigo' => $idioma]]);

        return view('contactos.index')->with('empresa', $empresa);
    }


    public function postIndex(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nome' => 'nullable|min:2',
            'email' => 'email|required',
            'mensagem' => 'min:3|required'
        ]);

        if($validator->fails()) {
            $errosFormatados = $this->formatarErros($validator);
            return ['erros' => $errosFormatados];
        }

        $envio = EnviarEmail::enviar($request);
        $msg = $envio ? __('mensagens.sucesso') : __('mensagens.erro');

        return ['status' => $msg ];
    }


    protected function formatarErros($validator)
    {
        $errosFormatados = [];
        foreach($validator->errors()->messages() as $k => $v) // ['error field' => 'error field msgs']
        {
                $errosFormatados[$k] = $v[0]; // mostrar apenas 1º erro associado a cada campo do formulario
        }

        return $errosFormatados;
    }
}
