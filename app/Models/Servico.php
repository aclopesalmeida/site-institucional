<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    public $table = 'servicos';
    public $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['imagem'];

    public function servicos_traducoes()
    {
        return $this->hasMany(Servico_Traducao::class, 'servico_id');
    }
}
