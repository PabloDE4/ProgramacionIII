<?php
include_once("./Entidades/Usuario.php");
include_once("./Entidades/Mensaje.php");

$caso = $_POST['caso'];

if (isset($_POST["caso"]) && !empty($_POST["caso"])) {
    switch ($caso) {
        case 'crearUsuario':
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $email = $_POST["email"];
            $foto = $_FILES["foto"];

            $carga = Usuario::crearUsuario($nombre, $apellido, $email, $foto);
            if ($carga) {
                echo "Usuario Cargado";
            } else {
                echo "Error al cargar el Usuario";
            }
            break;

        case 'buscarUsuario':
            $apellido = $_GET["apellido"];
            $respuesta = Usuario::buscarUsuario($apellido);

            echo $respuesta;
            break;

        case 'listarUsuarios':

            echo Usuario::Listar();

            break;

        case 'cargarMensaje':
            $emailR = $_POST["emailR"];
            $emailD = $_POST["emailD"];
            $mensaje = $_POST["mensaje"];

            $carga = Mensaje::cargarMensaje($emailR, $emailD, $mensaje);
            if ($carga) {
                echo "Mensaje Cargado";
            } else {
                echo "Error al cargar el mensaje";
            }
            break;

        case 'mensajesRecibidos':
            $emailR = $_GET["emailR"];

            $respuesta = Mensaje::mensajesRecibidos($emailR);

            echo $respuesta;
            break;


        case 'mensajesEnviados':
            $emailD = $_GET["emailD"];

            $respuesta = Mensaje::mensajesEnviados($emailD);

            echo $respuesta;
            break;

        case 'modificarUsuario':
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $email = $_POST["email"];
            $foto = $_FILES["foto"];

            $carga = Usuario::modificarUsuario($nombre, $apellido, $foto, $email);

            if ($carga) {
                echo "Usuario modificado";
            } else {
                echo "Error al modificar Usuario";
            }
            break;

        case 'cargarMensajeImagen':
            $emailR = $_POST["emailR"];
            $emailD = $_POST["emailD"];
            $mensaje = $_POST["mensaje"];
            $foto = $_FILES["foto"];
            $carga = Mensaje::cargarMensajeImagen($emailR, $emailD, $mensaje, $foto);
            if ($carga) {
                echo "Mensaje cargada con imagen";
            } else {
                echo "Error al cargar Mensaje Con Imagen";
            }
            break;

        case 'mensajes':
            echo Mensaje::TablaMensajes();
            break;

        default:
            echo "Ese caso no esta definido";
            break;

    }

}
?>