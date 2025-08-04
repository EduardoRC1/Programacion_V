<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!--El Formulario de registro -->
    <h1>Register</h1>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        <br>
        <label for="last_name">First Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
        <br>
        <label for="second_last_name">Second Last Name:</label>
        <input type="text" id="second_last_name" name="second_last_name" required>
        <br>
        <input type="submit" value="Register">
    </form>
</body>
</html>

<?php
// Iniciar sesión para manejar la autenticación
session_start();
// Procesar el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST['username'];
    $Password = $_POST['password'];
    $First_Name = $_POST['first_name'];
    $Last_Name = $_POST['last_name'];
    $Second_Last_Name = $_POST['second_last_name'];

    // Hashear la contraseña por que es una buena práctica de seguridad
    // Esto asegura que la contraseña no se almacene en texto plano
    // Aparte no dejaba ingresar el usuario si no estaba hasheada entonces se tuvo que investigar como hashear la contraseña
    $HashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    // Conexión a la base de datos
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "1234";
    $db_name = "school";
    // Crear conexión
    // Usar mysqli para la conexión a la base de datos
    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

    // Verificar conexión
    // Si la conexión falla, mysqli_connect devuelve false
    // Por lo tanto, si $conn es false, hay un error de conexión 
   if ($conn) {
        // Usar consulta preparada para mayor seguridad
        // VALUES especifica los valores que se insertarán en la tabla
        // Usar bind_param para evitar inyecciones SQL
        // sssss indica que todos los parámetros son cadenas
        // Todo esto se utiliza para evitar inyecciones SQL que obviamente es una buena práctica de seguridad 
        // pero como estamos en localhost no hay tanto problema pero es mejor empezar a usar buenas practicas
        $stmt = $conn->prepare("INSERT INTO users (Username, Password, first_name, last_name, second_last_name) VALUES (?, ?, ?, ?, ?)");
        // bind_param vincula las variables a los parámetros de la consulta preparada
        // Esto asegura que los datos se envían de manera segura y evita inyecciones SQL
        $stmt->bind_param("sssss", $Username, $HashedPassword, $First_Name, $Last_Name, $Second_Last_Name);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Registro exitoso
            echo "Usuario registrado correctamente.";
            // Redirigir a login después de registrar
            header('Location: login.php?registered=success');
            exit();
        } else {
            // Error al ejecutar la consulta
            echo "Error al registrar usuario: " . $stmt->error;
        }
        // Cerrar la declaración
        $stmt->close();
    } else {
        // Error de conexión
        echo "Error de conexión a la base de datos.";
    }
    // Cerrar la conexión porque es buena practica cerrar la conexión a la base de datos cuando ya no se necesita
    $conn->close();
}
?>  