<?php
$calif1 = 80;
$calif2 = 40;
$calif3 = 40;

$promedio = ($calif1+$calif2+$calif3)/3;

if($promedio <=69)
{
    echo "Tu promedio final es: $promedio. Estas reprobado.";
}
elseif($promedio >=70 && $promedio <=95)
{
    echo "Tu promedio final es: $promedio. Estas aprobado.";
}
elseif($promedio >=96)
{
    echo "Tu promedio final es: $promedio. Estas exento.";
}


?>