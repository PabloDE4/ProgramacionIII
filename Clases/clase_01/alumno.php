<?php

class Alumno
{
    public $legajo;
    public $nombre;

    function Saludar()
    {
        return "Hola! " . $this->nombre ." tu legajo es: ". $this->legajo;
    }
}

?>