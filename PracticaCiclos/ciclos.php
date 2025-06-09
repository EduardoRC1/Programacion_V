<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Práctica de Ciclos PHP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Práctica de Ciclos en PHP</h1>
    
    <div class="loop-container">
        <!-- Ciclo For -->
        <div class="loop-section">
            <form method="post">
                <h2>Ciclo For</h2>
                <input type="text" name="numero">
                <input type="submit" value="Submit">
            </form>
            <?php
            //!empty funcion para checar que haya datos en el campo, solo por que me arrojaba un error de array en cada form si no lo agregaba
            if (!empty($_POST['numero'])) {
                $start = $_POST['numero'];
                echo "<div class='result'><h3>Resultado:</h3>";
                for($i = $start + 1; $i <= 10; $i++) {
                    echo "$i<br>";
                }
                echo "</div>";
            }
            ?>
        </div>

        <!-- Do While -->
        <div class="loop-section">
            <form method="POST">
                <h2>Ciclo Do While</h2>
                <input type="text" name="num">
                <input type="submit" value="Submit">
            </form>
            <?php
             //!empty funcion para checar que haya datos en el campo, solo por que me arrojaba un error de array en cada form si no lo agregaba
            if (!empty($_POST['num'])) {
                $start = $_POST['num'];
                echo "<div class='result'><h3>Resultado:</h3>";
                $i = $start + 1;
                do {
                    echo "$i<br>";
                    $i++;
                } while ($i <= 10);
                echo "</div>";
            }
            ?>
        </div>

        <!-- Ciclo While-->
        <div class="loop-section">
            <form method="post">
                <h2>Ciclo While</h2>
                <input type="text" name="number">
                <input type="submit" value="Submit">
            </form>
            <?php
             //!empty funcion para checar que haya datos en el campo, solo por que me arrojaba un error de array en cada form si no lo agregaba
            if (!empty($_POST['number'])) {
                $start = $_POST['number'];
                echo "<div class='result'><h3>Resultado:</h3>";
                $i = $start + 1;
                while ($i <= 10) {
                    echo "$i ";
                    $i++;
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>