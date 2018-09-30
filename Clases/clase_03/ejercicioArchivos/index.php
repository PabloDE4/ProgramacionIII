<?php
include "../ejercicio/producto.php";
include "../ejercicio/archivos.php";

$nombre = $_POST['nombre'];
$codigoBarra = $_POST['codigoBarra'];

$producto = new Producto($nombre, $codigoBarra);

$producto->__toString();
//echo $producto;

$respuestaDeSubir = Archivos::Subir($_POST["nombre"]);

$archivo = $respuestaDeSubir;
echo "Bien " ;

?>