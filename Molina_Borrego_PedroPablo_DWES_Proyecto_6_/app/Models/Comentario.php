<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'contenido',
        'fecha_publicacion',
        'autor',
        'articulo_id'
    ];

    public function articulo() {
    return $this->belongsTo(Articulo::class);
}

}

