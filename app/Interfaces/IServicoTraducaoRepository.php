<?php

namespace App\Interfaces;

use App\Interfaces\IGenericoRepository;


interface IServicoTraducaoRepository extends IGenericoRepository
{
    public function getTraducao($idioma);
}