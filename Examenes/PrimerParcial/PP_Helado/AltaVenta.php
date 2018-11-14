<?php

include "./Entidades/Helado.php";
include "./Entidades/Ventas.php";

$mail = $_POST['mail'];
$sabor = $_POST['sabor'];
$tipo = $_POST['tipo'];
$cantidad = $_POST['cantidad'];


$carga = Ventas::AltaVenta($mail,$sabor,$tipo,$cantidad);

if ($carga) {
    echo "Venta cargada";
} else {
    echo "Error al cargar la venta";
}


?>