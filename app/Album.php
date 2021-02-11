<?php

namespace DavidPeixoto;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'nome', 'sobre', 'capa', 'publicar'
    ];

    public function imagems(){
        return $this->hasMany(imagem::class, 'id_album', 'id');
    }
}
