<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComentariosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('comentarios')->insert([
            [
                'articulo_id' => 1,
                'contenido' => 'Comentario sobre artículo 1',
                'autor' => 'Autor 1',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'articulo_id' => 2,
                'contenido' => 'Comentario sobre artículo 2',
                'autor' => 'Autor 2',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'articulo_id' => 3,
                'contenido' => 'Comentario sobre artículo 3',
                'autor' => 'Autor 3',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'articulo_id' => 4,
                'contenido' => 'Comentario sobre artículo 4',
                'autor' => 'Autor 4',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'articulo_id' => 5,
                'contenido' => 'Comentario sobre artículo 5',
                'autor' => 'Autor 5',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'articulo_id' => 6,
                'contenido' => 'Comentario sobre artículo 6',
                'autor' => 'Autor 6',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'articulo_id' => 7,
                'contenido' => 'Comentario sobre artículo 7',
                'autor' => 'Autor 7',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'articulo_id' => 8,
                'contenido' => 'Comentario sobre artículo 8',
                'autor' => 'Autor 8',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'articulo_id' => 9,
                'contenido' => 'Comentario sobre artículo 9',
                'autor' => 'Autor 9',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'articulo_id' => 10,
                'contenido' => 'Comentario sobre artículo 10',
                'autor' => 'Autor 10',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
