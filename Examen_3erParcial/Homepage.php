<?php
// Iniciar sesión para manejar la autenticación
session_start();
// Checar si el usuario ha iniciado sesión !isset es una función que verifica si una variable no está definida o es null
// En este caso, se verifica si la variable de sesión 'username' está definida
// Si no está definida, significa que el usuario no ha iniciado sesión
if (!isset($_SESSION['username'])) {
    //Si El usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: login.php");  
    exit();
}
// Si el usuario ha iniciado sesión, obtener el nombre de usuario
// Esto se asume que se ha guardado en la sesión al iniciar sesión
$username = $_SESSION['username'];

// Conexión a la base de datos
$db_server = "localhost";
$db_user = "root";
$db_password = "1234";
$db_name = "school";

// Crear conexión
$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

// Aqui creamos variables para almacenar los nombres
// Estas variables se usaran para mostrar el nombre completo del usuario en la pagina de inicio
$first_name = "";
$last_name = "";
$second_last_name = "";

// Creamos una consulta para obtener los nombres del usuario
// Creamos un statement para evitar inyecciones SQL (stmt) esto es buena practica para cuando haga algo en vivo fuera de localhost
if ($conn) {
    // Preparamos la consulta para obtener los nombres del usuario
    $stmt = $conn->prepare("SELECT first_name, last_name, second_last_name FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    // Vinculamos los resultados a las variables creadas anteriormente
    $stmt->bind_result($first_name, $last_name, $second_last_name);
    // Obtenemos los resultados usando el metodo fetch
    $stmt->fetch();
    // Cerramos el statement
    $stmt->close();
}

// Creamos un array para almacenar las clases del usuario
$clases = [];
// Hacemos una consulta para obtener las clases del usuario
if ($conn) {
    $stmt = $conn->prepare("SELECT clase, calificacion, PrimerParcial, SegundoParcial, TercerParcial FROM classes WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    // Creamos un variable para almacenar los resultados que se obtienen de la consulta anterior
    $result = $stmt->get_result();
    // Hacemos un while loop para recorrer los resultados y almacenarlos en el array $clases y le hacemos fetch_assoc para obtener un array asociativo
    // Un array associativo es un array donde las claves son los nombres de las columnas de la tabla y los valores son los valores de las columnas
    // Aqui la llave es el nombre de la columna y el valor es el valor de la columna i.e. clase->Programacion
    while ($row = $result->fetch_assoc()) {
        // Agregamos cada fila del resultado al array $clases
        $clases[] = $row;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Pagina de Inicio</title>
</head>
<body>
    <h1>Bienvenido 
        <?php echo ($first_name . ' ' . $last_name . ' ' . $second_last_name); ?>
         
    </h1>
    <h2>Tus Clases</h2>
    <table border="1">
        <tr>
            <th>Nombre de la Clase</th>
            <th>Primer Parcial</th>
            <th>Segundo Parcial</th>
            <th>Tercer Parcial</th>
            <th>Calificación</th>
        </tr>
        <?php foreach ($clases as $clase): ?>
        <tr>
            <td><?php echo ($clase['clase']); ?></td>
            <td><?php echo ($clase['PrimerParcial']); ?></td>
            <td><?php echo ($clase['SegundoParcial']); ?></td>
            <td><?php echo ($clase['TercerParcial']); ?></td>
            <td><?php echo round($clase['calificacion'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h2>Cambiar Calificacion</h2>
    <a href="change_grade.php">Cambiar Calificación</a><br>
    <h3>¿Te gustaría agregar una clase?</h3>
    <!-- Enlace para agregar una clase -->
    <a href="add_class.php">Agregar Clase</a><br>

    <a href="boleta.php">Ver Boleta de Calificaciones</a><br>

    <!-- Enlace para cerrar sesión -->
    <div id="footer">
        <a href="logout.php">Cerrar Sesión</a>
    </div>
</body>
</html>