<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@extends('layout')

@section('title', 'Géneros de Videojuegos')

@section('content')
<div class="container my-5">

    <h1 class="text-center mb-5">🎮 Géneros de Videojuegos</h1>

    <div class="row mb-5">
        <div class="col">
            <h2 class="mb-4 text-primary">🎭 Videojuegos por Género</h2>

            @forelse($generos as $genero)
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{ $genero->nombre }}
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($genero->videojuegos as $videojuego)
                    <li class="list-group-item">{{ $videojuego->nombre }}</li>
                    @empty
                    <li class="list-group-item text-muted">Sin videojuegos asociados</li>
                    @endforelse
                </ul>
            </div>
            @empty
            <div class="alert alert-warning">No hay géneros disponibles.</div>
            @endforelse
        </div>
    </div>

    <hr>

    <div class="row mt-5">
        <div class="col">
            <h2 class="mb-4 text-success">🕹️ Géneros por Videojuego</h2>

            @forelse($videojuegos as $videojuego)
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-success text-white">
                    {{ $videojuego->nombre }}
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($videojuego->generos as $genero)
                    <li class="list-group-item">{{ $genero->nombre }}</li>
                    @empty
                    <li class="list-group-item text-muted">Sin géneros asociados</li>
                    @endforelse
                </ul>
            </div>
            @empty
            <div class="alert alert-warning">No hay videojuegos disponibles.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection