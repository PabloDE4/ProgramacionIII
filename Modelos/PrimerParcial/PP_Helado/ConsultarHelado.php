<?php

include "./Entidades/Helado.php";

$sabor = $_POST['sabor'];
$tipo = $_POST['tipo'];

$respuesta = Helado::ConsultarHelado($sabor, $tipo);

echo $respuesta;

?>