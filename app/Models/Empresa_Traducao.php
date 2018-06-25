<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa_Traducao extends Model
{
    public $table = 'empresas_traducoes';
    public $timestamps = false;
    protected $fillable = ['descricao', 'idioma_codigo', 'empresa_id'];


    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
