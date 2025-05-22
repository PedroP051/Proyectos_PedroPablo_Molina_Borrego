<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticulosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('articulos')->insert([
            [
                'titulo' => 'Artículo 1',
                'contenido' => 'Contenido del artículo 1',
                'autor' => 'Autor 1',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Artículo 2',
                'contenido' => 'Contenido del artículo 2',
                'autor' => 'Autor 2',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Artículo 3',
                'contenido' => 'Contenido del artículo 3',
                'autor' => 'Autor 3',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Artículo 4',
                'contenido' => 'Contenido del artículo 4',
                'autor' => 'Autor 4',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Artículo 5',
                'contenido' => 'Contenido del artículo 5',
                'autor' => 'Autor 5',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Artículo 6',
                'contenido' => 'Contenido del artículo 6',
                'autor' => 'Autor 6',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Artículo 7',
                'contenido' => 'Contenido del artículo 7',
                'autor' => 'Autor 7',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Artículo 8',
                'contenido' => 'Contenido del artículo 8',
                'autor' => 'Autor 8',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Artículo 9',
                'contenido' => 'Contenido del artículo 9',
                'autor' => 'Autor 9',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Artículo 10',
                'contenido' => 'Contenido del artículo 10',
                'autor' => 'Autor 10',
                'fecha_publicacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
