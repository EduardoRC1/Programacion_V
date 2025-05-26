<style>
    body {
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
        color: #343a40;
    }
    
    .receipt-table {
        width: 100%;
        max-width: 600px;
        margin: 30px auto;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.08);
        border-collapse: collapse;
    }
    
    .receipt-header {
        background-color: #2c3e50;
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    .receipt-header h2 {
        margin: 0;
        font-size: 24px;
    }
    
    .receipt-body {
        padding: 0;
    }
    
    .receipt-row {
        display: flex;
        border-bottom: 1px solid #e9ecef;
    }
    
    .receipt-row:last-child {
        border-bottom: none;
    }
    
    .receipt-label {
        width: 40%;
        padding: 15px;
        font-weight: 600;
        background-color: #f8f9fa;
        border-right: 1px solid #e9ecef;
    }
    
    .receipt-value {
        width: 60%;
        padding: 15px;
    }
    
    .price-value {
        color: #2980b9;
        font-weight: 600;
    }
    
    .discount-value {
        color: #e74c3c;
        font-weight: 600;
    }
    
    .total-row {
        background-color: #f1f8fe;
        border-top: 2px solid #3498db;
    }
    
    .total-label {
        font-weight: 700;
        color: #2c3e50;
    }
    
    .total-value {
        font-weight: 700;
        font-size: 18px;
        color: #27ae60;
    }
</style>

<?php
//Captura datos del formulario POST (nombres, edad, tipo de función)

    $firstname=$_POST['FirstName']; 
    $lastname=$_POST['LastName'];
    $age=$_POST['Age'];
    $TipoFuncion=$_POST['TipoDeFuncion'];
    $checkbox=isset($_POST['checkbox']) ? true : false;

//Define precios para diferentes tipos de funciones usando un array asociativo

    $PrecioBase=[
    'Funcion2D' => 40,
    'Funcion3D' => 60,
    'FuncionIMAX' => 85, 
    'SalaVIP' => 105
    ];

    //descuento empieza en 0
    $discount= 0;

    //if para comprobar las edades ingresadas
      if ($checkbox) {
        $discount = 0.15;
    } elseif ($age >= 12 && $age >= 64) {
        $discount = 0.20;
    } elseif ($age >= 65) {
        $discount = 0.25;
    }
    //creamos un variable para determinar el precio selecionado
    $selectedPrice = $PrecioBase[$TipoFuncion] ?? 0;
    //un variable es creado para saber cuanto es el descuento utilizando la matematica del precio * el porcento de descuento
    $discountAmount = $selectedPrice * $discount;
    //el variable del total precio selecionado - descuento
    $Total = $selectedPrice - $discountAmount;

    //llamamos a pantalla todo los datos ingresados

    echo "<h2>Recibo de Compra</h2>";
    echo "<p>Nombre: $firstname $lastname</p>";
    echo "<p>Edad: $age</p>";
    echo "<p>Tipo de Función: $TipoFuncion</p>";
    echo "<p>Precio Base: $selectedPrice MXN</p>";
    if ($discount > 0) {
        echo "<p>Descuento: %" . ($discount * 100);
    }
    echo "<p>Total a Pagar: $Total MXN</p>";




?>