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

        $file = 'materias.json';

        $datos_json = file_get_contents($file);
        $json_datos = json_decode($datos_json, true);

        $arrayDatos = array(
            'nombre' => $nuevaMateria->nombre,
            'codigo' => $nuevaMateria->codigo,
            'cupo' => $nuevaMateria->cupo,
            'aula' => $nuevaMateria->aula
        );

        $json_datos[] = $arrayDatos;
        $datosFinal = json_encode($json_datos);

        if (file_put_contents($file, $datosFinal)) {
            return true;
        }

        return $retorno;
    }

    public function ListadoMaterias()
    {
        $file = 'materias.json';

        $json = file_get_contents($file);
        $json_output = json_decode($json, true);
        return $json_output;
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