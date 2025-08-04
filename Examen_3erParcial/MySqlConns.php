<?php
// Este documento muestra los bases de datos disponibles en el servidor MySQL
// Esto lo uso yo para verificar que la conexión a la base de datos funciona correctamente y para ver un listado de los bases de datos disponibles


$db_server = "localhost";
$db_user = "root";
$db_password = "1234";

$conn = mysqli_connect($db_server, $db_user, $db_password);

if($conn){
    echo "Conexión exitosa<br>";
    $result = mysqli_query($conn, "SHOW DATABASES;");
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['Database'] . "<br>";
    }
} else {
    echo "Fallo la conexión: " . mysqli_connect_error();
}
?>