<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Videojuego;
use App\Models\Genero;
use Illuminate\Support\Facades\DB;
class VideojuegoGeneroSeeder extends Seeder
{
   
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('videojuego_genero')->insert([
            ['videojuego_id' => 1, 'genero_id' => 1, 'created_at' => now(), 'updated_at' => now(),],  // The Legend of Zelda: Breath of the Wild → Acción
            ['videojuego_id' => 2, 'genero_id' => 1, 'created_at' => now(), 'updated_at' => now(),],  // God of War Ragnarok → Acción
            ['videojuego_id' => 2, 'genero_id' => 2, 'created_at' => now(), 'updated_at' => now(),],  // God of War Ragnarok → Aventura
            ['videojuego_id' => 3, 'genero_id' => 1, 'created_at' => now(), 'updated_at' => now(),],  // Elden Ring → Acción
            ['videojuego_id' => 3, 'genero_id' => 3, 'created_at' => now(), 'updated_at' => now(),],  // Elden Ring → Rol
            ['videojuego_id' => 4, 'genero_id' => 2, 'created_at' => now(), 'updated_at' => now(),],  // Minecraft → Aventura
            ['videojuego_id' => 4, 'genero_id' => 4, 'created_at' => now(), 'updated_at' => now(),],  // Minecraft → Estrategia
            ['videojuego_id' => 5, 'genero_id' => 3, 'created_at' => now(), 'updated_at' => now(),],  // The Witcher 3: Wild Hunt → Rol
            ['videojuego_id' => 5, 'genero_id' => 2, 'created_at' => now(), 'updated_at' => now(),],  // The Witcher 3: Wild Hunt → Aventura
            ['videojuego_id' => 6, 'genero_id' => 1, 'created_at' => now(), 'updated_at' => now(),],  // Red Dead Redemption 2 → Acción
            ['videojuego_id' => 6, 'genero_id' => 2, 'created_at' => now(), 'updated_at' => now(),],  // Red Dead Redemption 2 → Aventura
            ['videojuego_id' => 7, 'genero_id' => 1, 'created_at' => now(), 'updated_at' => now(),],  // Super Mario Odyssey → Acción
            ['videojuego_id' => 7, 'genero_id' => 2, 'created_at' => now(), 'updated_at' => now(),],  // Super Mario Odyssey → Aventura
            ['videojuego_id' => 8, 'genero_id' => 2, 'created_at' => now(), 'updated_at' => now(),],  // Hollow Knight → Aventura
            ['videojuego_id' => 8, 'genero_id' => 1, 'created_at' => now(), 'updated_at' => now(),],  // Hollow Knight → Acción
            ['videojuego_id' => 9, 'genero_id' => 3, 'created_at' => now(), 'updated_at' => now(),],  // Cyberpunk 2077 → Rol
            ['videojuego_id' => 9, 'genero_id' => 1, 'created_at' => now(), 'updated_at' => now(),],  // Cyberpunk 2077 → Acción
            ['videojuego_id' => 10, 'genero_id' => 3, 'created_at' => now(), 'updated_at' => now(),], // Dark Souls III → Rol
            ['videojuego_id' => 10, 'genero_id' => 1, 'created_at' => now(), 'updated_at' => now(),], // Dark Souls III → Acción
        ]);
    }
}