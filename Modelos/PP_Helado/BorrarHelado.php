<?php
include "./Entidades/Helado.php";

$sabor = $_POST['sabor'];
$tipo = $_POST['tipo'];

$carga = Helado::BorrarHelado($sabor, $tipo);

if ($carga) {
    echo "Helado borrado";
} else {
    echo "Error al borrar el helado";
}

?>