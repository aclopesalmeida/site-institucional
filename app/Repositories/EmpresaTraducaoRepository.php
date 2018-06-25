<?php

namespace App\Repositories;

use App\Interfaces\IEmpresaTraducaoRepository;
use App\Repositories\GenericoRepository;
use App\Models\Empresa_Traducao;


class EmpresaTraducaoRepository extends GenericoRepository implements IEmpresaTraducaoRepository
{
    protected $model;

    public function __construct(Empresa_Traducao $model)
    {
        $this->model = $model;
    }


    public function getTraducao($idioma, $id)
    {
        $condicao = function($query) use ($id) {
            $query->where('id', $id);
        };

        return $this->model->where('idioma_codigo', $idioma)->whereHas('empresa', $condicao)->with(['empresa' => $condicao])->first();
    }
}