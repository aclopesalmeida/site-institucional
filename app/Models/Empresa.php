<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public $table = 'empresas';
    protected $fillable = ['nome', 'morada', 'telefone', 'email', 'imagem'];

    public function empresas_traducoes()
    {
        return $this->hasMany(Empresa_Traducao::class, 'empresa_id');
    }
}