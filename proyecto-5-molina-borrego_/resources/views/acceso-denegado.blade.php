@extends('layout')

@section('content')
<div class="alert alert-danger mt-4">
    <h3>Acceso Denegado</h3>
    @if ($motivo === 'no-autenticado')
    <p>No has iniciado sesión. Por favor, <a href="{{ route('login') }}">inicia sesión</a> para continuar.</p>
    @elseif ($motivo === 'sin-permisos')
    <p>No tienes permisos de administrador para acceder a esta funcionalidad.</p>
    @else
    <p>Acceso denegado.</p>
    @endif
</div>
@endsection