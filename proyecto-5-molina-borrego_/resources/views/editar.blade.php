<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

@extends('layout')

@section('title', 'Editar Videojuego')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0">
                <div class="card-header bg-warning text-dark text-center fs-4">
                    ✏️ Selecciona un Videojuego para Editar
                </div>

                <div class="card-body">

                    @if($videojuegos->isEmpty())
                    <div class="alert alert-warning text-center">
                        No hay videojuegos disponibles para editar.
                    </div>
                    @else
                    <form id="editarForm" method="GET">
                        <div class="mb-4">
                            <label for="videojuego_id" class="form-label">🎮 Videojuego</label>
                            <select id="videojuego_id" class="form-select" required>
                                <option disabled selected value="">Selecciona un videojuego</option>
                                @foreach($videojuegos as $videojuego)
                                <option value="{{ $videojuego->id }}">{{ $videojuego->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar videojuego
                            </button>
                        </div>
                    </form>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('editarForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const select = document.getElementById('videojuego_id');
        const id = select.value;
        if (id) {
            const ruta = "{{ url('editar-videojuego') }}/" + id;
            window.location.href = ruta;
        }
    });
</script>
@endsection
