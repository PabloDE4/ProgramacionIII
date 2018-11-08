<?php
class Inscripcion
{
    private $nombre;
    private $apellido;
    private $email;
    private $materia;
    private $codigo;

    function __construct($nombre, $apellido, $email, $materia, $codigo)
    {
        $this->nombre = strtolower($nombre);
        $this->apellido = strtolower($apellido);
        $this->email = strtolower($email);
        $this->materia = $materia;
        $this->codigo = $codigo;
    }

    public function __toString()
    {
        return $this->email . "-" . $this->nombre . "-" . $this->apellido . "-" . $this->materia . "-" . $this->codigo . PHP_EOL;
    }

    public function inscribirAlumno($nombre, $apellido, $email, $materia, $codigo)
    {
        $retorno = false;
        $nuevaInscripcion = new Inscripcion($nombre, $apellido, $email, $materia, $codigo);
        if (Materia::DescontarCupo($codigo)) {
            $ar = fopen("inscripciones.txt", "a");

            $cant = fwrite($ar, $nuevaInscripcion->__toString());

            if ($cant > 0) {
                $retorno = true;
            }
            fclose($ar);

            return $retorno;
        }
    }

    public function ListadoInscriptos()
    {
        $ListaInscriptos = array();

        $archivo = fopen("inscripciones.txt", "r");

        while (!feof($archivo)) {
            $archAux = fgets($archivo);

            $inscriptos = explode("-", $archAux);

            $inscriptos[0] = trim($inscriptos[0]);

            if ($inscriptos[0] != "") {
                $ListaInscriptos[] = new Inscripcion($inscriptos[0], $inscriptos[1], $inscriptos[2], $inscriptos[3], $inscriptos[4]);
            }
        }

        fclose($archivo);

        return $ListaInscriptos;
    }

    public function TablaInscriptos($apellido, $materia)
    {
        $ListaDeInscriptos = Inscripcion::ListadoInscriptos();
        $retorno = "";
        if ($apellido != null || $materia != null) {
            for ($i = 0; $i < count($ListaDeInscriptos); $i++) {
                if ($ListaDeInscriptos[$i]->apellido == $apellido || $ListaDeInscriptos[$i]->materia == $materia) {
                    $retorno = "<table> <tr>";
                    $retorno = $retorno . "<td>" . $ListaDeInscriptos[$i]->nombre . "</td>";
                    $retorno = $retorno . "<td>" . $ListaDeInscriptos[$i]->apellido . "</td>";
                    $retorno = $retorno . "<td>" . $ListaDeInscriptos[$i]->materia . "</td>";
                    $retorno = $retorno . "</tr></table> ";
                }
            }
        } else {

            $retorno = "<table> <tr>";

            for ($i = 0; $i < count($ListaDeInscriptos); $i++) {

                $retorno = $retorno . "<td>" . $ListaDeInscriptos[$i]->nombre . "</td>";
                $retorno = $retorno . "<td>" . $ListaDeInscriptos[$i]->apellido . "</td>";
                $retorno = $retorno . "<td>" . $ListaDeInscriptos[$i]->materia . "</td>";

            }
            $retorno = $retorno . "</tr></table> ";
        }
        return $retorno;
    }
}
?>