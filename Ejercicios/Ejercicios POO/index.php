<?php
include_once("./19/Rectangulo.php");
include_once("./19/Triangulo.php");
include_once("./20/Rectangulo.php");
include_once("./20/Punto.php");
include_once("./21/Auto.php");

echo "<br/>---------- EJERCICIO 19 ----------<br/>";

$rectangulo = new Rectangulo(2, 9);
$triangulo = new Triangulo(3, 8);

$triangulo->setColor("red");
$rectangulo->setColor("blue");

echo $triangulo;
echo $rectangulo;

echo "<br/>---------- EJERCICIO 20 ----------<br/>";

$v1 = new Punto(1, -1);
$v3 = new Punto(8, 3);
$rec = new RectanguloDos($v1, $v3);
echo $rec->Dibujar();

echo "<br/>---------- EJERCICIO 21 ----------<br/>";

$auto1 = new Auto("Ford", "Verde");
$auto2 = new Auto("Ford", "Verde");
$auto3 = new Auto("VW", "Azul", 85432.54);
$auto4 = new Auto("VW", "Azul", 105432.54);
$auto5 = new Auto("BMW", "Negro", 543000.99, new DateTime());

$auto3->AgregarImpuestos(2000);
$auto4->AgregarImpuestos(1500);
$auto5->AgregarImpuestos(3500);

echo Auto::Add($auto3, $auto4);
if ($auto1->Equals($auto2)) {
    echo "TRUE";
} else {
    echo "FALSE";
}

if ($auto1->Equals($auto5)) {
    echo "TRUE";
} else {
    echo "FALSE";
}

echo Auto::MostrarAuto($auto1);
echo Auto::MostrarAuto($auto3);
echo Auto::MostrarAuto($auto5);
?>