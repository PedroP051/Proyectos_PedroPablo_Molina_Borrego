<?php
session_start(); // Iniciar la sesión
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="icon" href="./assets/imagenes/libros.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="./assets/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
main {
    margin-bottom: 109px;
    text-align: center;
}
img {
    width: 250px;
}
</style>

<?php

require_once("./src/connect_bdd/conxion_bdd.php");

try {
    $sql = "SELECT titulo, autor, ano_publicacion, genero FROM libro WHERE titulo = 'El quijote' LIMIT 1";
    $stmt = $pdo->query($sql);
    $libro = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p class='text-center text-danger'>Error al consultar la base de datos: " . htmlspecialchars($e->getMessage()) . "</p>";
    $libro = null;
}
?>

<body>
    <header>
        <?php include './src/plantillas/nav.php'; ?>
    </header>

    <main class="container mt-5">
        <?php if ($libro): ?>
            <h1 class="text-center mb-4">Libro del Mes</h1>
            <div class="row align-items-center">
                <div class="col-md-6 text-md-start text-center">
                    <h2 class="fw-bold"><?= htmlspecialchars($libro['titulo']); ?></h2>
                    <br>
                    <img src="./assets/imagenes/signo-de-interrogacion1.png" alt="Imagen del libro">
                </div>

                <div class="col-md-6 text-md-end text-center">
                    <p class="lead">
                        Escrito por <strong><?= htmlspecialchars($libro['autor']); ?></strong> en el año
                        <?= htmlspecialchars($libro['ano_publicacion']); ?>, este libro pertenece al género
                        <strong><?= htmlspecialchars($libro['genero']); ?></strong>.
                       Sigue las aventuras de un caballero que, enloquecido por los libros de caballería, emprende un viaje para restaurar la justicia, acompañado de su fiel escudero Sancho Panza. Es considerada la primera novela moderna y una de las mejores obras de la literatura universal.
                    </p>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center text-danger">No se encontró información del libro del mes.</p>
        <?php endif; ?>
    </main>
</body>

<?php include './src/plantillas/footer.php'; ?>

</html>
