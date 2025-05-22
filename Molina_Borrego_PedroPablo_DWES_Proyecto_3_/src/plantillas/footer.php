
<?php

$current_page = basename($_SERVER['PHP_SELF']);
$subdirectory = basename(dirname($_SERVER['REQUEST_URI']));

if ($subdirectory === 'busqueda_libros') {
    $menu_items = [
        '../../index.php' => 'Inicio',
        './busqueda.php' => 'Preguntas',
        './busqueda.php' => 'Sobre Nosotros',
    ];
} else {
    $menu_items = [
        './src/perfil_usuario/perfil.php' => 'Perfil',
        './src/busqueda_libros/busqueda.php' => 'Catalogo Y Prestamos',
    ];
}
?>

<style>
.nav-link {
            text-decoration: none; 
            color: #f8f9fa; 
            position: relative; 
        }

       
        .nav-link:hover::after {
            content: ""; 
            position: absolute;
            left: 0;
            bottom: -2px; 
            width: 100%;
            height: 2px; 
            background-color: #f8f9fa; 
            transition: width 0.3s ease-in-out;
        }

        
        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px; 
            width: 0;
            height: 2px;
            background-color: #f8f9fa;
            transition: width 0.3s ease-in-out;
        }
    </style>

<footer class="d-flex flex-wrap bg-primary justify-content-between align-items-center py-3  border-top">
    <p class="col-md-4 mb-0 text-light">© 2025 Pixel Library, Inc</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="./index.php" class="nav-link px-2 text-light">Inicio</a></li>
      <li class="nav-item"><a href="./src/plantillas/preguntas_nosotros.php" class="nav-link px-2 text-light">Preguntas</a></li>
      <li class="nav-item"><a href="./src/plantillas/sobre_nosotros.php" class="nav-link px-2 text-light">Sobre Nosotros</a></li>
    </ul>
    
  </footer>

  