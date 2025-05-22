@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">{{ __('Registro') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="rol" class="form-label">🧑‍💼 Rol</label>
                            <select id="rol" class="form-control" name="rol" required>
                                <option value="cliente" {{ old('rol') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                                <option value="administrador" {{ old('rol') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">👤 {{ __('Nombre') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">📧 {{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">🔒 {{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">🔁 {{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-4 py-2 rounded-pill">
                                📝 {{ __('Registrar') }}
                            </button>
                        </div>
                    </form>

                    {{-- Enlace a login --}}
                    <div class="mt-4 text-center">
                        <p class="mb-0">¿Ya tienes una cuenta?
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-primary">
                                Inicia sesión aquí
                            </a> 🔑
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection