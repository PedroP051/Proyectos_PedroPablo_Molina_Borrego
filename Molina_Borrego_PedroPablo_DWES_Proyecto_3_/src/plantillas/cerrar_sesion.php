<?php
session_start(); // Iniciar sesión para destruirla
session_unset(); // Limpiar las variables de sesión
session_destroy(); // Destruir la sesión

// Redirigir al usuario a la página de inicio
header("Location: ../../index.php");
exit;
?>
