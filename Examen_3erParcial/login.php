<?php
// Comenzar sesión para manejar la autenticación
session_start();
// Definir variables para mensajes de error y éxito
$error_msg = "";
$success_msg = "";

// Verificar si hay un mensaje de error en la URL
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'invalid') {
        // Este error ocurre cuando el usuario o la contraseña son incorrectos
        $error_msg = "Invalid username or password!";
    } elseif ($_GET['error'] == 'notfound') {
        // Error si el usuario no se encuentra
        $error_msg = "User not found!";
    }
}
// Verificar si hay un mensaje de éxito en la URL
if (isset($_GET['registered']) && $_GET['registered'] === 'success') {
    $success_msg = "Usuario registrado correctamente.";
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Login</title>
</head>
<body>
    <h1>Login</h1>

    <!-- Mensaje de éxito para el registro -->
    <?php if($success_msg): ?>
    <div style="color: green; background-color: #d4edda; border: 1px solid #c3e6cb; padding: 10px; margin: 10px 0; border-radius: 4px;">
        <?php echo ($success_msg); ?>
    </div>
    <!--cierre del mensaje de éxito -->
    <?php endif; ?>

    <!--Formulario de inicio de sesión -->
    <form action="LoginProcess.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <!--Para registrar un nuevo usuario -->
    <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
</body>
</html>