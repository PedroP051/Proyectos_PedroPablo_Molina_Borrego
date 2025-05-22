<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = [
        'titulo',
        'contenido',
        'fecha_publicacion',
        'autor'
    ];

   public function comentarios() {
    return $this->hasMany(Comentario::class);
}

}
