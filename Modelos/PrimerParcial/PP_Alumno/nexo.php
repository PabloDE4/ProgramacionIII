<?php
include_once("./Entidades/Alumno.php");
include_once("./Entidades/Materias.php");
include_once("./Entidades/Inscripcion.php");
$caso = $_POST['caso'];

if (isset($_POST["caso"]) && !empty($_POST["caso"])) {
    switch ($caso) {
        case 'cargarAlumno':
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $email = $_POST["email"];
            $foto = $_FILES["foto"];

            $carga = Alumno::cargarAlumno($nombre, $apellido, $email, $foto);
            if ($carga) {
                echo "Alumno Cargado";
            } else {
                echo "Error al cargar el alumno";
            }
            break;

        case 'consultarAlumno':
            $apellido = $_POST["apellido"];
            $respuesta = Alumno::consultarAlumno($apellido);

            echo $respuesta;
            break;

        case 'cargarMateria':
            $nombre = $_POST["nombre"];
            $codigo = $_POST["codigo"];
            $cupo = $_POST["cupo"];
            $aula = $_POST["aula"];

            $carga = Materia::cargarMateria($nombre, $codigo, $cupo, $aula);
            if ($carga) {
                echo "Materia Cargada";
            } else {
                echo "Error al cargar materia";
            }
            break;

        case 'inscribirAlumno':
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $email = $_POST["email"];
            $materia = $_POST["materia"];
            $codigo = $_POST["codigo"];

            $carga = Inscripcion::inscribirAlumno($nombre, $apellido, $email, $materia, $codigo);
            if ($carga) {
                echo "Alumno inscripto";
            } else {
                echo "Error al inscribir al alumno";
            }
            break;

        case 'inscripciones':
            $apellido = $_POST['apellido'];
            $materia = $_POST['materia'];

            echo Inscripcion::TablaInscriptos($apellido, $materia);

            break;

        case 'modificarAlumno':
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $email = $_POST["email"];
            $foto = $_FILES["foto"];

            $carga = Alumno::modificarAlumno($nombre, $apellido, $foto, $email);

            if ($carga) {
                echo "Alumno modificado";
            } else {
                echo "Error al modificar alumno";
            }
            break;

        case 'alumnos':
            break;

        default:
            echo "Ese caso no esta definido";
            break;

    }
}
?>