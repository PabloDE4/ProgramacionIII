<?php
include "./Entidades/Ventas.php";

$mail = $_POST['mail'];
$sabor = $_POST['sabor'];

echo Ventas::TablaVentas($mail, $sabor);


?>