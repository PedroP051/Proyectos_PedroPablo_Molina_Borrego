<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Http\Request;
use App\Models\Genero;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CRUDController extends Controller
{
    public function index()
    {

        $videojuegos = Videojuego::all();

        return view('editar', compact('videojuegos'));
    }


    public function editar($id)
    {
        $videojuego = Videojuego::with('generos')->findOrFail($id);
        $generos = Genero::all();
        return view('formulario_editar', compact('videojuego', 'generos'));
    }

    public function valorar(Request $request, $id)
    {
        $request->validate([
            'valoracion' => 'required|integer|min:0|max:5',
        ]);
    
        $videojuego = Videojuego::findOrFail($id);
        $videojuego->valoracion = $request->valoracion;
        $videojuego->save();
    
        return back()->with('success', '¡Gracias por tu valoración!');
    }
    

    public function actualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'desarrollador' => 'required|string|max:50',
            'año_lanzamiento' => 'required|integer|digits:4|max:' . Carbon::now()->year,
            'generos' => 'required|array|min:1',
            'generos.*' => 'exists:generos,id',
        ], [
            'año_lanzamiento.max' => 'El año de lanzamiento no puede superar el año actual.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
            'desarrollador.max' => 'El desarrollador no puede tener más de 50 caracteres.',
            'generos.required' => 'Debes seleccionar al menos un género.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $videojuego = Videojuego::findOrFail($id);
        $videojuego->update([
            'nombre' => $request->nombre,
            'desarrollador' => $request->desarrollador,
            'año_lanzamiento' => $request->año_lanzamiento,
        ]);

        $videojuego->generos()->sync($request->generos);

        return redirect()->route('ver')->with('success', 'Videojuego editado exitosamente.');
    }

    public function seleccionarBorrar()
    {
        if (!Auth::check()) {
            return view('acceso-denegado', ['motivo' => 'no-autenticado']);
        }

        $usuario = Auth::user();

        if ($usuario->rol !== 'administrador') {
            return view('acceso-denegado', ['motivo' => 'sin-permisos']);
        }


        $videojuegos = \App\Models\Videojuego::all();
        return view('borrar', compact('videojuegos'));
    }

    public function borrar(Request $request)
    {
        $request->validate([
            'videojuego_id' => 'required|exists:videojuegos,id',
        ]);

        $videojuego = Videojuego::findOrFail($request->videojuego_id);
        $videojuego->delete();

        return view('borrado_exitoso', ['nombre' => $videojuego->nombre]);
    }
}
