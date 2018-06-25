<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = ['utilizador_id', 'imagem'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id')->withTimestamps();
    }


    public function post_traducoes()
    {
        return $this->hasMany(Post_Traducao::class, 'post_id');
    }
}
