<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videojuego;
use App\Models\Genero;
use Carbon\Carbon;



class BBDDController extends Controller
{
    public function eliminar($id)
    {
        $videojuego = Videojuego::findOrFail($id);
        $videojuego->delete();

        return redirect()->route('ver')->with('success', 'Videojuego eliminado con éxito.');
    }
    public function mostrarEliminar()
    {
        $videojuegos = Videojuego::all();
        return view('eliminar', compact('videojuegos'));
    }

    public function eliminarConfirmado($id)
    {
        $videojuego = Videojuego::findOrFail($id);
        $videojuego->delete();
        return redirect()->route('eliminar.videojuego')->with('success', 'Videojuego eliminado correctamente');
    }



    public function ver(Request $request)
    {
        $query = Videojuego::with('generos');


        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }


        if ($request->filled('genero')) {
            $generoId = $request->genero;
            $query->whereHas('generos', function ($q) use ($generoId) {
                $q->where('genero_id', $generoId);
            });
        }

        $videojuegos = $query->paginate(10);
        $generos = Genero::all();

        return view('ver', compact('videojuegos', 'generos'));
    }


    public function verDetalle($id)
    {
        $videojuego = Videojuego::find($id);
        return view('detalle', compact('videojuego'));
    }

    public function añadir()
    {
        $generos = Genero::all();
        return view('añadir', compact('generos'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'desarrollador' => 'required|string|max:50',
            'año_lanzamiento' => 'required|integer|digits:4|max:' . Carbon::now()->year,
            'generos' => 'required|array|min:1',
            'generos.*' => 'exists:generos,id',
        ], [
            'nombre.max' => 'No mas de 100 caracteres',
            'desarrollador.max' => 'No mas de 50 caracteres',
            'año_lanzamiento.max' => 'No mas del año 2025',
            'generos.required' => 'Debes seleccionar al menos un género.',
            'generos.min' => 'Selecciona al menos un género.',
        ]);

        $videojuego = Videojuego::create([
            'nombre' => $request->nombre,
            'desarrollador' => $request->desarrollador,
            'año_lanzamiento' => $request->año_lanzamiento,
        ]);

        $videojuego->generos()->sync($request->generos);

        return redirect()->route('ver')->with('success', 'Videojuego añadido con éxito.');
    }


    public function generos()
    {
        return $this->belongsToMany(Genero::class);
    }
}
