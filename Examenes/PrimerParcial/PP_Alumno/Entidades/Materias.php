<?php
class Materia
{
    private $nombre;
    private $codigo;
    private $cupo;
    private $aula;

    function __construct($nombre, $codigo, $cupo, $aula)
    {
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->cupo = $cupo;
        $this->aula = $aula;
    }

    public function __toString()
    {
        return $this->nombre . "-" . $this->codigo . "-" . $this->cupo . "-" . $this->aula . PHP_EOL;
    }

    public function cargarMateria($nombre, $codigo, $cupo, $aula)
    {
        $retorno = false;
        $nuevaMateria = new Materia($nombre, $codigo, $cupo, $aula);

        $ar = fopen("materias.txt", "a");

        $cant = fwrite($ar, $nuevaMateria->__toString());

        if ($cant > 0) {
            $retorno = true;
        }

        fclose($ar);

        return $retorno;
    }

    public function ListadoMaterias()
    {
        $ListaMaterias = array();

        $archivo = fopen("materias.txt", "r");

        while (!feof($archivo)) {
            $archAux = fgets($archivo);

            $materias = explode("-", $archAux);

            $materias[0] = trim($materias[0]);

            if ($materias[0] != "") {
                $ListaMaterias[] = new Materia($materias[0], $materias[1], $materias[2], $materias[3]);
            }
        }

        fclose($archivo);

        return $ListaMaterias;
    }

    public function DescontarCupo($codigo)
    {
        $ListaDeMaterias = Materia::ListadoMaterias();

        $retorno = false;

        for ($i = 0; $i < count($ListaDeMaterias); $i++) {
            if ($ListaDeMaterias[$i]->codigo == $codigo) {

                if ($ListaDeMaterias[$i]->cupo > 0) {
                    $ListaDeMaterias[$i]->cupo = $ListaDeMaterias[$i]->cupo - 1;
                    $retorno = true;
                } else {
                    echo "No hay cupo. ";
                    break;
                }
            }
            else {
                echo "No existe la materia. ";
            }
        }
        unlink("materias.txt");
        for ($i = 0; $i < count($ListaDeMaterias); $i++) {
            $nombre = $ListaDeMaterias[$i]->nombre;
            $codigo = $ListaDeMaterias[$i]->codigo;
            $cupo = $ListaDeMaterias[$i]->cupo;
            $aula = $ListaDeMaterias[$i]->aula;
            Materia::cargarMateria($nombre, $codigo, $cupo, $aula);

        }

        return $retorno;
    }

}
?>