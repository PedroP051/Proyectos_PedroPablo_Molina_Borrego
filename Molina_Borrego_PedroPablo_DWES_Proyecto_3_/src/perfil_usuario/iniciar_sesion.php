<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre_usuario'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'] ?? null;
    $contrasena = $_POST['contrasena'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $codigo = $_POST['codigo'] ?? null;

    $codigo_correcto = "ADMIN123"; // Código especial para bibliotecarios

    // Verificar que todos los campos requeridos estén llenos
    if (empty($nombre) || empty($correo) || empty($contrasena) || empty($tipo_usuario)) {
        echo "<div class='notification error'>Por favor, complete todos los campos requeridos.</div>";
        exit;
    }

    // Verificar código para bibliotecarios
    if ($tipo_usuario === 'bibliotecario' && $codigo !== $codigo_correcto) {
        echo "<div class='notification error'>Código especial para bibliotecarios incorrecto.</div>";
        exit;
    }

    // Validación de correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='notification error'>El correo electrónico no tiene un formato válido.</div>";
        exit;
    }

    // Hash de la contraseña
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    // Datos de conexión a la base de datos
    $host = "localhost";
    $user = "root";
    $pass = "contraseña1234";
    $dbname = "proyecto3_entidades";

    try {
        // Conexión a la base de datos con PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar si el correo ya existe
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE correo = :correo");
        $stmt->execute(['correo' => $correo]);
        $existe_correo = $stmt->fetchColumn();

        if ($existe_correo) {
            echo "<div class='notification error'>Este correo ya está registrado.</div>";
            exit;
        }

        // Preparar la consulta SQL con el tipo de usuario
        $stmt = $pdo->prepare("INSERT INTO usuario (nombre, correo, telefono, password, tipo_usuario, fecha_registro) 
                               VALUES (:nombre, :correo, :telefono, :password, :tipo_usuario, NOW())");

        // Ejecutar la consulta con parámetros
        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':telefono' => $telefono,
            ':password' => $hashed_password,
            ':tipo_usuario' => $tipo_usuario,
        ]);

        echo "<div class='notification success'>Usuario registrado exitosamente.</div>";
    } catch (PDOException $e) {
        // Manejo de errores
        echo "<div class='notification error'>Error al registrar el usuario: " . $e->getMessage() . "</div>";
    } finally {
        // Cerrar la conexión
        $pdo = null;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/imagenes/inicio_sesion.png" type="image/x-icon">
    <title>Registro de Usuario</title>
    <style>
        /* Estilo para las notificaciones */
        .notification {
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .success {
            background-color: #28a745;
            color: white;
        }

        .error {
            background-color: #dc3545;
            color: white;
        }

        /* Otros estilos */
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

        input[type="text"], input[type="password"], select {
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
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registro de Usuario</h2>
        <form action="registro.php" method="POST">
            <label for="nombre_usuario">Nombre:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required placeholder="Tu nombre">
            
            <label for="correo">Correo Electrónico:</label>
            <input type="text" id="correo" name="correo" required placeholder="Tu correo electrónico">
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" placeholder="Tu teléfono (opcional)">
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required placeholder="Tu contraseña">
            
            <label for="tipo_usuario">Tipo de usuario:</label>
            <select id="tipo_usuario" name="tipo_usuario" required>
                <option value="cliente">Cliente</option>
                <option value="bibliotecario">Bibliotecario</option>
            </select>
            
            <label for="codigo">Código de bibliotecario (si aplica):</label>
            <input type="text" id="codigo" name="codigo" placeholder="Código para bibliotecarios">
            
            <br><br>
            <input type="submit" value="Registrar">
        </form>
    </div>
</body>
</html>
