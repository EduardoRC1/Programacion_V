<?php

//para verificar que datos fueron mandados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Empleado=$_POST['Empleado'];
    $Horas = $_POST['Horas'];
    $Puesto = $_POST['Puesto'];

    //Un array para definir los diferentes tipos de puestos
    $pagos = [
        'Jefe' => 450,
        'Administrativo' => 350,
        'Operador' => 250,
        'Practicante' => 150
    ];
    
    $Salario = $pagos[$Puesto] ?? 0;

    //Las Calculaciones
    $Salario_Bruto = $Horas * $Salario;
    $Porcentaje_Descuento = 10;
    $Descuento = $Salario_Bruto * $Porcentaje_Descuento / 100;
    $Salario_Neto = $Salario_Bruto - $Descuento;
}


//Imprimir a pantalla
echo "Empleado: $Empleado<br>";
echo "Horas Trabajadas: $Horas<br> ";
echo "Salario Bruto: $Salario_Bruto<br>";
echo "Descuento: $Descuento<br>";
echo "Salario Neto: $Salario_Neto<br>";

?>