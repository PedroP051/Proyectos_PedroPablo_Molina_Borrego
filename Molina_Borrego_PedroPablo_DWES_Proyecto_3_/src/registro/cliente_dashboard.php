<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    // Si no hay sesión activa, redirigir al formulario de inicio de sesión
    header("Location: iniciar_sesion.php");
    exit;
}

// Si hay sesión activa, mostrar el dashboard
$nombre_usuario = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard del Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
           
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dashboard {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #333;
        }
        .logout {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?>!</h1>
        <p>Este es tu panel de cliente.</p>
        <a href="./logout.php" class="logout">Cerrar sesión</a>
    </div>
    <?php include './footer_sesion.php'; ?>
</body>
</html>
