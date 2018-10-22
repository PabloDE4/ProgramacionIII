<?php
include_once("./clases/usuarios.php");
include_once("./clases/accesoDatos.php");
$opcion = $_POST['opcion'];

if (isset($_POST["opcion"]) && !empty($_POST["opcion"])) {
    switch ($opcion) {
        case 'login':
            $email = $_POST["email"];
            $clave = $_POST["clave"];

            $unUsuario = usuario::traerUsuarioLogin($email, $clave);

            if ($unUsuario->clave == $clave) {
                echo "Bienvenido: " . $email;
            }
            else if (!$unUsuario) {
                echo "Email incorrecto.";
            }
            else {
                echo "Clave incorrecta.";
            }

            break;

        case 'altaUsuario':

            break;

        case 'modificarUsuario':

            break;

        case 'borrarUsuario':

            break;

        default:
            echo "Seleccione un caso";
            break;
    }
}

?>