<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Videojuego;

class VideojuegosSeeder extends Seeder
{
    public function run(): void
    {
        $videojuegos = [
            ['nombre' => 'The Legend of Zelda: Breath of the Wild', 'desarrollador' => 'Nintendo', 'año_lanzamiento' => 2017],
            ['nombre' => 'The Witcher 3: Wild Hunt', 'desarrollador' => 'CD Projekt Red', 'año_lanzamiento' => 2015],
            ['nombre' => 'Dark Souls III', 'desarrollador' => 'FromSoftware', 'año_lanzamiento' => 2016],
            ['nombre' => 'God of War', 'desarrollador' => 'Santa Monica Studio', 'año_lanzamiento' => 2018],
            ['nombre' => 'Red Dead Redemption 2', 'desarrollador' => 'Rockstar Games', 'año_lanzamiento' => 2018],
            ['nombre' => 'Hollow Knight', 'desarrollador' => 'Team Cherry', 'año_lanzamiento' => 2017],
            ['nombre' => 'Cyberpunk 2077', 'desarrollador' => 'CD Projekt Red', 'año_lanzamiento' => 2020],
            ['nombre' => 'Minecraft', 'desarrollador' => 'Mojang', 'año_lanzamiento' => 2011],
            ['nombre' => 'Super Mario Odyssey', 'desarrollador' => 'Nintendo', 'año_lanzamiento' => 2017],
            ['nombre' => 'Elden Ring', 'desarrollador' => 'FromSoftware', 'año_lanzamiento' => 2022]
        ];        

        foreach ($videojuegos as $juego) {
            Videojuego::create($juego);
        }
    }
}
