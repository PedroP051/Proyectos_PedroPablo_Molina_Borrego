@extends('layout')

@section('title', 'Borrado Exitoso')

@section('content')
    <h1 class="text-center text-success">¡Videojuego eliminado exitosamente!</h1>
    <p class="text-center">El videojuego <strong>{{ $nombre }}</strong> ha sido eliminado de la base de datos.</p>
    <div class="text-center mt-3">
        <a href="{{ route('ver') }}" class="btn btn-primary">Volver a Ver Juegos</a>
    </div>
@endsection
