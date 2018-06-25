<?php

namespace App\Repositories;

use App\Interfaces\IGenericoRepository;


class GenericoRepository implements IGenericoRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /*
        $with = ['tags'];
        $where = ['tags' => ['nome' => 'desporto']];
    */

    public function adicionarJoins($query, $with, $where)
    {
        foreach($with as $relacao)
        {
            $keys = array_keys($where); //
            if(in_array($relacao, $keys)) /* se a relacao tem uma condicionante*/
            {
                $condicao = $where[$relacao];
                foreach($condicao as $k => $v)
                {
                    $query = $query->with([$relacao => function($q) use($k, $v) {
                        $q->where($k, $v);
                    }])->whereHas($relacao, function($q) use ($k, $v) {
                        $q->where($k, $v);
                    });
                }
            }
            else
            {
                $query = $query->with($relacao);
            }
        }
        return $query;
    }


    public function get(int $id, array $with = null, array $where = null)
    {
        if(is_null($with))
        {
             return $this->model->find($id);
        }
        else
        {
            $query = $this->model->where('id', $id);
            $resultado = $this->adicionarJoins($query, $with, $where);
            return $resultado->first();
        }
    }


    public function getAll(array $with = null, array $where = null, string $ordemColuna = null, string $ordemDirecao = null, int $paginacao = null)
    {
        $ordemColuna = $ordemColuna ?? 'id';
        $ordemDirecao = $ordemDirecao ?? 'ASC';

        if(is_null($with))
        {
            $query = $this->model->orderBy($ordemColuna, $ordemDirecao);
            return is_null($paginacao) ? $query->paginate() : $query->paginate($paginacao);
        }
        else
        {
            $query = $this->model->orderBy($ordemColuna, $ordemDirecao);
            $resultado = $this->adicionarJoins($query, $with, $where);
            return is_null($paginacao) ? $resultado->get() : $resultado->paginate($paginacao);
        }
    }


    public function criar($dados)
    {
        return $this->model->create($dados);
    }
    

    public function editar($id, $dados, array $condicoes = null)
    {

        if(is_null($condicoes))
        {
            $modelo = $this->model->find($id);
        }
        else
        {
            $modelo = $this->model;
            foreach($condicoes as $k => $v)
            {
                $modelo = $modelo->where($k, $v);
            }
            $modelo->update($dados);
        }

        $modelo->update($dados);
    }

    public function editarTraducoes(int $id, string $relacao, $idioma, array $dados)
    {
        $modeloTraducao = $this->model->find($id)->$relacao->where('idioma_codigo', $idioma)->first();
        $modeloTraducao->update($dados);
    }



    public function apagar($id)
    {
        $this->model->find($id)->delete();
    }
}