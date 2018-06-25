<?php

namespace App\Interfaces;

use App\Interfaces\IGenericoRepository;


interface IEmpresaTraducaoRepository extends IGenericoRepository
{
    public function getTraducao($idioma, $id);
}