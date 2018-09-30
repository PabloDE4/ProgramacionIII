<?php

include_once("figuraGeometrica.php");

class Rectangulo extends figuraGeometrica
{
    //Atributos
    private $ladoUno;
    private $ladoDos;

    //Metodos
    function __construct($l1, $l2)
    {
        $this->ladoUno = $l1;
        $this->ladoDos = $l2;
        $this->CalcularDatos();
    }

    protected function CalcularDatos()
    {
        $this->perimetro = 2*($this->ladoUno + $this->ladoDos);
        $this->superficie = ($this->ladoUno * $this->ladoDos);
    }

    public function Dibujar()
    {

    }

    public function __toString()
    {
        return parent::__toString().$this->Dibujar();
    }
}

?>