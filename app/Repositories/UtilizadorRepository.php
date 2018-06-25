<?php

namespace App\Repositories;

use App\Interfaces\IUtilizadorRepository;
use App\Repositories\GenericoRepository;
use App\Models\Utilizador;


class UtilizadorRepository extends GenericoRepository implements IUtilizadorRepository
{
    protected $model;

    public function __construct(Utilizador $model)
    {
        $this->model = $model;
    }
}