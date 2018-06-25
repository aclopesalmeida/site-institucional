<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag_Traducao extends Model
{
    public $table = 'tags_traducoes';
    protected $primaryKey = 'tag_id';
    protected $fillable = ['nome', 'tag_id', 'idioma_codigo'];

    public function tag()
    {
        return $this->belongsTo(Tag::class, array('tag_id', 'idioma_codigo'));
    }
}
