<?php

namespace App\Repositories;

use App\Interfaces\IEmpresaRepository;
use App\Repositories\GenericoRepository;
use App\Models\Empresa;


class EmpresaRepository extends GenericoRepository implements IEmpresaRepository
{
    protected $model;

    public function __construct(Empresa $model)
    {
        $this->model = $model;
    }
}