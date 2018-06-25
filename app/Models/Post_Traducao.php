<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_Traducao extends Model
{
    public $table = 'posts_traducoes';
    protected $primaryKey = 'post_id';
    public $increments = false;
    protected $fillable = ['post_id', 'idioma_codigo', 'titulo', 'corpo'];


    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    protected function setKeysForSaveQuery(\Illuminate\Database\Eloquent\Builder $query)
    {
        if (is_array($this->primaryKey)) {
            foreach ($this->primaryKey as $pk) {
                $query->where($pk, '=', $this->original[$pk]);
            }
            return $query;
        } else {
            return parent::setKeysForSaveQuery($query);
        }

    }
}