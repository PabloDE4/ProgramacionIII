<?php

class Usuario
{
    private $nombre;
    private $clave;

    public function GetNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function GetClave($clave)
    {
        $this->clave = $clave;
    }

    function __construct($nombre, $clave)
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
    }

    public function __toString()
    {
        return "($this->nombre, $this->clave)";
    }

    function toJson($datos)
    {
        $carpeta = "../archivos/datos";

        //Si no existe, se crea la carpeta
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }        
        
        //Crear json
        $file = '../archivos/datos/datos.json';
        $contArchivo = file_put_contents($file, $datos);

        //Convierte un string codificado en JSON a una variable de PHP
        $datosUsuario = json_decode($contArchivo, true);

        $Array = array();

        array_push($Array, $datos);

        //Devuelve un string con la representación JSON de value.
        $JSON = json_encode($Array);

        return $JSON;
    }



}

?>