<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$db_server = "localhost";
$db_user = "root";
$db_password = "1234";
$db_name = "school";
$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

$username = $_SESSION['username'];
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $PrimerParcial = $_POST['PrimerParcial'];
    $SegundoParcial = $_POST['SegundoParcial'];
    $TercerParcial = $_POST['TercerParcial'];
    $calificacion = ($PrimerParcial + $SegundoParcial + $TercerParcial) / 3;

    // se usa stmt para preparar una consulta SQL segura esto es buena practica de seguridad
    $stmt = $conn->prepare("UPDATE classes SET PrimerParcial = ?, SegundoParcial = ?, TercerParcial = ?, calificacion = ? WHERE id = ? AND username = ?");
    // "ddddis" indica que el primer, segundo, tercero y cuarto parámetros son números decimales("d"), el quinto es un int("i") y el sexto es una cadena("s")(string)
    // bind_param vincula las variables a los parámetros de la consulta preparada
    $stmt->bind_param("ddddis", $PrimerParcial, $SegundoParcial, $TercerParcial, $calificacion, $id, $username);
    // Si se ejecuta correctamente, se actualiza la calificación y muestra un mensaje de éxito
    if ($stmt->execute()) {
        $mensaje = "Calificación actualizada correctamente.";
    // Si no, muestra un mensaje de error
    } else {
        $mensaje = "Error al actualizar la calificacion.";
    }
    // Se cierra la declaración
    $stmt->close();
}

// Obtener las clases del usuario
$clases = [];
$stmt = $conn->prepare("SELECT id, clase, PrimerParcial, SegundoParcial, TercerParcial, calificacion FROM classes WHERE username = ?");
// Otra ves "s" indica que el parámetro es una cadena (string)
$stmt->bind_param("s", $username);
$stmt->execute();
// Se crea una variable para almacenar los resultados
$result = $stmt->get_result();
// La funcion while se usa para recorrer los resultados obtenidos de la consulta
// fetch_assoc() devuelve una fila como un array asociativo
while ($row = $result->fetch_assoc()) {
    // Se agrega cada fila al array $clases
    $clases[] = $row;
}
// Se cierra la declaración, el resultado y la conexión a la base de datos
// Estas funciones son mas avanzado y se hacen para liberar recursos y evitar fugas de memoria
$result->close();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Calificacion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Editar Calificacion de tus Clases</h1>
<!-- El codigo php se usa para mostrar un mensaje si hay uno -->
    <?php 
    // Si hay un mensaje, se muestra en la página
    if ($mensaje) echo "<p>$mensaje</p>"; 
    ?>

    <!-- En este form vamos usar HTML y PHP para crear un formulario que permita al usuario seleccionar una clase y actualizar su calificación -->
    <form method="POST">
        <label for="id">Selecciona la clase:</label>
        <select name="id" id="id" required>
            <!-- Se usa un foreach para recorrer las clases y crear una opción para cada una -->
            <?php foreach ($clases as $clase): ?>
            <!-- Cada opción tiene el valor del id de la clase y muestra el nombre de la clase -->
                <option value="<?php echo $clase['id']; ?>">
                    <?php echo ($clase['clase']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <label for="PrimerParcial">Primer Parcial:</label>
        <input type="number" name="PrimerParcial" id="PrimerParcial" step="0.01" min="0" max="100" required><br>
        <label for="SegundoParcial">Segundo Parcial:</label>
        <input type="number" name="SegundoParcial" id="SegundoParcial" step="0.01" min="0" max="100" required><br>
        <label for="TercerParcial">Tercer Parcial:</label>
        <input type="number" name="TercerParcial" id="TercerParcial" step="0.01" min="0" max="100" required><br>
        <input type="submit" value="Actualizar">
    </form>
    <a href="Homepage.php" class="btn">Volver a la Pagina de Inicio</a>
</body>
</html>