<?php
session_start();

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $Username = $_POST['username'];
    $Password = $_POST['password'];

    // Conexión a la base de datos
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "1234";
    $db_name = "school";

    // Crear conexión
    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

    // Verificar conexión
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Consulta preparada para evitar SQL injection
    // Se utiliza stmt porque se significa statement pero se puede utilizar cualquier nombre
    // ? es un marcador de posición para el valor que se vinculará más tarde
    $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ?");
    // Se utiliza bind_param para evitar inyecciones SQL porque permite vincular variables a los parámetros de la consulta
    // "s" indica que el parámetro es una cadena (string)
    $stmt->bind_param("s", $Username);
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener el resultado
    // get_result() devuelve un objeto de resultado que se puede usar para obtener filas
    $result = $stmt->get_result();
    
    // Verificar si se encontró el usuario
    // num_rows devuelve el número de filas en el resultado
    // Si es mayor que 0, significa que se encontró al usuario
    if ($result->num_rows > 0) {
        // Obtener el usuario usando un fetch_assoc que devuelve un array asociativo
        // Un array asociativo es un array donde las claves son los nombres de las columnas de la tabla
        $user = $result->fetch_assoc();    
        
        // Verificar contraseña (debe estar hasheada en la base de datos)
        if (password_verify($Password, $user['Password'])) {
            // Guardar información del usuario en la sesión
            $_SESSION['username'] = $user['Username'];
            
            // Cerrar la conexión antes de redirigir
            $stmt->close();
            $conn->close();
            
            // Redirect to homepage ONLY if login is successful
            header("Location: Homepage.php");
            exit();
        } else {
            // Cerrar la conexión
            $stmt->close();
            $conn->close();
            
            // Redirect back to login with error
            header("Location: login.php?error=invalid");
            exit();
        }
    } else {
        // Cerrar la conexión
        $stmt->close();
        $conn->close();
        
        // Redirect back to login with error
        header("Location: login.php?error=notfound");
        exit();
    }
} else {
    // Si la solicitud no es POST, redirigir a la página de inicio de sesión
    header("Location: login.php");
    exit();
}
?>