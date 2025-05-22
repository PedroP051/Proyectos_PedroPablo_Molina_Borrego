<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@extends('layout')

@section('title', 'Borrar Videojuego')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0">
                <div class="card-header bg-danger text-white text-center fs-4">
                    🗑️ Selecciona un Videojuego para Borrar
                </div>

                <div class="card-body">

                    @if($videojuegos->isEmpty())
                    <div class="alert alert-warning text-center">
                        No hay videojuegos disponibles para borrar.
                    </div>
                    @else
                    <form action="{{ route('borrar.confirmado') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="mb-4">
                            <label for="videojuego_id" class="form-label">🎮 Videojuego</label>
                            <select name="videojuego_id" class="form-select" required>
                                <option disabled selected value="">Selecciona un videojuego</option>
                                @foreach($videojuegos as $videojuego)
                                <option value="{{ $videojuego->id }}">{{ $videojuego->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash-fill"></i> Borrar definitivamente
                            </button>
                        </div>
                    </form>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection