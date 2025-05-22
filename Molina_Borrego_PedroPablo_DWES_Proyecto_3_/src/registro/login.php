<?php
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

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $conexion->real_escape_string($_POST['nombre_usuario']);
    $contrasena = $conexion->real_escape_string($_POST['contrasena']);
    $tipo_usuario = $conexion->real_escape_string($_POST['tipo_usuario']);

    // Consulta a la base de datos
    $sql = "SELECT * FROM usuario WHERE correo = '$correo'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        // Verifica la contraseña
        if (password_verify($contrasena, $usuario['password'])) { // Cambiar a === si están en texto plano
            // Redirigir según el tipo de usuario
            if ($tipo_usuario === "cliente") {
                session_start();
                $_SESSION['nombre'] = $usuario['nombre'];
                header("Location: ./cliente_dashboard.php");
            } elseif ($tipo_usuario === "bibliotecario") {
                session_start();
                $_SESSION['nombre'] = $usuario['nombre'];
                header("Location: admin_dashboard.php");
            }
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario con correo $correo no encontrado.";
    }
}

$conexion->close();
?>
