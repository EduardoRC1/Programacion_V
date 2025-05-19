<?php
    $Numero1=$_POST['Numero1'];
    $Numero2=$_POST['Numero2'];
    $resultado=$_POST['calcular'];


    switch($resultado) {
        case 'Suma':
            $resultado=$Numero1+$Numero2;
            echo "Tu resultado es: $resultado";
            break;

        case 'Resta':
            $resultado=$Numero1-$Numero2;
            echo "Tu resultado es: $resultado";
            break;

        case 'Multiplicar':
            $resultado=$Numero1*$Numero2;
            echo "Tu resultado es: $resultado";
            break;

        case 'Division':
            $resultado=$Numero1/$Numero2;
            echo "Tu resultado es: $resultado";
            break;
        }

?>