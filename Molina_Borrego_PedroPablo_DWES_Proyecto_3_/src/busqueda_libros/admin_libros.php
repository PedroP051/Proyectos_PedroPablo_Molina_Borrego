<?php
session_start();  // Asegúrate de que la sesión se haya iniciado

require_once("../connect_bdd/conxion_bdd.php");

// Verificar si el usuario ha iniciado sesión y obtener el tipo de usuario
$usuario_autenticado = $_SESSION['id_usuario'] ?? null;
$tipo_usuario = $_SESSION['tipo_usuario'] ?? '';  // Si no está en la sesión, se asigna un valor vacío

// Si no está autenticado, redirige a la página de inicio de sesión
if (!$usuario_autenticado) {
    header("Location: ../iniciar_sesion.php");
    exit;
}

// Verificar si el usuario es bibliotecario
$es_bibliotecario = $tipo_usuario === 'bibliotecario';

// Manejo de la gestión de libros
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    // Sanear entradas
    $titulo = htmlspecialchars(trim($_POST['titulo'] ?? ''));
    $autor = htmlspecialchars(trim($_POST['autor'] ?? ''));
    $ano_publicacion = (int)($_POST['ano_publicacion'] ?? 0);
    $genero = htmlspecialchars(trim($_POST['genero'] ?? ''));
    $stock = (int)($_POST['stock'] ?? 0);
    $id_libro = (int)($_POST['id_libro'] ?? 0);

    // Agregar libro
    if ($accion === 'agregar' && $titulo && $autor && $ano_publicacion && $genero && $stock > 0) {
        $stmt = $pdo->prepare("INSERT INTO libro (titulo, autor, ano_publicacion, genero, stock) VALUES (:titulo, :autor, :ano_publicacion, :genero, :stock)");
        $stmt->execute([
            'titulo' => $titulo,
            'autor' => $autor,
            'ano_publicacion' => $ano_publicacion,
            'genero' => $genero,
            'stock' => $stock
        ]);
        // Redirigir para evitar reenvío del formulario
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Eliminar libro
    if ($accion === 'eliminar' && $id_libro) {
        $stmt = $pdo->prepare("DELETE FROM libro WHERE id_libro = :id_libro");
        $stmt->execute(['id_libro' => $id_libro]);
        // Redirigir después de la acción
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Modificar libro
    if ($accion === 'modificar' && $id_libro && $titulo && $autor && $ano_publicacion && $genero && $stock > 0) {
        $stmt = $pdo->prepare("UPDATE libro SET titulo = :titulo, autor = :autor, ano_publicacion = :ano_publicacion, genero = :genero, stock = :stock WHERE id_libro = :id_libro");
        $stmt->execute([
            'titulo' => $titulo,
            'autor' => $autor,
            'ano_publicacion' => $ano_publicacion,
            'genero' => $genero,
            'stock' => $stock,
            'id_libro' => $id_libro
        ]);
        // Redirigir después de la acción
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Obtener libros de la base de datos
$query = "SELECT * FROM libro";
$stmt = $pdo->prepare($query);
$stmt->execute();
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Cargar datos del libro si se va a modificar
$libro_a_modificar = null;
if (isset($_GET['id_libro'])) {
    $id_libro = (int)$_GET['id_libro'];
    $stmt = $pdo->prepare("SELECT * FROM libro WHERE id_libro = :id_libro");
    $stmt->execute(['id_libro' => $id_libro]);
    $libro_a_modificar = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Catálogo de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../plantillas/nav_catalogo.php'; ?>

<div class="container my-5">
    <h1 class="text-center mb-4">Gestión del Catálogo de Libros</h1>
    
    <?php if ($es_bibliotecario): ?>
        <h4><?= $libro_a_modificar ? 'Modificar Libro' : 'Agregar Nuevo Libro' ?></h4>
        <form method="POST" class="mb-4">
            <input type="hidden" name="accion" value="<?= $libro_a_modificar ? 'modificar' : 'agregar' ?>">
            <input type="hidden" name="id_libro" value="<?= $libro_a_modificar['id_libro'] ?? '' ?>">
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" value="<?= $libro_a_modificar['titulo'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" value="<?= $libro_a_modificar['autor'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="ano_publicacion" class="form-label">Año de Publicación</label>
                <input type="number" name="ano_publicacion" class="form-control" value="<?= $libro_a_modificar['ano_publicacion'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <input type="text" name="genero" class="form-control" value="<?= $libro_a_modificar['genero'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="<?= $libro_a_modificar['stock'] ?? '' ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><?= $libro_a_modificar ? 'Modificar Libro' : 'Agregar Libro' ?></button>
        </form>
    <?php endif; ?>

 
    <h4>Libros Disponibles</h4>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Año</th>
                <th>Género</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?= htmlspecialchars($libro['id_libro']) ?></td>
                    <td><?= htmlspecialchars($libro['titulo']) ?></td>
                    <td><?= htmlspecialchars($libro['autor']) ?></td>
                    <td><?= htmlspecialchars($libro['ano_publicacion']) ?></td>
                    <td><?= htmlspecialchars($libro['genero']) ?></td>
                    <td><?= htmlspecialchars($libro['stock']) ?></td>
                    <td>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id_libro" value="<?= $libro['id_libro'] ?>">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        <a href="?id_libro=<?= $libro['id_libro'] ?>" class="btn btn-warning">Modificar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../plantillas/footer_catalogo.php'; ?>
</body>
</html>
