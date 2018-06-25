<?php

namespace App\Repositories;

use App\Interfaces\IServicoTraducaoRepository;
use App\Repositories\GenericoRepository;
use App\Models\Servico_Traducao;


class ServicoTraducaoRepository extends GenericoRepository implements IServicoTraducaoRepository
{
    protected $model;

    public function __construct(Servico_Traducao $model)
    {
        $this->model = $model;
    }


    public function getTraducao($idioma)
    {

        return $this->model->where('idioma_codigo', 'pt')->each(function ($item) {
           $item->with('servico');
        })->get();
    }
}