@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">{{ __('Iniciar sesión') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            <label class="form-check-label" for="remember">{{ __('Recuérdame') }}</label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">{{ __('Iniciar sesión') }}</button>
                        </div>

                        @if (Route::has('password.request'))
                        <div class="mt-3 text-center">
                            <a href="{{ route('password.request') }}" class="btn btn-link">{{ __('¿Olvidaste tu contraseña?') }}</a>
                        </div>
                        @endif
                    </form>

                    {{-- Enlace a registro --}}
                    <div class="mt-4 text-center">
                        <p class="mb-0">¿No tienes una cuenta?
                            <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-primary">
                                Regístrate aquí
                            </a> 🎉
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection