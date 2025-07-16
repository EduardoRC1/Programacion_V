<?php
// add_class.php se utilizara para agregar una nueva clase a la base de datos
// session_start(); para manejar la sesión del usuario
session_start();
// Verificar si el usuario ha iniciado sesión
// Si la variable de sesión 'username' no está definida, significa que el usuario no ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: login.php");
    // Terminar el script para evitar que se ejecute el resto del código
    exit();
}
// Si el usuario ha iniciado sesión, se puede continuar con el procesamiento del formulario
// Procesar el formulario de agregar clase
// $_SERVER["REQUEST_METHOD"] verifica si el método de solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clase = $_POST['clase'];
    $PrimerParcial = $_POST['PrimerParcial'];
    $SegundoParcial = $_POST['SegundoParcial'];
    $TercerParcial = $_POST['TercerParcial'];
    $calificacion = ($PrimerParcial + $SegundoParcial + $TercerParcial) / 3;
    $username = $_SESSION['username'];
// Conexión a la base de datos
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "1234";
    $db_name = "school";

// Crear conexión a la base de datos
    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

    // Verificar la conexión
    // Si la conexión falla, mysqli_connect devuelve false
    if ($conn) {
        // Preparar la consulta para insertar la nueva clase
        $stmt = $conn->prepare("INSERT INTO classes (clase, PrimerParcial, SegundoParcial, TercerParcial, calificacion, username) VALUES (?, ?, ?, ?, ?, ?)");
        // "sdddds" "s" indica que el primer y último parámetros son cadenas, "d" indica que los otros parámetros son números decimales
        // bind_param vincula las variables a los parámetros de la consulta preparada
        $stmt->bind_param("sdddds", $clase, $PrimerParcial, $SegundoParcial, $TercerParcial, $calificacion, $username);

        if ($stmt->execute()) {
            //esto indica que la consulta se ejecutó correctamente y aplicó los cambios a la base de datos
            // Redirigir a la página de inicio con un mensaje de éxito en la URL
            header("Location: HomePage.php?class_added=success");
            exit();
        } else {
            echo "Error al agregar la clase: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    } else {
        echo "Error de conexión a la base de datos. ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Clase</title>
</head>
<body>
    <h1>Agregar Nueva Clase</h1>
    <form action="" method="POST">
        <label for="clase">Nombre de la Clase:</label>
        <input type="text" id="clase" name="clase" required><br>
        <label for="PrimerParcial">Primer Parcial:</label>
        <input type="number" id="PrimerParcial" name="PrimerParcial" step="0.01" min="0" max="100" required><br>
        <label for="SegundoParcial">Segundo Parcial:</label>
        <input type="number" id="SegundoParcial" name="SegundoParcial" step="0.01" min="0" max="100" required><br>
        <label for="TercerParcial">Tercer Parcial:</label>
        <input type="number" id="TercerParcial" name="TercerParcial" step="0.01" min="0" max="100" required><br>
        <input type="submit" value="Agregar Informacion"><br>
    </form>
    <a href="HomePage.php">Volver a la Página de Inicio</a>
</body>
</html>