<?php

namespace App\Repositories;

use App\Interfaces\IServicoRepository;
use App\Repositories\GenericoRepository;
use App\Models\Servico;


class ServicoRepository extends GenericoRepository implements IServicoRepository
{
    protected $model;

    public function __construct(Servico $model)
    {
        $this->model = $model;
    }
}