<?php
include "../clases/usuarios.php";

$nombre = $_POST['nombre'];
$clave = $_POST['clave'];

$usuario = new Usuario($nombre, $clave);

$usuario->__toString();

$objetoJson = $usuario->toJson($usuario);


?>