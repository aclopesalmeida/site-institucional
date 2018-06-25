<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Utilizador;
use App\Interfaces\IUtilizadorRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UtilizadoresController extends Controller
{
    private $utilizadorRepo;

    public function __construct(IUtilizadorRepository $utilizador_repo)
    {
        $this->utilizadorRepo = $utilizador_repo;
    }

    public function getLogin()
    {
        return view('admin.home');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if(Auth::attempt($request->except(['_token'])))
        {
            return redirect()->route('admin.home');
        }
        else 
        {
            return redirect()->route('admin.home')->with('erro', 'Erro');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.home');
    }



    public function getRegistar()
    {
        return view('admin.utilizadores.registar');
    }

    public function postRegistar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|email|unique:utilizadores',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if( $validator->fails() )
        {
            return $validator->messages();
        }

        $request['password'] = Hash::make($request['password']);

        $this->utilizadorRepo->criar($request->except(['__token', 'password_confirmation']));
        return redirect()->route('admin.utilizadores');
    }
    


    public function utilizadores()
    {
        $utilizadores = $this->utilizadorRepo->getAll();

        return view('admin.utilizadores.listagem')->with('utilizadores', $utilizadores);
    }


    public function getEditar(Request $request, $id)
    {
        $utilizador = $this->utilizadorRepo->get($id);

        if(is_null($utilizador))
        {
            return redirect()->back();
        }

        return view('admin.utilizadores.editar')->with('utilizador', $utilizador);
    }

    public function postEditar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email'=> 'email|required',
            'password' => 'required',
            'novaPassword' => 'min:6|nullable|confirmed',
            'novaPassword_confirmation' => 'min:6|nullable'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $dados = ['nome' => $request['nome'], 
                  'email' => $request['email']
        ];
        if(!is_null($request['novaPassword']))
        {
            $dados['password'] = Hash::make($request['novaPassword']);
        }

        $this->utilizadorRepo->editar($request['id'], $dados);

        return redirect()->route('admin.utilizadores');
    }


    public function getApagar($id)
    {
        $utilizador = $this->utilizadorRepo->get($id);
        if(is_null($utilizador))
        {
            return redirect()->back();
        }

        return view('admin.utilizadores.apagar')->with('utilizador', $utilizador);
    }

    public function postApagar($id)
    {
        $utilizador = $this->utilizadorRepo->get($id);
        if( is_null($utilizador) || $utilizador->email == 'aclopesalmeida@gmail.com' )
        {
            return redirect()->back();
        }

        $this->utilizadorRepo->apagar($id);

        return redirect()->route('admin.utilizadores');
    }
}
