<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

$db_server = "localhost";
$db_user = "root";
$db_password = "1234";
$db_name = "school";

$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

$clases = [];
if ($conn) {
    $stmt = $conn->prepare("SELECT clase, PrimerParcial, SegundoParcial, TercerParcial, calificacion FROM classes WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $clases[] = $row;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta de Calificaciones</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h1>Boleta de Calificaciones</h1>
    <p><strong>Alumno:</strong> <?php echo htmlspecialchars($username); ?></p>
    <table border="1">
        <tr>
            <th>Clase</th>
            <th>Primer Parcial</th>
            <th>Segundo Parcial</th>
            <th>Tercer Parcial</th>
            <th>Calificación Final</th>
            <th>Estatus</th>
        </tr>
        <?php foreach ($clases as $clase): 
        // Aqui creamos una variable para almacenar el promedio de las calificaciones
        // Hacemos un if para determinar el estatus del alumno basado en el promedio de las calificaciones
            $promedio = ($clase['PrimerParcial'] + $clase['SegundoParcial'] + $clase['TercerParcial']) / 3;
            if ($promedio < 60) {
                $estatus = "Reprobado";
            } elseif ($promedio < 95) {
                $estatus = "Ordinario";
            } else {
                $estatus = "Exento";
            }
        ?>
        <tr>
            <!-- Mostramos los datos de cada clase -->
            <!-- Vamos utilizar una funcion que se llama round para redondear el promedio a 2 decimales, esto es mas por estetica -->
            <td><?php echo ($clase['clase']); ?></td>
            <td><?php echo ($clase['PrimerParcial']); ?></td>
            <td><?php echo ($clase['SegundoParcial']); ?></td>
            <td><?php echo ($clase['TercerParcial']); ?></td>
            <td><?php echo round($promedio, 2); ?></td>
            <td><?php echo $estatus; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="Homepage.php">Volver a la Página de Inicio</a>
</body>
</html>