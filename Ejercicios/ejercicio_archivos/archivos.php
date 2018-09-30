<?php

class Archivos
{
    //FALTA QUE EL JSON SE ESCRIBA EN UNA TABLA HTML

    public function Subir($nombre)
    {
        $destino = "archivos/";
        $backup = "backup/";
        $tipoArchivo = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);

        //VERIFICO QUE SEA UNA IMAGEN
        if (getimagesize($_FILES["imagen"]["tmp_name"])[0] == 0) {
            echo "Error. El archivo debe ser una imagen";
        }
        //VERIFICO LA EXTENSION
        else if ($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif"
            && $tipoArchivo != "png") {
            echo "Solo extension JPG, GIF o PNG. ";
        }
        //VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR
        else if ($_FILES["imagen"]["size"] > 10485760) {

            echo "El archivo es demasiado grande. ";
        }
        //VERIFICO SI LA IMAGEN YA EXISTE
        else if (file_exists($destino . $nombre->__toString() . ".jpg")) {

        //SI LA IMAGEN YA EXISTE, LA RENOMBRO Y MANDO A LA CARPETA BACKUP
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $backup . $nombre->__toString() . date("d-m-y") . ".jpg")) {
                echo "Archivo subido a la carpeta Backup correctamente. ";
            }
        //SUBO LA IMAGEN
        } else if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino . $nombre->__toString() . ".jpg")) {
            echo "Archivo subido correctamente. ";
        }
    }


    function toJson($dato)
    {

        $carpeta = "./datos";

        //Si no existe, se crea la carpeta
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        //CREAR JSON
        $file = './datos/datos.json';

        $datos_json = file_get_contents($file);
        $json_datos = json_decode($datos_json, true);

        $arrayDatos = array(
            'nombre' => $dato->nombre,
            'codigo' => $dato->codBarra,
            'imagen' => $_FILES["imagen"]["tmp_name"],
        );

        $json_datos[] = $arrayDatos;
        $datosFinal = json_encode($json_datos);

        if (file_put_contents($file, $datosFinal)) {
            return true;
        }

    }

    public function crearTabla()
    {
        $file = './datos/datos.json';

        $data = file_get_contents($file);
        $json_datos = json_decode($data, true);

        $retorno = "";

        $retorno = "<table><tr>";
        foreach ($json_datos as $obj) {

            $retorno = $retorno . "<td>" . $obj['nombre'] . "</td>";
            $retorno = $retorno . "<td>" . $obj['codigo'] . "</td>";

        }
        $retorno = $retorno . "</tr></table> ";

        return $retorno;
    }

}

?>