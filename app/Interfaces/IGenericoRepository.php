<?php

namespace App\Interfaces;

interface IGenericoRepository
{
    function get(int $id, array $with = null, array $where = null);
    function getAll(array $with = null, array $where = null, string $ordemColuna = null, string $ordemDirecao = null, int $paginacao = null);
    function adicionarJoins($query, $where, $with);
    function criar($dados);
    function editar($id, $dados, array $condicoes = null);
    function editarTraducoes(int $id, string $relacao, $idioma, array $dados);
    function apagar($id);
}