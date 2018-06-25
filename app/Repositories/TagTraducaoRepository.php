<?php

namespace App\Repositories;

use App\Interfaces\ITagTraducaoRepository;
use App\Repositories\GenericoRepository;
use App\Models\Tag_Traducao;


class TagTraducaoRepository extends GenericoRepository implements ITagTraducaoRepository
{
    protected $model;

    public function __construct(Tag_Traducao $model)
    {
        $this->model = $model;
    }

}