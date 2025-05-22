<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            font-family: 'Arial', sans-serif;
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        .modo-oscuro {
            background-color: #121212 !important;
            color: #e0e0e0 !important;
        }

        .modo-oscuro .navbar,
        .modo-oscuro .dropdown-menu {
            background-color: #1f1f1f !important;
        }

        .modo-oscuro .card,
        .modo-oscuro .table,
        .modo-oscuro .form-control,
        .modo-oscuro .form-select,
        .modo-oscuro .alert,
        .modo-oscuro .modal-content {
            background-color: #1e1e1e !important;
            color: #e0e0e0 !important;
            border-color: #333 !important;
        }

        .modo-oscuro .form-control::placeholder {
            color: #aaa;
        }

        .modo-oscuro .btn {
            border-color: #555;
        }

        .modo-oscuro .nav-link,
        .modo-oscuro .dropdown-item {
            color:hsl(198, 89.80%, 46.30%) !important;
            background-color:  rgba(255, 255, 255, 0.15);
        }
        .modo-oscuro .nav-link:hover{
            background-color: #333 !important;
        }
        .modo-oscuro .dropdown-item:hover {
            background-color: #333 !important;
            
        }

        .modo-oscuro .btn-outline-dark {
            color: #e0e0e0 !important;
            border-color: #888 !important;
        }

        .modo-oscuro .table thead {
            background-color: #333 !important;
        }

        .modo-oscuro .form-check-label {
            color: #ccc !important;
        }

        .btn-auth {
            background: white;
            color: #0d6efd;
            border: 2px solid #fff;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-auth:hover {
            background: rgb(7, 181, 255);
            color: #212529;
            border-color: rgb(7, 181, 255);
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .nav-link.main-link {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            transition: all 0.3s ease;
            font-weight: 500;
            margin: 0 4px;
        }

        .nav-link.main-link:hover {
            background-color: #ffffff;
            color: #0d6efd;
            text-shadow: 0 0 1px rgba(13, 110, 253, 0.4);
            transform: scale(1.05);
        }

        #modoOscuroBtn {
            transition: background-color 0.3s ease, color 0.3s ease;
            font-size: 1.6rem;
        }

        .emoji {
            display: inline-block;
            transition: transform 0.4s ease;
        }

        .emoji.cambio {
            transform: rotate(360deg);
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                <img src="{{ asset('https://media.game.es/COVERV2/3D_L/182/182977.png') }}" alt="Logo" width="50" height="50" class="rounded-circle shadow-sm">
                <span>GameForge</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link main-link" href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link main-link" href="{{ route('ver') }}">Ver</a></li>
                    <li class="nav-item"><a class="nav-link main-link" href="{{ route('añadir') }}">Añadir</a></li>
                    <li class="nav-item"><a class="nav-link main-link" href="{{ route('editar.videojuego') }}">Editar</a></li>
                    <li class="nav-item"><a class="nav-link main-link" href="{{ route('borrar.seleccionar') }}">Eliminar</a></li>
                    <li class="nav-item"><a class="nav-link main-link" href="{{ route('generos') }}">Géneros</a></li>
                    <li class="nav-item"><a class="nav-link main-link" href="{{ route('sobre.nosotros') }}">Sobre Nosotros</a></li>
                </ul>

                <ul class="navbar-nav ms-auto d-flex flex-row gap-2">
                    @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-auth px-3 rounded-pill" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->rol === 'administrador')
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tools me-2"></i>Panel de administrador
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-auth px-3 rounded-pill " href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-auth px-3 rounded-pill" href="{{ route('registrar') }}">
                            <i class="fas fa-user-plus"></i> Registrarse
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    {{-- Botón de modo oscuro --}}
    <button id="modoOscuroBtn" class="btn position-fixed bottom-0 end-0 m-4 rounded-circle shadow-sm z-3" style="background: yellow; color: black;" title="Cambiar modo">
        <span class="emoji" id="emojiIcon">🌞</span>
    </button>

    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const body = document.body;
            const btn = document.getElementById('modoOscuroBtn');
            const emoji = document.getElementById('emojiIcon');
            const modoGuardado = localStorage.getItem('modoOscuro');

            const activarModoOscuro = () => {
                body.classList.add('modo-oscuro');
                btn.style.backgroundColor = '#333';
                btn.style.color = '#fff';
                emoji.textContent = '🌜';
            };

            const desactivarModoOscuro = () => {
                body.classList.remove('modo-oscuro');
                btn.style.backgroundColor = 'yellow';
                btn.style.color = 'black';
                emoji.textContent = '🌞';
            };

            if (modoGuardado === 'activo') {
                activarModoOscuro();
            }

            btn.addEventListener('click', () => {
                emoji.classList.add('cambio');

                setTimeout(() => {
                    emoji.classList.remove('cambio');
                }, 400);

                if (body.classList.contains('modo-oscuro')) {
                    desactivarModoOscuro();
                    localStorage.setItem('modoOscuro', 'inactivo');
                } else {
                    activarModoOscuro();
                    localStorage.setItem('modoOscuro', 'activo');
                }
            });
        });
    </script>
</body>

</html>
