<?php

namespace App\Interfaces;

use App\Interfaces\IGenericoRepository;


interface IPostRepository extends IGenericoRepository
{
    function getPorTitulo(string $search, string $idioma);
    function getPostsPorTag($tag_id, $idioma);

    function gerirTags(int $post_id, array $tags_ids);
}