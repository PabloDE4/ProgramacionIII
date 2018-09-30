<?php
class Punto
{
    private $_x;
    private $_y;

    function __construct($x, $y)
    {
        $this->_x = $x;
        $this->_y = $y;
    }

    function GetX()
    {
        return $this->_x;
    }

    function GetY()
    {
        return $this->_y;
    }

    public function __toString()
    {
        return "($this->_x,$this->_y)";
    }
}
?>