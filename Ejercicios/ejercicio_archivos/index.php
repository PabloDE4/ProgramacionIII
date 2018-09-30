<?php
include "./producto.php";
include "./archivos.php";

$nombre = $_POST['nombre'];
$codigoBarra = $_POST['codigoBarra'];

$producto = new Producto($nombre, $codigoBarra);

$producto->__toString();
//echo $producto;

Archivos::Subir($producto);
Archivos::toJson($producto);
$tabla = Archivos::crearTabla();

echo $tabla;

?>