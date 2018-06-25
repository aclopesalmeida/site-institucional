<?php

namespace App\Repositories;

use App\Interfaces\ITagRepository;
use App\Repositories\GenericoRepository;
use App\Models\Tag;


class TagRepository extends GenericoRepository implements ITagRepository
{
    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function tagsPorPost(int $post_id, string $idioma)
    {
        return $this->model
                    ->whereHas('posts', function($q) use ($post_id) {
                        $q->where('post_id', $post_id);
                    })
                    ->with('posts')   
                    ->with(['tags_traducoes' => function($q) use ($idioma) {
                        $q->where('idioma_codigo', $idioma);
                    }])
                    ->get();
    }


    
    public function getTraducao($query, $idioma)
    {
        $condicao = function($query) use ($idioma) { 
            $query->where('idioma_codigo', $idioma);
        };

        return $query->with(['tags_traducoes' => $condicao])->whereHas('tags_traducoes', $condicao)->get();
    }

   

    

    
}