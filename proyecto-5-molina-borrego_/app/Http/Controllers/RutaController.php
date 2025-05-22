<?php

namespace App\Http\Controllers;

class RutaController extends Controller
{
    public function saludo()
    {
        return '¡Hola!';
    }

    private $juegos = [
        1 => 'Super Mario Bros',
        2 => 'The Legend of Zelda',
        3 => 'Minecraft',
        4 => 'Fortnite',
        5 => 'Call of Duty',
    ];

    public function mostrarJuegos()
    {
        return view('juegos', ['juegos' => $this->juegos]);
    }

    public function mostrarJuegoID($id)
    {
        if (array_key_exists($id, $this->juegos)) {
            $juego = $this->juegos[$id];
            return view('juego', ['juego' => $juego, 'id' => $id]);
        } else {
            return view('juego', ['juego' => null, 'id' => $id]);
        }
    }
}
