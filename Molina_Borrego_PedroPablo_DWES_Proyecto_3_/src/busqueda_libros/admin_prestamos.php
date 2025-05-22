<?php
session_start();
require_once("../connect_bdd/conxion_bdd.php");

// Verificar si el usuario está autenticado y es bibliotecario
$usuario_autenticado = $_SESSION['id_usuario'] ?? null;

// Obtener los préstamos activos (sin filtrar por fecha de devolución, ya que ahora se deben mostrar todos)
$query = "SELECT p.id_prestamo, u.nombre AS usuario, l.titulo AS libro, p.fecha_prestamo, p.fecha_devolucion
          FROM prestamos p
          JOIN usuario u ON p.id_usuario = u.id_usuario
          JOIN libro l ON p.id_libro = l.id_libro";
$stmt = $pdo->prepare($query);
$stmt->execute();
$prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Marcar libro como devuelto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_prestamo'])) {
    $id_prestamo = $_POST['id_prestamo'];
    
    // Actualizamos el préstamo como devuelto
    $stmt = $pdo->prepare("UPDATE prestamos SET fecha_devolucion = NOW() WHERE id_prestamo = :id_prestamo");
    $stmt->execute(['id_prestamo' => $id_prestamo]);

    // Actualizamos el stock del libro
    $stmt = $pdo->prepare("UPDATE libro SET stock = stock + 1 WHERE id_libro = (SELECT id_libro FROM prestamos WHERE id_prestamo = :id_prestamo)");
    $stmt->execute(['id_prestamo' => $id_prestamo]);

    // Mensaje de confirmación
    $_SESSION['mensaje'] = "El préstamo ha sido marcado como devuelto.";
    header("Location: admin_prestamos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Préstamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../../assets/imagenes/libros.png" type="image/x-icon">
    <style>
        .table th, .table td {
            text-align: center;
        }
        .table-container {
            margin-top: 20px;
            margin-bottom: 95px;
        }
        .btn-devolver {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
        }
        .btn-devolver:hover {
            background-color: #218838;
        }
        .alert {
            margin-top: 20px;
        }
        h1{
            margin-top: 100px;
        }
    </style>
</head>
<body>
<?php include '../plantillas/nav_catalogo.php'; ?>
<div class="container">
    <h1 class="text-center mb-4">Administrar Préstamos</h1>
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['mensaje']; ?>
        </div>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <div class="table-container">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Préstamo</th>
                    <th>Usuario</th>
                    <th>Libro</th>
                    <th>Fecha de Préstamo</th>
                    <th>Fecha de Devolución</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prestamos as $prestamo): ?>
                    <tr>
                        <td><?= htmlspecialchars($prestamo['id_prestamo']) ?></td>
                        <td><?= htmlspecialchars($prestamo['usuario']) ?></td>
                        <td><?= htmlspecialchars($prestamo['libro']) ?></td>
                        <td><?= htmlspecialchars($prestamo['fecha_prestamo']) ?></td>
                        <td>
                            <?php 
                            // Si la fecha de devolución está registrada, no la mostramos más en la tabla una vez devuelto
                            if ($prestamo['fecha_devolucion']) {
                                echo 'Devuelto el ' . htmlspecialchars($prestamo['fecha_devolucion']);
                            } else {
                                echo 'Pendiente';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if (!$prestamo['fecha_devolucion']): ?>
                                <form method="POST" action="admin_prestamos.php">
                                    <input type="hidden" name="id_prestamo" value="<?= $prestamo['id_prestamo'] ?>">
                                    <button type="submit" class="btn btn-devolver">Marcar como devuelto</button>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-secondary" disabled>Devuelto</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<?php include '../plantillas/footer_catalogo.php'; ?>
</body>
</html>
