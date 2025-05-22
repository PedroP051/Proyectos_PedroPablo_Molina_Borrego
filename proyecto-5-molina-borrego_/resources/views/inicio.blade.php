@extends('layout')

@section('title', 'Inicio')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body text-center py-5">
            <h1 class="display-4 mb-3">🎮 Bienvenido a Nuestra Base</h1>
            <p class="lead mb-4">Explora y gestiona nuestra base de datos de videojuegos.<br>Hecho por: Pedro Pablo Molina Borrego</p>

            <a href="{{ route('ver') }}" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
                🔍 Ver Videojuegos
            </a>

            <a href="{{ route('añadir') }}" class="btn btn-success btn-lg px-4 py-2 ms-3 rounded-pill shadow-sm">
                ➕ Añadir Nuevo
            </a>
        </div>
    </div>
</div>
@endsection