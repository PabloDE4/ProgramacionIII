<?php

class Mensaje
{
    public $emailR;
    public $emailD;
    public $mensaje;

    public function __construct($emailR, $emailD, $mensaje)
    {
        $this->emailR = $emailR;
        $this->emailD = $emailD;
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return $this->emailR . "-" . $this->emailD . "-" . $this->mensaje . PHP_EOL;
    }

    public function cargarMensaje($emailR, $emailD, $mensaje)
    {
        $retorno = false;
        $nuevoMensaje = new Mensaje($emailR, $emailD, $mensaje);

        $ar = fopen("mensajes.txt", "a");

        $cant = fwrite($ar, $nuevoMensaje->__toString());

        if ($cant > 0) {
            $retorno = true;
        }

        fclose($ar);

        return $retorno;
    }

    public function ListadoMensajes()
    {
        $ListaMensaje = array();

        $archivo = fopen("mensajes.txt", "r");

        while (!feof($archivo)) {
            $archAux = fgets($archivo);

            $Mensaje = explode("-", $archAux);

            $Mensaje[0] = trim($Mensaje[0]);

            if ($Mensaje[0] != "") {
                $ListaMensaje[] = new Mensaje($Mensaje[0], $Mensaje[1], $Mensaje[2]);
            }
        }

        fclose($archivo);

        return $ListaMensaje;
    }

    public function mensajesRecibidos($emailR)
    {
        $retorno = "No hay mensajes ";

        $ListaMensajes = Mensaje::ListadoMensajes();

        //var_dump($ListaMensajes);

        for ($i = 0; $i < count($ListaMensajes); $i++) {
            if ($ListaMensajes[$i]->emailR == $emailR) {
                $retorno = $ListaMensajes[$i]->mensaje;
            }
        }

        return $retorno;
    }

    public function mensajesEnviados($emailD)
    {
        $retorno = "No hay mensajes ";

        $ListaMensajes = Mensaje::ListadoMensajes();

        //var_dump($ListaMensajes);

        for ($i = 0; $i < count($ListaMensajes); $i++) {
            if ($ListaMensajes[$i]->emailD == $emailD) {
                $retorno = $ListaMensajes[$i]->mensaje;
            }
        }

        return $retorno;
    }

    public function cargarMensajeImagen($emailR, $emailD, $mensaje, $foto)
    {
        Mensaje::cargarMensaje($emailR, $emailD, $mensaje);

        $retorno = false;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], "ImagenesDelMensaje/" . $emailR . "" . date("d-m-y") . ".jpg")) {
            $retorno = true;
        }

        return $retorno;
    }

    public function TablaMensajes()
    {
        $ListaMensajes = Mensaje::ListadoMensajes();

        //var_dump($ListaMensajes);

        $retorno = "";
        $retorno = "<table> <tr>";
        for ($i = 0; $i < count($ListaMensajes); $i++) {

            $retorno = $retorno . "<td>" . $ListaMensajes[$i] . "</td>";
            $retorno = $retorno . '<td> <img src="' . "ImagenesDelMensaje/" . $ListaMensajes[$i]->emailR . date("d_m_y") . '.jpg"></td>';

        }
        $retorno = $retorno . "</tr></table> ";
    //var_dump($retorno);    
        return $retorno;
    }


}

?>