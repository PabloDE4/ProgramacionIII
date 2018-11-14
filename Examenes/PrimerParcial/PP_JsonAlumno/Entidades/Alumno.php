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

        $file = 'alumnos.json';

        $datos_json = file_get_contents($file);
        $json_datos = json_decode($datos_json, true);

        $arrayDatos = array(
            'nombre' => $nuevoAlumno->nombre,
            'apellido' => $nuevoAlumno->apellido,
            'email' => $nuevoAlumno->email,
            'foto' => $nuevoAlumno->foto
        );

        $json_datos[] = $arrayDatos;
        $datosFinal = json_encode($json_datos);

        if (file_put_contents($file, $datosFinal)) {
            return true;
        }

        return $retorno;
    }

    public function ListadoAlumnos()
    {
        $file = 'alumnos.json';

        $json = file_get_contents($file);
        $json_output = json_decode($json, true);
        return $json_output;
    }

    public function consultarAlumno($apellido)
    {
        $retorno = "No existe el alumno: " . $apellido;

        $ListaDeAlumnos[] = Alumno::ListadoAlumnos();

        //var_dump($ListaDeAlumnos);

        for ($i = 0; $i < count($ListaDeAlumnos); $i++) {
            foreach ($ListaDeAlumnos[$i] as $obj) {
                if ($obj["apellido"] == $apellido) {
                    $retorno = "Alumno: " . $obj["nombre"] . ' ' . $obj["nombre"];
                }
            }
        }

        return $retorno;
    }


    public function modificarAlumno($nombre, $apellido, $foto, $email)
    {
        $ListaAlumnos = Alumno::ListadoAlumnos();
        $retorno = false;
        for ($i = 0; $i < count($ListaAlumnos); $i++) {
            foreach ($ListaAlumnos[$i] as $obj) {
                if (isset($obj["email"]) == $email) {

                    $obj["nombre"] = $nombre;
                    $obj["apellido"] = $apellido;

                }
                $retorno = true;

            }
        }

        return $retorno;
    }

}
?>