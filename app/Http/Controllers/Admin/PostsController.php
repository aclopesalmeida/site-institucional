<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Interfaces\IPostRepository;
use App\Interfaces\IPostTraducaoRepository;
use App\Interfaces\ITagRepository;
use App\Utilities\GerirImagens;

class PostsController extends Controller
{
    private $postRepo;
    private $postTraduRepo;
    private $tagRepo;

    public function __construct(IPostRepository $post_repo, IPostTraducaoRepository $post_tradu_repo, ITagRepository $tag_repo)
    {
        $this->postRepo = $post_repo;
        $this->postTraduRepo = $post_tradu_repo;
        $this->tagRepo = $tag_repo;
    }

    public function index(Request $request)
    {
        $idioma = App::getLocale();

        if( is_null($request['search']) && is_null($request['sort']) ) {
            $posts = $this->postRepo->getAll(['post_traducoes'], ['post_traducoes' => ['idioma_codigo' => $idioma]], 'created_at', 'DESC', 5);
        }
        
        if( !is_null($request['search']) )
        { 
            $posts = $this->postRepo->getPorTitulo($request['search'], $idioma, 5);
        }
        elseif(!is_null($request['sort']) )
        {
            $posts = $this->postRepo->getAll(['post_traducoes'], ['post_traducoes' => ['idioma_codigo' => $idioma]], 'created_at', $request['sort'], 5);
            return view('partials.admin-posts')->with('posts', $posts);
        }

        return view('admin.posts.listagem')->with('posts', $posts);
        
    }


    public function getCriar(Request $request)
    {
        $tags = $this->tagRepo->getAll(['tags_traducoes'], ['tags_traducoes' => ['idioma_codigo' => config('app.default_locale') ]]);
        $posts = $this->postRepo->getAll(['post_traducoes'], ['post_traducoes' => ['idioma_codigo' => config('app.default_locale') ]]); 

        return view('admin.posts.criar')->with(['tags' => $tags, 'posts' => $posts]);
    }


    public function postCriar(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'corpo' => 'required',
            'lingua' => 'required_if:traducao,true',
            'post' => 'required_if:traducao,true',
            'imagem' => 'image|mimes:jpg,jpeg,png|nullable'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $novoPost = array('utilizador_id' => Auth::user()->id);

        if(!is_null($request['imagem'])) {
            $nomeFicheiro = GerirImagens::guardar($request, 'posts', 'imagem');
            $novoPost['imagem'] = $nomeFicheiro;
        }

        $traducao = [
            'titulo' => $request['titulo'],
            'corpo' => $request['corpo']
        ];

        if($request['traducao'] == false)
        {
            $post = $this->postRepo->criar($novoPost);
            $postId = $post->id;
            $traducao['idioma_codigo'] = config('app.default_locale');
            $traducao['post_id'] = $postId;
            $this->postTraduRepo->criar($traducao);
        }
        else 
        {
            $postId = $request['post'];
            $traducao['idioma_codigo'] = $request['lingua'];
            $traducao['post_id'] = $postId;
            $this->postTraduRepo->criar($traducao);
        }

        if(!is_null($request['tags']))
            $this->postRepo->gerirTags($postId, $request['tags']);

        return redirect()->route('admin.posts');

    }

    public function getEditar(Request $request)
    {
        $idioma = $request['idioma'] ?? App::getLocale();

        $post = $this->postRepo->get($request['post_id'],['post_traducoes', 'tags'], ['post_traducoes' => ['idioma_codigo' => $idioma]]);

        if(is_null($post))
        {
            return redirect()->back();
        }
        
        $postTags = $this->tagRepo->tagsPorPost($post->id, $idioma);

        $tags = $this->tagRepo->getAll(['tags_traducoes'], ['tags_traducoes' => ['idioma_codigo' => $idioma]]);

        return view('admin.posts.editar')->with([
            'post' => $post, 
            'postTags' => $postTags, 
            'tags' => $tags
        ]);
    }


    public function postEditar(Request $request)
    {
        $idioma = App::getLocale();

        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'corpo' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $postId = $request['post_id'];
        $post = $this->postRepo->get($postId);
        if(is_null($post)) {
            return redirect()->back();
        }

        $dados = [
            'post_id' => $postId,
            'idioma_codigo' => $request['lingua'],
            'titulo' => $request['titulo'],
            'corpo' => $request['corpo']
        ];

        if(!is_null($request['imagem']))
        {
            $imagem = GerirImagens::guardar($request, 'posts', 'imagem');
            // GerirImagens::apagar($post->imagem);
            $this->postRepo->editar($postId, ['imagem' => $imagem]);
        }

        $this->postTraduRepo->editar($postId, $dados, ['post_id' => $postId, 'idioma_codigo' => $idioma]);
        
        if(!is_null($request['tags']))
            $this->postRepo->gerirTags($postId, $request['tags']);
        

        return redirect()->route('blog.post', ['post_id' => $postId, 'post_name' => $request['post_nome']]);

    }

    public function getApagar(Request $request)
    {
        $idioma = $request['idioma'] ?? App::getLocale();
        
        $post = $this->postRepo->get($request['post_id'],['post_traducoes', 'tags'], ['post_traducoes' => ['idioma_codigo' => $idioma]]);
        
        if(is_null($post))
        {
            return redirect()->back();
        }
        
        $tags = $this->tagRepo->tagsPorPost($post->id, $idioma);

        return view('admin.posts.apagar')->with(['post' => $post, 'tags' => $tags]);

    }

    public function postApagar(Request $request)
    {
        $post = $this->postRepo->get($request['id']);
        if(is_null($post))
        {
            return redirect()->route('admin.posts');
        }

        $this->postRepo->apagar($post->id);
        if(!is_null($post->imagem))
        {
            GerirImagens::apagar($post->imagem);
        }
        return redirect()->route('admin.posts');
    }


    public function postDefinirEnderecoImagem(Request $request)
    {
        $localizacao = public_path('imagens\posts\\');
        return ['location' => $localizacao];
    }
}
