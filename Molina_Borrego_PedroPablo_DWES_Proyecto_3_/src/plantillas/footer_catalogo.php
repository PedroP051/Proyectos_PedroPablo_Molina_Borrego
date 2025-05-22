
<?php

$current_page = basename($_SERVER['PHP_SELF']);
$subdirectory = basename(dirname($_SERVER['REQUEST_URI']));

if ($subdirectory === 'busqueda_libros') {
    $menu_items = [
        '../../index.php' => 'Inicio',
        '../plantillas/preguntas_nosotros.php' => 'Preguntas',
        '../plantillas/sobre_nosotros.php' => 'Sobre Nosotros',
    ];
} else {
    $menu_items = [
        '../../index.php' => 'Inicio',
        '../plantillas/preguntas_nosotros.php' => 'Preguntas',
        '../plantillas/sobre_nosotros.php' => 'Sobre Nosotros',
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
     a{
        margin-bottom: 10px;
     }
    </style>

<br><br><br><br>
<footer class="d-flex flex-wrap bg-primary justify-content-between align-items-center py-3  border-top">
    <p class="col-md-4 mb-0 text-light">© 2025 Pixel Library, Inc</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>
    <ul class="nav col-md-4 justify-content-end">
    <?php foreach ($menu_items as $link => $text): ?>
        <li class="nav-item"><a href="<?= $link ?>" class="nav-link px-2 text-light"><?= $text ?></a></li>
    <?php endforeach; ?>
</ul>


    
  </footer>
