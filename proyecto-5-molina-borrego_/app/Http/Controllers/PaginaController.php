<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function inicio()
    {
        return view('inicio');
    }

    public function sobreNosotros()
    {
        $tarea = [
            'nombre' => 'Pedro Pablo',
            'apellido1' => 'Molina',
            'apellido2' => 'Borrego',
            'correo' => 'ejemplo042@g.educaand.es',
            'telefono' => '+34 123 456 789',
            'proyecto' => 'GameForge',
            'descripcion' => 'Este proyecto tiene como objetivo desarrollar una aplicación web de videojuegos con Laravel, incluyendo gestión de usuarios, base de datos y autenticación.',
            'objetivo' => 'Crear una plataforma interactiva donde los jugadores puedan explorar juegos, compartir experiencias y acceder a estadísticas sobre su desempeño.',
        ];

        return view('sobre-nosotros', compact('tarea'));
    }
}
