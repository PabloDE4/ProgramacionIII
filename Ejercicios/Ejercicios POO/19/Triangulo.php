<?php
include_once("figuraGeometrica.php");

class Triangulo extends figuraGeometrica
{
    private $altura;
    private $base;

    //Metodos
    function __construct($b, $h)
    {
        $this->altura = $h;
        $this->base = $b;
        $this->CalcularDatos();
    }

    protected function CalcularDatos()
    {
        $this->perimetro = 2*$this->altura + $this->base;
        $this->superficie = ($this->altura * $this->base)/2;
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