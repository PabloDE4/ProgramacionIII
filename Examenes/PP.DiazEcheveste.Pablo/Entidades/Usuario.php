<?php

class Usuario
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
        move_uploaded_file($foto["tmp_name"], "UsuarioImagen/" . $this->foto);
    }

    public function __toString()
    {
        return $this->email . "-" . $this->nombre . "-" . $this->apellido . "-" . $this->foto . PHP_EOL;
    }

    public function crearUsuario($nombre, $apellido, $email, $foto)
    {
        $retorno = false;
        $nuevoUsuario = new Usuario($nombre, $apellido, $email, $foto);

        $ar = fopen("usuario.txt", "a");

        $cant = fwrite($ar, $nuevoUsuario->__toString());

        if ($cant > 0) {
            $retorno = true;
        }

        fclose($ar);

        return $retorno;
    }

    public function ListadoUsuarios()
    {
        $ListaUsuarios = array();

        $archivo = fopen("usuario.txt", "r");

        while (!feof($archivo)) {
            $archAux = fgets($archivo);

            $Usuario = explode("-", $archAux);

            $Usuario[0] = trim($Usuario[0]);

            if ($Usuario[0] != "") {
                $ListaUsuarios[] = new Usuario($Usuario[1], $Usuario[2], $Usuario[0], $Usuario[3]);
            }
        }

        fclose($archivo);

        return $ListaUsuarios;
    }

    public function buscarUsuario($apellido)
    {
        $retorno = "No existe usuario con apellido: " . $apellido;

        $ListaUsuarios = Usuario::ListadoUsuarios();

        //var_dump($ListaUsuarios);

        for ($i = 0; $i < count($ListaUsuarios); $i++) {
            if ($ListaUsuarios[$i]->apellido == $apellido) {
                $retorno = "Usuario:" . $ListaUsuarios[$i]->apellido;
            }
        }

        return $retorno;
    }

    public function Listar()
    {
        $ListaUsuarios = Usuario::ListadoUsuarios();
        $retorno = "<table> <tr>";

        for ($i = 0; $i < count($ListaUsuarios); $i++) {

            $retorno = $retorno . "<td>" . $ListaUsuarios[$i]->nombre . "</td>";
            $retorno = $retorno . "<td>" . $ListaUsuarios[$i]->apellido . "</td>";
            $retorno = $retorno . "<td>" . $ListaUsuarios[$i]->email . "</td>";

        }
        $retorno = $retorno . "</tr></table> ";
        return $retorno;
    }
    public function modificarUsuario($nombre, $apellido, $foto, $email)
    {
        $ListaUsuarios = Usuario::ListadoUsuarios();
        $retorno = false;
        for ($i = 0; $i < count($ListaUsuarios); $i++) {
            if ($ListaUsuarios[$i]->email == $email) {
                $ListaUsuarios[$i]->nombre = $nombre;
                $ListaUsuarios[$i]->apellido = $apellido;

                //COPIO IMAGEN VIEJA A BACKUP

                $nombre = "UsuarioImagen/" . $ListaUsuarios[$i]->email . ".jpg";
                $nuevoNombre = "backUpFotos/" . $ListaUsuarios[$i]->apellido . date("d_m_y") . ".jpg";
                rename($nombre, $nuevoNombre);           

                //ACTAULIZO LA NUEVA IMAGEN
                move_uploaded_file($_FILES["foto"]["tmp_name"], "UsuarioImagen/" . $ListaUsuarios[$i]->email . ".jpg");
     

                //ACTAULIZO LA NUEVA IMAGEN
                move_uploaded_file($_FILES["foto"]["tmp_name"], "UsuarioImagen/" . $ListaUsuarios[$i]->email . "_" . "Foto" . ".jpg");

                if ($ListaUsuarios != null) {
                    $ar = fopen("usuario.txt", "w");
                    for ($i = 0; $i < count($ListaUsuarios); $i++) {
                        fwrite($ar, $ListaUsuarios[$i]->__toString());
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