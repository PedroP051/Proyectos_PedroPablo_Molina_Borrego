<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videojuego;
use App\Models\Genero;

class EloquentController extends Controller
{
    public function generos()
    {
        $generos = Genero::with('videojuegos')->get();
        $videojuegos = Videojuego::with('generos')->get();

        return view('generos', compact('generos', 'videojuegos'));
    }
}
