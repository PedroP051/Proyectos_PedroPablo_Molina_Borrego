<?php
$usuario_logueado = isset($_SESSION['id_usuario']); // Comprobar si el usuario está logueado

$menu_items = [
    '../perfil_usuario/perfil.php' => 'Perfil',
    '../busqueda_libros/busqueda.php' => 'Catalogo Y Prestamos',
];
?>

<style>
    .btn-warning:hover {
        background-color: white !important;
        color: black !important;
    }

    li {
        margin-right: 40px;
        margin-left: 40px;
    }

    body {
        font-size: 18px;
        
    }
</style>

<div class="bd-example">
    <div class="container-fluid bg-primary text-white p-1 d-flex align-items-center justify-content-between">
        <div class="d-flex flex-row align-items-center">
        <a href="../../index.php"><img src="../../assets/imagenes/logo2.JPG" alt="Logo Imagen" class="ms-3 rounded-circle" style="width: 120px;"></a>
        </div>

        <ul class="nav col-md-0">
            <?php foreach ($menu_items as $link => $text): ?>
                <li class="nav-item"><a href="<?= $link ?>" class="nav-link px-2 text-light"><?= $text ?></a></li>
            <?php endforeach; ?>
        </ul>
              
        <div class="d-flex">
            <?php if ($usuario_logueado): ?>
                <span class="btn btn-outline-light me-2"><?= htmlspecialchars($_SESSION['usuario']); ?></span>
                <a class="btn btn-warning text-dark me-2" href="../plantillas/cerrar_sesion.php">Cerrar Sesión</a>
            <?php else: ?>
                <a class="btn btn-outline-light me-2" href="../registro/iniciar_sesion.php">Iniciar Sesión</a>
                <a class="btn btn-warning text-dark me-2" href="../registro/registro.php">Registrarme</a>
            <?php endif; ?>
        </div>
    </div>
</div>
