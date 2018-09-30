<?php

class Auto
{
    private $_color;
    private $_precio = 0;
    private $_marca;
    private $_fecha = null;

    function __construct($marca, $color, $precio = 0, $fecha = null)
    {
        $this->_color = $color;
        $this->_precio = $precio;
        $this->_marca = $marca;
        if ($fecha != null) {
            $this->_fecha = $fecha->format('Y-m-d');
        } else {
            $this->_fecha = $fecha;
        }
    }

    public function __Get($property)
    {
        return $this->$property;
    }
    
    //Método de instancia que recibirá un doble por parámetro y que se sumará al precio del objeto. 
    public function AgregarImpuestos($impuesto)
    {
        $this->_precio += $impuesto;
    }

    // Método de clase, recibirá un objeto de tipo “Auto” y mostrará todos los atributos de dicho objeto.
    public static function MostrarAuto($auto)
    {
        return "<br/>Color: " . $auto->__Get('_color') . "<br/>
        Precio: " . $auto->__Get('_precio') . "<br/>
        Marca: " . $auto->__Get('_marca') . "<br/>
        Fecha: " . $auto->__Get('_fecha') . "<br/>";
    }
    // Método de instancia que permita comparar dos objetos de tipo “Auto”. 
    //Sólo devolverá TRUE si ambos “Autos” son de la misma marca.
    public function Equals($auto2)
    {
        if ($this->__Get("_marca") == $auto2->__Get("_marca")) {
            return true;
        }
        return false;
    }

    // Método de clase, permite sumar dos objetos “Auto” (sólo si son de la misma marca, 
    // y del mismo color, de lo contrario informarlo) y que retorne un Double
    // con la suma de los precios o cero si no se pudo realizar la operación .
    public static function Add($autoUno, $autoDos)
    {
        if ($autoUno->Equals($autoDos) && $autoUno->__Get("_color") == $autoDos->__Get("_color")) {
            return $autoUno->__Get("_precio") + $autoDos->__Get("_precio");
        } else {
            return 0;
        }
    }

}

?>