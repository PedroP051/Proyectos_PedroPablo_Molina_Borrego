<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@extends('layout')

@section('title', 'Sobre Nosotros')

@section('content')
<div class="container my-5">

    <h1 class="text-center text-primary mb-5">🙋 Sobre Nosotros</h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    Información Personal
                </div>
                <div class="card-body">
                    <p><i class="bi bi-person-fill"></i> <strong>Nombre:</strong> {{ $tarea['nombre'] }}</p>
                    <p><strong>Apellido 1:</strong> {{ $tarea['apellido1'] }}</p>
                    <p><strong>Apellido 2:</strong> {{ $tarea['apellido2'] }}</p>
                    <p><i class="bi bi-envelope-fill"></i> <strong>Correo:</strong> {{ $tarea['correo'] }}</p>
                    <p><i class="bi bi-telephone-fill"></i> <strong>Teléfono:</strong> {{ $tarea['telefono'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-bold">
                    Nuestro Proyecto
                </div>
                <div class="card-body">
                    <p><strong>Nombre del Proyecto:</strong> {{ $tarea['proyecto'] }}</p>
                    <p><strong>Descripción:</strong> {{ $tarea['descripcion'] }}</p>
                    <p><strong>Objetivo:</strong> {{ $tarea['objetivo'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('inicio') }}" class="btn btn-outline-primary px-4 py-2">
            <i class="bi bi-arrow-left-circle"></i> Volver al Inicio
        </a>
    </div>
</div>
@endsection