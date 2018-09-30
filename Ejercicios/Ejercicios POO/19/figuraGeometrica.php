<?php

abstract class figuraGeometrica
{
    //Atributos
    protected $color;
    protected $perimetro;
    protected $superficie;

    //Metodos
    function __construct()
    {
        $this->color ="";
        $this->perimetro = 0;
        $this->superficie = 0;

    }

    function setColor($color)
    {
        $this->color = $color;
    }

    function getColor()
    {
        return $this->color;
    }

    protected abstract function CalcularDatos();
    public abstract function Dibujar();

    public function __toString()
    {       
        $info= "Perimetro: ".$this->perimetro;
        $info.= "<br/> Superficie: ".$this->superficie;
        $info.= "<br/> Color: ".$this->getColor() . "<br/>";
         
        return $info;
    }

}
?>