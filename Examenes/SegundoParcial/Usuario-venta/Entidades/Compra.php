<?php
include_once("AccesoDatos.php");

class Compra
{
    public $id;
    public $articulo;
    public $fecha;
    public $precio;
    public $foto;

    public function __toString()
    {
        return $this->id . " - " . $this->articulo . " - " . $this->precio . " - " . $this->usuario;
    }

    public static function Insertar($articulo, $precio, $user, $foto)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO compras (articulo, precio, usuario, foto) VALUES(:articulo, :precio, :user, :foto)");

        $consulta->bindValue(':articulo', $articulo, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $precio, PDO::PARAM_INT);
        $consulta->bindValue(':user', $user, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $foto, PDO::PARAM_STR);

        $consulta->execute();

    }

    public static function ComprasUsuario($user)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM compras WHERE usuario = :user");

        $consulta->bindValue(':user', $user, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, "Compra");
    }


    public static function ConsultarTodos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM compras");

        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, "Compra");
    }

    public static function Eliminar($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consultaFoto = $objetoAccesoDato->RetornarConsulta("SELECT foto FROM compras WHERE id = :id");
        $consultaFoto->bindValue(':id', $id, PDO::PARAM_INT);
        $consultaFoto->execute();
        $foto = $consultaFoto->fetch()["foto"];
        
        //borro la foto
        if ($foto != "") {
            unlink("./IMGCompras/$foto");
        }


        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM compras WHERE id = :id");

        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }

}