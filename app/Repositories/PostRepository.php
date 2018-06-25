<?php

namespace App\Repositories;

use App\Interfaces\IPostRepository;
use App\Repositories\GenericoRepository;
use App\Models\Post;


class PostRepository extends GenericoRepository implements IPostRepository
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getPorTitulo(string $search, string $idioma, string $paginacao = null)
    {
        $condicao = function($query) use($idioma) {
            $query->where('idioma_codigo', $idioma);
        };

        $query = $this->model
                        ->with(['post_traducoes' => $condicao])
                        ->whereHas('post_traducoes', $condicao)
                        ->whereHas('post_traducoes', function($q) use ($search) {
                            $q->where('titulo', 'LIKE', '%' . $search . '%')
                               ->orWhere('corpo', 'LIKE', '%' .$search. '%');
                        });

        return is_null($paginacao) ? $query->paginate() : $query->paginate($paginacao);  
    }

    
    public function getPostsPorTag($tag_id, $idioma)
    {
        $condicaoTags = function($q) use ($tag_id) {
            $q->where('tag_id', $tag_id);
        };

        $condicaoPosts = function($q) use ($idioma) 
        {
            $q->where('idioma_codigo', $idioma);
        };

        $posts = $this->model
                ->with(['tags' => $condicaoTags])
                ->with(['post_traducoes' => $condicaoPosts])
                ->whereHas('tags', $condicaoTags)
                ->whereHas('post_traducoes', $condicaoPosts)
                ->get();
        
        return $posts;
    }

    public function gerirTags(int $post_id, array $tags)
    {
        $post = $this->get($post_id);
        $postTagsIds = $post->tags()->pluck('id')->toArray();
        foreach($tags as $tagId)
        {
            if(!in_array($tagId, $postTagsIds))
                $post->tags()->attach($tagId);
        }

        foreach($postTagsIds as $postTag)
        {
            if(!in_array($postTag, $tags))
                $post->tags()->detach($postTag);
        }
        
    }

   
}