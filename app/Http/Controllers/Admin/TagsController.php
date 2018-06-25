<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ITagRepository;
use App\Interfaces\ITagTraducaoRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class TagsController extends Controller
{
    private $tagRepo;

    public function __construct(ITagRepository $tag_repo, ITagTraducaoRepository $tag_tradu_repo)
    {
        $this->tagRepo = $tag_repo;
        $this->tagTraduRepo = $tag_tradu_repo;
    }


    public function index(Request $request)
    {
        $idioma = App::getLocale();

        $tags = $this->tagRepo->getAll(
            ['tags_traducoes'], 
            ['tags_traducoes' => ['idioma_codigo' => $idioma]]
        );

        return view('admin.tags.listagem')->with('tags', $tags); 
    }



    public function getCriar(Request $request)
    {

        $tags = $this->tagRepo->getAll(['tags_traducoes'], ['tags_traducoes' => ['idioma_codigo' => config('app.default_locale') ]]);

        return view('admin.tags.criar')->with('tags', $tags);
    }

    public function postCriar(Request $request)
    {
        $idioma = App::getLocale();

        $validator = Validator::make($request->all(), [
            'nome' => 'required_without_all:tag,idioma,traducao',
            'tag' => 'required_with:idioma,traducao',
            'lingua' => 'required_with:tag',
            'traducao' => 'required_With:tag'
,        ]);

        if($validator->fails())
        {
            $tags = $this->tagRepo->getAll(
                ['tags_traducoes'], 
                ['tags_traducoes' => ['idioma_codigo' => $idioma]]
            );
            return view('admin.tags.criar')->withErrors($validator)->with([
                'tags' => $tags
            ]);
        }

        /* se e uma traduçao para uma tag existente */
        if(!is_null($request['tag'])) 
        {
             $this->tagTraduRepo->criar([
                'nome' => $request['traducao'],
                'idioma_codigo' => $request['lingua'],
                'tag_id' => $request['tag']
            ]);
        }
        else /* se e uma nova tag */
        {
            $tag = $this->tagRepo->criar(array());
            $this->tagTraduRepo->criar([
                'nome' => $request['nome'],
                'idioma_codigo' => config('app.default_locale'),
                'tag_id' => $tag->id
            ]);
        }
        
        return redirect()->route('admin.tags');
    }



    public function getEditar(Request $request)
    {
        $idioma = App::getLocale();

        $tag = $this->tagRepo->get($request['id'], ['tags_traducoes'], ['tags_traducoes' => ['idioma_codigo' => $idioma]]);

        return view('admin.tags.editar')->with('tag', $tag);
    }

    public function postEditar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required'
        ]);

        if($validator->fails())
        {
            return $validator->messages();
        }

        $idioma = App::getLocale();
        $tag = $this->tagRepo->get($request['id']);
        if(is_null($tag)) {
            return redirect()->back();
        }
        $dados = ['nome' => $request['nome']];

        $this->tagTraduRepo->editar($request['id'], $dados, ['tag_id' => $request['id'], 'idioma_codigo' => $idioma]);
        
        return ['ok' => 'ok'];

    }


    public function postApagar(Request $request)
    {
         $this->tagRepo->apagar($request['id']);
        return redirect()->route('admin.tags');
    }
    
}
