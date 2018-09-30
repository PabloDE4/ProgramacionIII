<?php
/*
$destino = "archivos/" . $_FILES["imagen"]["name"];

var_dump($_FILES);

//SUBIR UNA IMAGEN
//move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);

//SI EL ARCHIVO YA EXISTE, LO PASO A LA CARPETA BACKUP

if (file_exists($destino)) {
    $nombreArchivo = pathinfo($destino, PATHINFO_BASENAME);
    rename($destino, "backup/" . date("d-m-y") . "-" . $nombreArchivo);
}

//CAMBIAR NOMBRE
$nuevoNombre = explode(".", $_FILES["imagen"]["name"]);
$nuevoNombre = array_reverse($nuevoNombre);

if (move_uploaded_file($_FILES["imagen"]["tmp_name"], "imagenes/" . $_POST["nombre"] . "-" . date("d-m-y") . "." . $nuevoNombre[0])) {
    echo "Imagen movida correctamente!";
}
 */

//VALIDAR FOTO
/*
if (filesize($_FILES["imagen"]["tmp_name"]) > 10485760) {
    echo "Error. El archivo debe pesar menos de 10 MB.";
    return false;
} else if (getimagesize($_FILES["imagen"]["tmp_name"])[0] == 0) {
    echo "Error. El archivo debe ser una imagen";
    return false;
}
return true;
 */

class Archivos
{
    //FALTA GUARDAR EN JSON y QUE SE ESCRIBA EN UNA TABLA HTML

    public function Subir($nombre)
    {

        $tipoArchivo = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
        $destino = "archivos/" . $_FILES["imagen"]["name"];

        $archivoTmp = $nombre. ".jpg";

        //VERIFICA QUE NO PESE MUCHO Y QUE SEA UNA IMAGEN
        if ($_FILES["imagen"]["size"] > 5000000) {
            echo "Error. El archivo debe pesar menos de 10 MB.";
            return false;
        } else if (getimagesize($_FILES["imagen"]["tmp_name"])[0] == 0) {
            echo "Error. El archivo debe ser una imagen";
            return false;
        }

        //SI EL ARCHIVO YA EXISTE, LO MUEVE A LA CARPETA BACKUP
        if (file_exists($destino)) {
            $nombreArchivo = pathinfo($destino, PATHINFO_BASENAME);
            rename($destino, "backup/" . date("d-m-y") . "-" . $nombreArchivo);
            echo "El archivo ya existe.";
        }

        //SUBE EL ARCHIVO
        /*
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino)) {
            echo "Archivo subido.";
        }
*/

        $nuevoNombre = explode(".", $_FILES["imagen"]["name"]);
        $nuevoNombre = array_reverse($nuevoNombre);

        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino . $_POST["nombre"] . $nuevoNombre[0])) {
            echo "Archivo subido.";
        }

    }
}

?>