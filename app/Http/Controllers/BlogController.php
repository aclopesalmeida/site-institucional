<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Interfaces\IPostRepository;
use App\Interfaces\ITagRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $postRepo;
    private $tagRepo;

    public function __construct(IPostRepository $post_repository, ITagRepository $tag_repository, IPostRepository $post_repo)
    {
        $this->postRepo = $post_repository;
        $this->tagRepo = $tag_repository;
    }


    public function index(Request $request)
    {
        $idioma = App::getLocale();

        $posts = $this->postRepo->getAll(['post_traducoes', 'tags'], ['post_traducoes' => ['idioma_codigo' => $idioma]], 'created_at', 'DESC');

        if(!is_null($request['sort']))
        {
            $posts = $posts = $this->postRepo->getAll(['post_traducoes', 'tags'], ['post_traducoes' => ['idioma_codigo' => $idioma]], 'created_at', $request['sort']);
            return view('partials.post_resumo')->with('posts', $posts);
        }

        if(!is_null($request['search']))
            $posts = $posts = $this->postRepo->getPorTitulo($request['search'], $idioma);


        $tags = $this->tagRepo->getAll(['tags_traducoes'], ['tags_traducoes' => ['idioma_codigo' => $idioma]]);

        return view('blog.index')->with(['posts' => $posts, 'tags' => $tags]);


    }


    public function post(Request $request, $post_name, $post_id)
    {
        $idioma = $request['idioma'] ?? App::getLocale();

        $post = $this->postRepo->get($post_id, ['post_traducoes', 'tags'], ['post_traducoes' => ['idioma_codigo' => $idioma]]);

        if(is_null($post))
        {
            return redirect()->back();
        }

        $tags = $this->tagRepo->tagsPorPost($post->id, $idioma);

        return view('blog.post')->with(['post' => $post,
                                        'tags' => $tags ]);
    }

    public function tags(Request $request)
    {
        $idioma = $request['idioma'] ?? App::getLocale();
        $tags = $this->tagRepo->getAll(['tags_traducoes'], ['tags_traducoes' => ['idioma_codigo' => $idioma]]);

        return view('blog.tags')->with('tags', $tags);

    }


    public function postsPorTag(Request $request, string $tag_name, int $tag_id)
    {
        $idioma = $request['idioma'] ?? App::getLocale();

        $posts = $this->postRepo->getPostsPorTag($tag_id, $idioma);

        $tag = $this->tagRepo->get($tag_id, ['tags_traducoes'], ['tags_traducoes' => ['idioma_codigo' => $idioma]]);

        $tags = $this->tagRepo->getAll(['tags_traducoes'], ['tags_traducoes' => ['idioma_codigo' => $idioma]]);

        return view('blog.posts_por_tag')->with(['posts' => $posts, 'tag' => $tag, 'tags' => $tags]);

    }
}
