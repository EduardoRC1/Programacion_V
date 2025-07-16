<?php
// Iniciar sesión para manejar la autenticación
session_start();
// Eliminar todas las variables de sesión
session_unset();
// Destruir la sesión
session_destroy();
// Redirigir al usuario a la página de inicio de sesión
header("Location: login.php");
// exit() asegura que el script se detenga después de redirigir
exit();
?>