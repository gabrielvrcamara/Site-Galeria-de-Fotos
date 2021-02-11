<?php

namespace DavidPeixoto;

use Illuminate\Database\Eloquent\Model;

class imagem extends Model
{
    protected $fillable = [
        'imagem', 'album_id', 'thumbnail'
    ];

    public function albums(){
        return $this->hasOne(Album::class);
    }
}
