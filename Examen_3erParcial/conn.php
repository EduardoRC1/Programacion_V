<?php
//Nuestra conexión a la base de datos
$db_server = "localhost";
$db_user = "root";
$db_password = "1234";
$db_name = "school";

// Crear conexión
// Usar mysqli para la conexión a la base de datos
$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

// Verificar conexión
// Si la conexión falla, mysqli_connect devuelve false
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Si la conexión es exitosa, se muestra un mensaje "Connected successfully"
else {
    echo "Connected successfully";
}
?>