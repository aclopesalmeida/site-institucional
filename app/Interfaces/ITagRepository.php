<?php

namespace App\Interfaces;

use App\Interfaces\IGenericoRepository;


interface ITagRepository extends IGenericoRepository
{
    public function tagsPorPost(int $post_id, string $idioma);
}