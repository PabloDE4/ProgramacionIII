<?php

class Usuario
{
    public $nombre;
    public $clave;

    function __construct($nombre, $clave)
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
    }

    public function __toString()
    {
        return "($this->nombre, $this->clave)";
    }

    function toJson($usuario)
    {

        $carpeta = "../archivos/datos";

        //Si no existe, se crea la carpeta
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        //CREAR JSON
        $file = '../archivos/datos/datos.json';

        $datos_json = file_get_contents($file);
        $json_datos = json_decode($datos_json, true);

        $arrayDatos = array(
            'nombre' => $usuario->nombre,
            'clave' => $usuario->clave,
        );

        $json_datos[] = $arrayDatos;
        $datosFinal = json_encode($json_datos);

        if (file_put_contents($file, $datosFinal)) {
            return true;
        }


        /*  
        LEER EL JSON 

        $data = file_get_contents("datos.json");
        $json_datos = json_decode($data, true);

        foreach ($json_datos as $usuario) {
            echo $usuario."<br>";
        }
         */

    }



}

?>