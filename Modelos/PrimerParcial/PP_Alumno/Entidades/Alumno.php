<?php

class Alumno
{
    public $nombre;
    public $apellido;
    public $email;
    public $foto;

    public function __construct($nombre, $apellido, $email, $foto)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->foto = $foto;

        //Divide el nombre de la foto en cada punto. Lo revierte para que la extensión quede en el índice cero. 
        $ext = array_reverse(explode(".", $foto["name"]));
        $this->foto = $this->email . "_" . "Foto." . $ext[0];    
        //Carga la foto.
        move_uploaded_file($foto["tmp_name"], "AlumnosImagen/" . $this->foto);
    }

    public function __toString()
    {
        return $this->email . "-" . $this->nombre . "-" . $this->apellido . "-" . $this->foto . PHP_EOL;
    }

    public function cargarAlumno($nombre, $apellido, $email, $foto)
    {
        $retorno = false;
        $nuevoAlumno = new Alumno($nombre, $apellido, $email, $foto);

        $ar = fopen("alumnos.txt", "a");

        $cant = fwrite($ar, $nuevoAlumno->__toString());

        if ($cant > 0) {
            $retorno = true;
        }

        fclose($ar);

        return $retorno;
    }

    public function ListadoAlumnos()
    {
        $ListaDeAlumnos = array();

        $archivo = fopen("alumnos.txt", "r");

        while (!feof($archivo)) {
            $archAux = fgets($archivo);

            $Alumnos = explode("-", $archAux);

            $Alumnos[0] = trim($Alumnos[0]);

            if ($Alumnos[0] != "") {
                $ListaDeAlumnos[] = new Alumno($Alumnos[1], $Alumnos[2], $Alumnos[0], $Alumnos[3]);
            }
        }

        fclose($archivo);

        return $ListaDeAlumnos;
    }

    public function consultarAlumno($apellido)
    {
        $retorno = "No existe alumno con apellido: " . $apellido;

        $ListaDeAlumnos = Alumno::ListadoAlumnos();

        //var_dump($ListaDeAlumnos);

        for ($i = 0; $i < count($ListaDeAlumnos); $i++) {
            if ($ListaDeAlumnos[$i]->apellido == $apellido) {
                $retorno = $ListaDeAlumnos[$i];
            }
        }

        return $retorno;
    }

    public function modificarAlumno($nombre, $apellido, $foto, $email)
    {
        $ListaAlumnos = Alumno::ListadoAlumnos();
        $retorno = false;
        for ($i = 0; $i < count($ListaAlumnos); $i++) {
            if ($ListaAlumnos[$i]->email == $email) {
                $ListaAlumnos[$i]->nombre = $nombre;
                $ListaAlumnos[$i]->apellido = $apellido;

                //FALTA MOVER LA IMAGEN VIEJA A LA CARPETA BACKUP
                /*
                copy('AlumnosImagen/[$ListaAlumnos[$i]->email . "_" . "Foto" . ".jpg"]', 'backUpFotos/[$ListaAlumnos[$i]->apellido . date("d_m_y") . ".jpg"]');

                move_uploaded_file($ListaAlumnos[$i]->foto, "backUpFotos/" . $ListaAlumnos[$i]->apellido . date("d_m_y") . ".jpg");
                */                

                //ACTAULIZO LA NUEVA IMAGEN

                move_uploaded_file($_FILES["foto"]["tmp_name"], "AlumnosImagen/" . $ListaAlumnos[$i]->email . "_" . "Foto" . ".jpg");

                echo "Archivo subido a la carpeta Backup correctamente. ";

                if ($ListaAlumnos != null) {
                    $ar = fopen("alumnos.txt", "w");
                    for ($i = 0; $i < count($ListaAlumnos); $i++) {
                        fwrite($ar, $ListaAlumnos[$i]->__toString());
                    }
                    fclose($ar);
                }
                $retorno = true;
            }
        }
        return $retorno;
    }


}


?>