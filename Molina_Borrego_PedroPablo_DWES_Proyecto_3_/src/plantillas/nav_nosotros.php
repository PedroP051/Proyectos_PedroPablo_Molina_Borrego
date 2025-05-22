
<?php

$current_page = basename($_SERVER['PHP_SELF']);
$subdirectory = basename(dirname($_SERVER['REQUEST_URI']));

if ($subdirectory === 'plantillas') {
    $menu_items = [
        '../registro/iniciar_sesion.php' => 'Perfil',
        '../busqueda_libros/busqueda.php' => 'Catalogo Y Prestamos',
    ];
} else {
    $menu_items = [
        './src/perfil_usuario/perfil.php' => 'Perfil',
        './src/busqueda_libros/busqueda.php' => 'Catalogo Y Prestamos',
    ];
}
?>

<style>
    .btn-warning:hover {
        background-color: white !important;
        color: black !important;
    }

    #titulo {
        text-decoration: underline;
    }

    li {
        margin-right: 40px;
        margin-left: 40px;
    }

    body {
        font-size: 18px;
    }
    a{
    padding: 30px;
    }
    
</style>

<div class="bd-example">
    <div class="container-fluid bg-primary text-white p-1 d-flex align-items-center justify-content-between">
        <div class="d-flex flex-row align-items-center">
        <img href="../../index.php" src="../../assets/imagenes/logo2.JPG" alt="" class="ms-3 rounded-circle" style="width: 120px;">
        </div>

        <ul class="nav col-md-0">
            <?php foreach ($menu_items as $link => $text): ?>
                <li class="nav-item"><a href="<?= $link ?>" class="nav-link px-2 text-light"><?= $text ?></a></li>
            <?php endforeach; ?>
        </ul>

        <div class="d-flex">
            <a class="btn btn-outline-light me-2" href="../registro/iniciar_sesion.php">Iniciar Sesión</a>
            <a class="btn btn-warning text-dark me-2" href="../registro/registro.php">Registrarme</a>
        </div>
    </div>
</div>
