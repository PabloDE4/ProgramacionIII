<?php
// include "funciones.php"; //Incluir un archivo
require_once "funciones.php";
include "alumno.php";

$resultado = Suma(5,3);
// echo $resultado;

//echo Alumno::Saludar(); //Llamar a metodo estatico

$alumno = new Alumno();
$alumno ->nombre ="Pablo";
$alumno ->legajo ='333';
echo $alumno -> Saludar(); //Llamar metodo de instancia
/*
$nombre = "Pablo";

echo $nombre;

echo "Hola! " . $nombre;
echo "Hola! $nombre";


var_dump($nombre); //Devuelve el tipo de dato
var_dump($resultado);


$array = array("Hola", 3, "Chau");

foreach ($array as $elemento) {
    echo $elemento;
}

var_dump($array); 


$arrayClaveValor = array("alfa" => 666, "beta" => 555, "gama" => 444);

foreach ($arrayClaveValor as $elemento => $value) {
    echo $elemento, $value;
}

$otro = ["OtroElemento"];

$queEsEsto = [];
$yEsto = {};

var_dump($queEsEsto);
var_dump($yEsto);

var_dump($arrayClaveValor); 

$obj = new stdclass("nombre");

$obj -> nombre;

var_dump($obj);

*/

?>



