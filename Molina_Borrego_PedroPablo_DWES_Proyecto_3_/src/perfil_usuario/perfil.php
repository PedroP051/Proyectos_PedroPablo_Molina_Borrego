<?php
session_start();

// Verificar si el usuario ha iniciado sesión correctamente
if (!isset($_SESSION['usuario'])) {
    header("Location: ../registro/iniciar_sesion.php");
    exit;
}

// Obtener nombre de usuario o mostrar "Usuario no definido" si no está en la sesión
$nombre_usuario = $_SESSION['usuario'] ?? "Usuario no definido";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/imagenes/registro.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Perfil</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
            text-align: center;
        }
        .profile-container {
            margin-top: 50px;
        }
        h1 {
            color: #333;
        }
        
        .logout {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #007BFF;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .logout:hover {
            background: #0056b3;
        }
        
    </style>
</head>
<body>
<?php include '../plantillas/nav_catalogo.php'; ?>
<br><br>
    <div class="profile-container">
        <h1>Bienvenido, <?= htmlspecialchars($nombre_usuario); ?>!</h1>
        <p>Este es tu perfil personal.</p>
        <a href="../registro/logout.php" class="logout">Cerrar sesión</a>
    </div>
    <?php include '../plantillas/footer_catalogo.php'; ?>
    
</body>
</html>