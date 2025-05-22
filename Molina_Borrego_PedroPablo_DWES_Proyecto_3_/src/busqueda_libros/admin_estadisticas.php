<?php
session_start();
require_once("../connect_bdd/conxion_bdd.php");

// Verificar si el usuario está autenticado y es bibliotecario
$usuario_autenticado = $_SESSION['id_usuario'] ?? null;



// 1. Libros más solicitados (por número de préstamos)
$query_libros_solicitados = "SELECT l.titulo, COUNT(p.id_libro) AS num_prestamos
                             FROM prestamos p
                             JOIN libro l ON p.id_libro = l.id_libro
                             WHERE p.fecha_devolucion IS NULL
                             GROUP BY l.titulo
                             ORDER BY num_prestamos DESC LIMIT 5";
$stmt = $pdo->prepare($query_libros_solicitados);
$stmt->execute();
$libros_mas_solicitados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 2. Tasas de préstamos y devoluciones
$query_tasas = "SELECT 
                    (SELECT COUNT(*) FROM prestamos WHERE fecha_devolucion IS NULL) AS prestamos_activas,
                    (SELECT COUNT(*) FROM prestamos WHERE fecha_devolucion IS NOT NULL) AS prestamos_devueltos";
$stmt = $pdo->prepare($query_tasas);
$stmt->execute();
$tasa_prestamos = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. Patrones de uso (prestamos por mes)
$query_patrones = "SELECT MONTH(fecha_prestamo) AS mes, COUNT(*) AS num_prestamos
                   FROM prestamos
                   GROUP BY MONTH(fecha_prestamo)
                   ORDER BY mes ASC";
$stmt = $pdo->prepare($query_patrones);
$stmt->execute();
$patrones_uso = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas e Informes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../../assets/imagenes/libros.png" type="image/x-icon">
    <style>
       h1{
        margin-top: 40px;
       }
        .table th, .table td {
            text-align: center;
        }
        .stats-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<?php include '../plantillas/nav_catalogo.php'; ?>
<div class="container">
    <h1 class="text-center mb-4">Estadísticas e Informes de la Biblioteca</h1>

    
    <div class="stats-container">
        <h3>Libros Más Solicitados</h3>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Título</th>
                    <th>Numero de Préstamos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($libros_mas_solicitados as $libro): ?>
                    <tr>
                        <td><?= htmlspecialchars($libro['titulo']) ?></td>
                        <td><?= htmlspecialchars($libro['num_prestamos']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

 
    <div class="stats-container">
        <h3>Tasas de Préstamos y Devoluciones</h3>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Préstamos Activos</th>
                    <th>Préstamos Devueltos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($tasa_prestamos['prestamos_activas']) ?></td>
                    <td><?= htmlspecialchars($tasa_prestamos['prestamos_devueltos']) ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="stats-container">
        <h3>Patrones de Uso (Préstamos por Mes)</h3>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Mes</th>
                    <th>Numero de Préstamos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patrones_uso as $patron): ?>
                    <tr>
                        <td><?= date('F', mktime(0, 0, 0, $patron['mes'], 10)) ?></td>
                        <td><?= htmlspecialchars($patron['num_prestamos']) ?></td>
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
