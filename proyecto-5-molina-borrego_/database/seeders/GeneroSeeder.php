<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('generos')->insert([
            [
                'nombre' => 'Acción',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Aventura',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Rol',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Estrategia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Deportes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}