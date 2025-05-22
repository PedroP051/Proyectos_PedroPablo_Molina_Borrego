<?php
session_start(); // Iniciar la sesión

// Conexión a la base de datos
$host = 'mysql-pedrop.alwaysdata.net';
$usuario = 'pedrop'; // Cambia por tu usuario de MySQL
$contrasena = 'Espana19!';  // Cambia por tu contraseña de MySQL
$base_datos = 'pedrop_proyecto3_v1';

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Variables para el mensaje de error
$error_msg = "";

// Obtener los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST['nombre_usuario']);
    $contrasena = trim($_POST['contrasena']);

    // Consulta segura con prepared statements
    $sql = "SELECT id_usuario, nombre, password, tipo_usuario FROM usuario WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contrasena, $usuario['password'])) {
            // Guardamos la sesión
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['usuario'] = $usuario['nombre']; // Nombre del usuario
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario']; // Tipo de usuario

            // Redirigir según el tipo de usuario
            if ($_SESSION['tipo_usuario'] === 'bibliotecario') {
                header("Location: ../busqueda_libros/admin_dashboard.php"); // Redirigir a panel de administrador
            } else {
                header("Location: ../../index.php"); // Redirigir a página de cliente
            }
            exit;
        } else {
            $error_msg = "Contraseña incorrecta.";
        }
    } else {
        $error_msg = "Usuario no encontrado.";
    }

    $stmt->close();
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/imagenes/inicio_sesion.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inicio de sesión</title>
    <style>
        body {
            margin-top: 39px;
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            height: 100vh;
            display: grid;
            text-align: center;
            align-items: center;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin-left: 36%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: rgb(33, 115, 222);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: rgb(69, 133, 160);
        }

        .note {
            font-size: 12px;
            color: #777;
            text-align: center;
        }

        .note a {
            color: rgb(76, 137, 175);
            text-decoration: none;
        }

        .note a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .demo-users {
            font-size: 12px;
            color: #444;
            text-align: center;
        }

        .demo-users p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<?php include '../plantillas/nav_catalogo.php'; ?>
    <br><br>
    <div class="form-container">
        <h2>Inicio de sesión</h2>
        
        <?php if (!empty($error_msg)): ?>
            <div class="error-message"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <form action="iniciar_sesion.php" method="POST">
            <label for="nombre_usuario">Correo Electrónico:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required placeholder="Tu correo electrónico">
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required placeholder="Tu contraseña">
            
            <br><br>
            <input type="submit" value="Iniciar sesión">
        </form>

        <div class="note">
            <p>¿No tienes cuenta? <a href="./registro.php">Registrarse</a></p>
        </div>

        <div class="demo-users">
            <h3>Usuarios de demostración:</h3>
            <p><strong>Correo:</strong> demo@ejemplo.com | <strong>Contraseña:</strong> demo1234</p>
            <p><strong>Correo:</strong> admin2@gmail.com | <strong>Contraseña:</strong> admin1234</p>
        </div>
    </div>
    <?php include '../plantillas/footer_catalogo.php'; ?>
</body>
</html>
