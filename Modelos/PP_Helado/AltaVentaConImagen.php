<?php

include "./Entidades/Ventas.php";
include "./Entidades/Helado.php";

$mail = $_POST['mail'];
$sabor = $_POST['sabor'];
$tipo = $_POST['tipo'];
$cantidad = $_POST['cantidad'];

$carga = Ventas::AltaVentaConImagen($mail, $sabor, $tipo, $cantidad);

if ($carga) {
    echo "Venta cargada con imagen";
} else {
    echo "Error al cargar Venta Con Imagen";
}

?>