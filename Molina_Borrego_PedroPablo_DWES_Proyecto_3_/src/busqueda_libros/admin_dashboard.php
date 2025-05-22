<?php
session_start();

// Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../registro/iniciar_sesion.php");
    exit;
}


$nombre_usuario = $_SESSION['usuario'] ?? "Administrador no definido"; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../../assets/imagenes/inicio_sesion.png" type="image/x-icon">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        
            justify-content: center;
            align-items: center;
            
           
        }
        h1{
            margin-top: 52px;
        }
        .dashboard-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 70%;
            text-align: center;
            margin-left: 13%;
          
        }

        

        .dashboard-container h2 {
            color: #333;
            margin-bottom: 30px;
            font-size: 1.5rem;
            margin-top: 150px;
        }

        .btn-dashboard {
            display: inline-block;
            text-decoration: none;
            padding: 15px 30px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-dashboard:hover {
            background-color: #0056b3;
        }

        .logout {
           
            text-decoration: none;
            padding: 10px 20px;
            background: #dc3545;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout:hover {
            background: #c82333;
        }

       
    </style>
</head>
<body>
<?php include '../plantillas/nav_catalogo.php'; ?>
<br><br>
    <div class="dashboard-container">
        <h1>Bienvenido, <?= htmlspecialchars($nombre_usuario); ?>!</h1>
        <p>Este es tu panel de administración.</p>

        <h2>Funciones de Administrador</h2>

        <div class="btn-container">
            <a href="./admin_libros.php" class="btn-dashboard">Gestionar Catálogo de Libros</a>
            <a href="./admin_prestamos.php" class="btn-dashboard">Gestionar Préstamos</a>
            <a href="./admin_estadisticas.php" class="btn-dashboard">Generar Informes y Estadísticas</a>
        </div>
        
        <br>
        <a href="../registro/logout.php" class="logout">Cerrar sesión</a>
    </div>
    <?php include '../plantillas/footer_catalogo.php'; ?>

</body>
</html>
