<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function index()
    {
        return response()->json(Articulo::all());
    }

    public function show($id)
    {
        return response()->json(Articulo::findOrFail($id));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'autor' => 'required|string|max:255',
        ]);

        $articulo = Articulo::create($validated);

        return response()->json($articulo, 201)
            ->header('Location', url('/articulos/' . $articulo->id));
    }


    public function update(Request $request, $id)
    {
        $articulo = Articulo::findOrFail($id);
        $articulo->update($request->all());
        return response()->json($articulo);
    }

    public function destroy($id)
    {
        Articulo::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
