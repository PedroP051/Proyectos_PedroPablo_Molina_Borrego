@extends('layout')

@section('title', 'Añadir Videojuego')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-4 border-0">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h3 class="mb-0">📦 Añadir Nuevo Videojuego</h3>
        </div>

        <div class="card-body px-5 py-4">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('guardar.videojuego') }}" method="POST">
                @csrf

                {{-- Nombre del videojuego --}}
                <div class="mb-3">
                    <label for="nombre" class="form-label">🎮 Nombre del Videojuego</label>
                    <input type="text" name="nombre" class="form-control" required
                           placeholder="Ej. The Legend of Zelda" value="{{ old('nombre') }}">
                    @error('nombre')
                    <div class="alert alert-danger mt-2 rounded-3 shadow-sm">
                        ❗ {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Desarrollador --}}
                <div class="mb-3">
                    <label for="desarrollador" class="form-label">🏢 Desarrollador</label>
                    <input type="text" name="desarrollador" class="form-control" required
                           placeholder="Ej. Nintendo" value="{{ old('desarrollador') }}">
                    @error('desarrollador')
                    <div class="alert alert-danger mt-2 rounded-3 shadow-sm">
                        ❗ {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Año de lanzamiento --}}
                <div class="mb-3">
                    <label for="año_lanzamiento" class="form-label">📅 Año de Lanzamiento</label>
                    <input type="number" name="año_lanzamiento" class="form-control"
                            placeholder="Ej. 2025" value="{{ old('año_lanzamiento') }}">
                    @error('año_lanzamiento')
                    <div class="alert alert-danger mt-2 rounded-3 shadow-sm">
                        ❗ {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Géneros --}}
                <div class="mb-4">
                    <label class="form-label">📚 Géneros</label>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                        @foreach($generos as $genero)
                        <div class="form-check mb-2">
                            <input class="form-check-input"
                                type="checkbox"
                                name="generos[]"
                                value="{{ $genero->id }}"
                                id="genero_{{ $genero->id }}"
                                {{ in_array($genero->id, old('generos', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="genero_{{ $genero->id }}">{{ $genero->nombre }}</label>
                        </div>
                        @endforeach
                    </div>
                    <small class="text-muted">Selecciona uno o más géneros.</small>

                    @error('generos')
                    <div class="alert alert-danger mt-3 rounded-3 shadow-sm">
                        ❗ {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4 py-2 rounded-pill">
                        💾 Guardar Videojuego
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
