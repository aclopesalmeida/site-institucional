<?php

namespace App\Repositories;

use App\Interfaces\IPostTraducaoRepository;
use App\Repositories\GenericoRepository;
use App\Models\Post_Traducao;


class PostTraducaoRepository extends GenericoRepository implements IPostTraducaoRepository
{
    protected $model;

    public function __construct(Post_Traducao $model)
    {
        $this->model = $model;
    }



    public function getTraducao($query, $idioma)
    {
        $posts = $query->with('post')->get();

        return $posts;
    }
}