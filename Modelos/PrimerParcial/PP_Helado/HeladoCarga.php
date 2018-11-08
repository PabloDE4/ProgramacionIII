<?php

include "./Entidades/Helado.php";

$sabor = $_POST['sabor'];
$precio = $_POST['precio'];
$tipo = $_POST['tipo'];
$cantidad = $_POST['cantidad'];

$carga = Helado::HeladoCarga($sabor, $precio, $tipo, $cantidad);

if ($carga) {
    echo "Helado Cargado";
} else {
    echo "Error al cargar el helado";
}





?>