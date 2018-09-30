<?php 

class Producto
{
    public $nombre;
    public $codBarra;

    function __construct($nomb, $codigo)
    {
        $this->nombre = $nomb;
        $this->codBarra = $codigo;
    }

    public function __toString()
    {
        return "$this->nombre-$this->codBarra";
    }

}
?>