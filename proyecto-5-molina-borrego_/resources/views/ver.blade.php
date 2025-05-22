@extends('layout')

@section('title', 'Ver Videojuegos')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">🎮 Lista de Videojuegos</h2>
    </div>

    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" action="{{ route('ver') }}" class="row g-3 mb-4">
        <div class="col-md-5">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre..." value="{{ request('buscar') }}">
        </div>
        <div class="col-md-4">
            <select name="genero" class="form-select">
                <option value="">Todos los géneros</option>
                @foreach($generos as $genero)
                <option value="{{ $genero->id }}" {{ request('genero') == $genero->id ? 'selected' : '' }}>
                    {{ $genero->nombre }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 text-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar 🔍</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Desarrollador</th>
                        <th scope="col">Año</th>
                        <th scope="col">Valoración</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($videojuegos as $videojuego)
                    <tr>
                        <td>{{ $videojuego->nombre }}</td>
                        <td>{{ $videojuego->desarrollador }}</td>
                        <td>{{ $videojuego->año_lanzamiento }}</td>
                        <td>
                            <form action="{{ route('videojuego.valorar', $videojuego->id) }}" method="POST">
                                @csrf
                                <div class="d-flex align-items-center gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="submit" name="valoracion" value="{{ $i }}" class="btn btn-sm p-0 border-0 bg-transparent">
                                            <i class="fas fa-star {{ $videojuego->valoracion >= $i ? 'text-warning' : 'text-secondary' }}"></i>
                                        </button>
                                    @endfor
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No hay videojuegos disponibles.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $videojuegos->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
