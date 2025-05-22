@extends('layout')

@section('title', 'Editar Videojuego')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Editar Videojuego</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('editar.videojuego.confirmado', $videojuego->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Videojuego</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $videojuego->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="desarrollador" class="form-label">Desarrollador</label>
            <input type="text" class="form-control" id="desarrollador" name="desarrollador" value="{{ old('desarrollador', $videojuego->desarrollador) }}" required>
        </div>

        <div class="mb-3">
            <label for="año_lanzamiento" class="form-label">Año de Lanzamiento</label>
            <input type="number" class="form-control" id="año_lanzamiento" name="año_lanzamiento" value="{{ old('año_lanzamiento', $videojuego->año_lanzamiento) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Géneros</label><br>
            @foreach($generos as $genero)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox"
                    name="generos[]"
                    value="{{ $genero->id }}"
                    {{ $videojuego->generos->contains($genero->id) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $genero->nombre }}</label>
            </div>
            @endforeach
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Actualizar Videojuego</button>
        </div>
    </form>
</div>
@endsection