<?php
session_start();  // Asegúrate de que la sesión se haya iniciado

require_once("../connect_bdd/conxion_bdd.php");

// Verificar si el usuario ha iniciado sesión y obtener el tipo de usuario
$usuario_autenticado = $_SESSION['id_usuario'] ?? null;
$tipo_usuario = $_SESSION['tipo_usuario'] ?? '';  // Si no está en la sesión, se asigna un valor vacío

// Manejo de búsquedas recientes con cookies específicas para cada usuario
$busqueda = $_GET['busqueda'] ?? '';
$cookie_name = "busquedas_recientes_" . $usuario_autenticado;
$busquedas_recientes = isset($_COOKIE[$cookie_name]) ? json_decode($_COOKIE[$cookie_name], true) : [];

if (!empty($busqueda)) {
    array_unshift($busquedas_recientes, $busqueda);
    $busquedas_recientes = array_unique($busquedas_recientes);
    $busquedas_recientes = array_slice($busquedas_recientes, 0, 5);
    setcookie($cookie_name, json_encode($busquedas_recientes), time() + 86400, "/");
}

// Obtener libros de la base de datos
$query = "SELECT * FROM libro WHERE titulo LIKE :busqueda";
$stmt = $pdo->prepare($query);
$stmt->execute(['busqueda' => "%$busqueda%"]);
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

$mensajes = [];

// Obtener libros prestados por el usuario
function obtenerLibrosPrestados($pdo, $usuario_autenticado) {
    $query = "SELECT id_libro FROM prestamos WHERE id_usuario = :id_usuario AND fecha_devolucion IS NULL";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id_usuario' => $usuario_autenticado]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

$libros_prestados = obtenerLibrosPrestados($pdo, $usuario_autenticado);

// Verificar si el libro está reservado para una fecha específica
function verificarReserva($pdo, $id_libro) {
    $query = "SELECT COUNT(*) FROM reservas WHERE id_libro = :id_libro AND fecha_reserva >= CURDATE()";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id_libro' => $id_libro]);
    return $stmt->fetchColumn();
}

// Manejo de préstamos y devoluciones
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_libro'])) {
    $id_libro = $_POST['id_libro'];
    if (isset($_POST['prestar'])) {
        if ($usuario_autenticado) {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM prestamos WHERE id_usuario = :id_usuario AND fecha_devolucion IS NULL");
            $stmt->execute(['id_usuario' => $usuario_autenticado]);
            $total_prestamos = $stmt->fetchColumn();

            if ($total_prestamos < 5) {
                $reservas = verificarReserva($pdo, $id_libro);
                if ($reservas == 0) {
                    $stmt = $pdo->prepare("INSERT INTO prestamos (id_usuario, id_libro, fecha_prestamo) VALUES (:id_usuario, :id_libro, NOW())");
                    if ($stmt->execute(['id_usuario' => $usuario_autenticado, 'id_libro' => $id_libro])) {
                        $stmt = $pdo->prepare("UPDATE libro SET stock = stock - 1 WHERE id_libro = :id_libro");
                        $stmt->execute(['id_libro' => $id_libro]);
                        header("Location: ".$_SERVER['PHP_SELF']."?busqueda=".$busqueda);
                        exit;
                    }
                } else {
                    $mensajes[$id_libro] = "<span class='text-danger'>El libro está completamente reservado para esta fecha.</span>";
                }
            } else {
                $mensajes[$id_libro] = "<span class='text-danger'>Límite de préstamos alcanzado.</span>";
            }
        } else {
            $mensajes[$id_libro] = "<span class='text-danger'>Debe iniciar sesión.</span>";
        }
    } elseif (isset($_POST['devolver']) && in_array($id_libro, $libros_prestados)) {
        $stmt = $pdo->prepare("UPDATE prestamos SET fecha_devolucion = NOW() WHERE id_usuario = :id_usuario AND id_libro = :id_libro AND fecha_devolucion IS NULL LIMIT 1");
        if ($stmt->execute(['id_usuario' => $usuario_autenticado, 'id_libro' => $id_libro])) {
            $stmt = $pdo->prepare("UPDATE libro SET stock = stock + 1 WHERE id_libro = :id_libro");
            $stmt->execute(['id_libro' => $id_libro]);
            header("Location: ".$_SERVER['PHP_SELF']."?busqueda=".$busqueda);
            exit;
        }
    }
}

$libros_prestados = obtenerLibrosPrestados($pdo, $usuario_autenticado);

// Verificar si el usuario es bibliotecario
$es_bibliotecario = $tipo_usuario === 'bibliotecario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../../assets/imagenes/libros.png" type="image/x-icon">
</head>
<body>
<?php include '../plantillas/nav_catalogo.php'; ?>
<div class="container my-5">
    <h1 class="text-center mb-5">Buscar Libros</h1>

   
    <form method="GET" action="" class="d-flex mb-4">
        <input type="text" name="busqueda" class="form-control" placeholder="Buscar libros..." value="<?= htmlspecialchars($busqueda) ?>" />
        <button type="submit" class="btn btn-primary ms-2">Buscar</button>
    </form>


    <h3>Búsquedas Recientes</h3>
    <ul>
        <?php foreach ($busquedas_recientes as $busqueda_reciente): ?>
            <li><a href="?busqueda=<?= urlencode($busqueda_reciente) ?>"><?= htmlspecialchars($busqueda_reciente) ?></a></li>
        <?php endforeach; ?>
    </ul>
    
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Stock</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?= htmlspecialchars($libro['id_libro']) ?></td>
                    <td><?= htmlspecialchars($libro['titulo']) ?></td>
                    <td><?= htmlspecialchars($libro['autor']) ?></td>
                    <td><?= htmlspecialchars($libro['stock']) ?></td>
                    <td>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="id_libro" value="<?= $libro['id_libro'] ?>">
                            <?php if ($libro['stock'] > 0 && !in_array($libro['id_libro'], $libros_prestados)): ?>
                                <button type="submit" name="prestar" class="btn btn-primary">Prestar</button>
                            <?php endif; ?>
                            <?php if (in_array($libro['id_libro'], $libros_prestados)): ?>
                                <button type="submit" name="devolver" class="btn btn-danger">Devolver</button>
                            <?php endif; ?>
                            <?= $mensajes[$libro['id_libro']] ?? '' ?>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($es_bibliotecario): ?>
        <div class="my-4">
            <h4>Funcionalidades del administrador:</h4>
            <a href="./admin_libros.php" class="btn btn-primary">Gestionar catálogo de libros</a>
            <a href="./admin_prestamos.php" class="btn btn-secondary">Gestionar préstamos</a>
            <a href="./admin_estadisticas.php" class="btn btn-success">Generar estadísticas e informes</a>
        </div>
    <?php endif; ?>
</div>
<?php include '../plantillas/footer_catalogo.php'; ?>
</body>
</html>
