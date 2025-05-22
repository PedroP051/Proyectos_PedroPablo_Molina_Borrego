<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layout')

@section('title', 'Panel de Administrador')

@section('content')
<div class="container my-5">

    <h1 class="text-center mb-5 text-primary">🎮 Panel de Administrador</h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-controller fs-1 text-success"></i>
                    <h5 class="card-title mt-3">Gestión de Videojuegos</h5>
                    <p class="card-text">Añade, edita o elimina videojuegos del catálogo.</p>
                    <a href="{{ route('ver') }}" class="btn btn-outline-success">Ir</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-tags fs-1 text-warning"></i>
                    <h5 class="card-title mt-3">Gestión de Géneros</h5>
                    <p class="card-text">Organiza los géneros de los videojuegos fácilmente.</p>
                    <a href="{{ route('generos') }}" class="btn btn-outline-warning">Ir</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-graph-up-arrow fs-1 text-primary"></i>
                    <h5 class="card-title mt-3">Estadísticas</h5>
                    <p class="card-text">Consulta los datos y uso del sistema.</p>
                    <a href="#" class="btn btn-outline-primary disabled">Próximamente</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection