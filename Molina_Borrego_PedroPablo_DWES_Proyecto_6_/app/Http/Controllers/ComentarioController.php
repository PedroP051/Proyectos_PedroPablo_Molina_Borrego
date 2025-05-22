<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Articulo;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index()
    {
        return response()->json(Comentario::all());
    }

    public function show($id)
    {
        return response()->json(Comentario::findOrFail($id));
    }

    public function comentariosPorArticulo($id)
    {
        $comentarios = Comentario::where('articulo_id', $id)->get();

        return response()->json($comentarios);
    }



    public function store(Request $request, $articuloId)
    {
        $validated = $request->validate([
            'contenido' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'autor' => 'required|string|max:255',
        ]);

        $comentario = Comentario::create([
            'articulo_id' => $articuloId,
            'contenido' => $validated['contenido'],
            'fecha_publicacion' => $validated['fecha_publicacion'],
            'autor' => $validated['autor'],
        ]);

        return response()->json($comentario, 201)
            ->header('Location', url('/comentarios/' . $comentario->id));
    }




    public function update(Request $request, $comentario)
    {
        $comentario = Comentario::findOrFail($comentario);

        $request->validate([
            'contenido' => 'required|string',
        ]);

        $comentario->contenido = $request->contenido;
        $comentario->save();

        return response()->json($comentario, 200);
    }

    public function destroy($id)
    {
        Comentario::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
