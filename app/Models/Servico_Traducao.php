<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico_Traducao extends Model
{
    public $table = 'servicos_traducoes';
    protected $primaryKey = 'servico_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['designacao', 'descricao', 'idioma_codigo', 'servico_id'];

    public function servico()
    {
        return $this->belongsTo(Servico::class, array('servico_id', 'idioma_codigo'));
    }
    
}
