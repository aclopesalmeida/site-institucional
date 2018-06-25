<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Interfaces\IServicoRepository;
use App\Interfaces\IServicoTraducaoRepository;
use App\Utilities\GerirImagens;

class ServicosController extends Controller
{
    private $servicoRepo;
    private $servicoTraduRepo;
    
    public function __construct(IServicoRepository $servico_repository, IServicoTraducaoRepository $servico_tradu_repository)
    {
        $this->servicoRepo = $servico_repository;
        $this->servicoTraduRepo = $servico_tradu_repository;
    }


    public function index(Request $request)
    {
        $idioma = $request['idioma'] ?? App::getLocale();
        $servicos = $this->servicoRepo->getAll(['servicos_traducoes'], 
        ['servicos_traducoes' => ['idioma_codigo' => $idioma]], 'created_at', 'DESC', 5);

        return view('admin.servicos.listagem')->with('servicos', $servicos);
    }

    public function servico(Request $request)
    {
        $idioma = $request['idioma'] ?? App::getLocale();
        
        $servico = $this->servicoRepo->get(
            $request['servico_id'], 
            ['servicos_traducoes'], 
            ['servicos_traducoes' => ['idioma_codigo' => $idioma]]
        );

        return view('admin.servicos.ver')->with('servico', $servico);
    }


    public function getCriar()
    {
        $servicos = $this->servicoRepo->getAll(['servicos_traducoes'], ['servicos_traducoes' => ['idioma_codigo' => config('app.default_locale') ]]);

        return view('admin.servicos.criar')->with('servicos', $servicos);
    }

    public function postCriar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'designacao' => 'required',
            'descricao' => 'required',
            'imagem' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
            'lingua' => 'required_if:traducao,true',
            'servico' => 'required_if:traducao,true'
        ]);

        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        if($request->hasFile('imagem')) 
            $imagem = GerirImagens::guardar($request, 'servicos', 'imagem');
        else 
            $imagem = 'padrao.png';

        
        $traducao = [
            'designacao' => $request['designacao'],
            'descricao' => $request['descricao']
        ];

        if($request['traducao'] == false)
        {
            $servico = $this->servicoRepo->criar(array('imagem' => $imagem));
            $traducao['idioma_codigo'] = config('app.default_locale');
            $traducao['servico_id'] = $servico->id;
            $this->servicoTraduRepo->criar($traducao);
        }
        else 
        {
            $servico = $this->servicoRepo->get($request['servico']);
            $traducao['idioma_codigo'] = $request['lingua'];
            $traducao['servico_id'] = $request['servico'];
            $this->servicoTraduRepo->criar($traducao);
        }
      
        $request->session()->flash('Serviço criado com sucesso');

        return redirect()->route('admin.servicos');

    }

    public function getEditar(Request $request)
    {
        $idioma = $request['idioma'] ?? App::getLocale();

        $servico = $this->servicoRepo->get(
            $request['servico_id'], 
            ['servicos_traducoes'], 
            ['servicos_traducoes' => ['idioma_codigo' => $idioma]]
        );

        return view('admin.servicos.editar')->with('servico', $servico);

    }

    public function postEditar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'designacao' => 'required',
            'descricao' => 'required',
            'imagem' => 'image|mimes:jpg,jpeg,png|max:2048|nullable',
            'lingua' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $servico = $this->servicoRepo->get($request['servico_id']);

        if(is_null($servico))
        {
            return redirect()->back();
        }

        // se houve upload de imagem ao editar o serviço, carregamos nova imagem e apagamos a antiga
        if($request->hasFile('imagem'))
        {
            $imagem = GerirImagens::guardar($request, 'servicos', 'imagem');
            GerirImagens::apagar('servicos/' . $servico->imagem); // apagar imagem anterior
        }

        $dados = [
            'designacao' => $request['designacao'], 
            'descricao' => $request['descricao'], 
            'lingua' => $request['lingua']
        ];

        if(isset($imagem)) { // se houve nova imagem, editamos a db
            $this->servicoRepo->editar($request['servico_id'], ['imagem' => $imagem]);
        }

        $this->servicoTraduRepo->editar($request['servico_id'], $dados);

        return redirect()->route('admin.servicos');
    }


    public function getApagar(Request $request)
    {
        $idioma = $request['idioma'] ?? App::getLocale();
        
        $servico = $this->servicoRepo->get(
            $request['servico_id'], 
            ['servicos_traducoes'], 
            ['servicos_traducoes' => ['idioma_codigo' => $idioma]]
        );

        return view('admin.servicos.apagar')->with('servico', $servico);
    }

    public function postApagar(Request $request)
    {
        $idioma = $request['idioma'] ?? App::getLocale();
        
        $servico = $this->servicoRepo->get($request['servico_id']);

        if(is_null($servico))
        {
            return redirect()->back();
        }

        $this->servicoRepo->apagar($request['servico_id']);
        GerirImagens::apagar('servicos', $servico->imagem); 

        return redirect()->route('admin.servicos');
        

    }
}
