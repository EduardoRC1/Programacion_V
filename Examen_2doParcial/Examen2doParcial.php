<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen 2do Parcial</title>

    <!-- Estilos CSS para el formulario -->
        <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
    color: #333;
}
        
        
        form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 16px;
        }
        
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #45a049;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
         h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            flex-direction: column;
        }
        .result {
            background-color: #e7f3fe;
            border-left: 6px solid #2196F3;
            padding: 20px;
            margin-top: 20px;
            border-radius: 4px;
        }

        .loop-section {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .parcial-group {
            flex: 1;
            text-align: center;
        }
        
        .parcial-group h3 {
            margin: 0 0 10px 0;
            color: #333;
            font-size: 16px;
        }
        
        .parcial-group input {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <!-- Formulario para ingresar calificaciones -->
    <form action="Examen2doParcial.php" method="post">
        <h1>Formulario de Calificaciones</h1>
        
        <div class="form-group">
            <label>Nombre de Alumno: </label>
            <input type="text" name="Alumno" placeholder="Alumno">
        </div>
        
        <div class="form-group">
            <label>Materia:</label>
            <select name="Materia" id="Materia">
                <option>Seleccione un Materia</option>
                <option value="Programacion">Programacion V</option>
                <option value="Administracion">Administracion</option>
                <option value="Seguridad">Seguridad</option>
                <option value="Ingles">Ingles</option>
            </select>
        </div>

        <!-- Radio Button para eligir genero, igual se incluye en php un isset para determinar que hay un genero eligido"-->
    <div>
    <input type="radio" id="Hombre" name="Genero" value="Hombre" />
    <label for="Hombre">Hombre</label>
</div>
<div>
    <input type="radio" id="Mujer" name="Genero" value="Mujer" />
    <label for="Mujer">Mujer</label>
</div>

    <!-- Dividimos las clases de cada parcial para utilizar el "Flex: 1;"-->
<div class="loop-section">
    <div class="parcial-group">
        <h3>1er Parcial</h3>
        <input type="text" name="parcial1">
    </div>
    
    <div class="parcial-group">
        <h3>2do Parcial</h3>
        <input type="text" name="parcial2">
    </div>
    
    <div class="parcial-group">
        <h3>3er Parcial</h3>
        <input type="text" name="parcial3">
    </div>
</div>
   
        <button type="submit">Calcular Promedio</button>
    </form>
    <?php

//para verificar que datos fueron mandados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Alumno = $_POST['Alumno'] ?? '';
    $Materia = $_POST['Materia'] ?? '';
    $Genero = $_POST['Genero'] ?? '';
    $parcial1 = ($_POST['parcial1'] ?? 0);
    $parcial2 = ($_POST['parcial2'] ?? 0);
    $parcial3 = ($_POST['parcial3'] ?? 0);

    $Calificaciones = "$parcial1, $parcial2, $parcial3";
    $CaliF = round(($parcial1 + $parcial2 + $parcial3) / 3, 2);
    // Linea 172 especificamente es un If else, el cual nos indica que si se selecciona Hombre, se asigna Hombre, si se selecciona Mujer, se asigna Mujer, y si no se selecciona ninguno, se asigna un emoji de bandera de arcoiris jaja ":" De lo contrario.
    $Genero = isset($_POST['Hombre']) ? 'Hombre' : (isset($_POST['Mujer']) ? 'Mujer' : '🏳️‍🌈?');
    $Calificaciones = "$parcial1, $parcial2, $parcial3";

    // Mostrar resultados
    echo '<div class="result">';
    echo "Resultado de Tetra:<br>";
    echo "Alumno: $Alumno<br>";
    echo "Genero: $Genero<br>";
    echo "Materia: $Materia<br>";
    echo "Calificaciones: $Calificaciones<br>";
    echo "Calificacion Final: $CaliF<br>";
    echo '</div>';
}

?>
</body>
</html>