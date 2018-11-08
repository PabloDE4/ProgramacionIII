<?php
include_once("AccesoDatos.php");

class Compra
{
    public $id;
    public $articulo;
    public $fecha;
    public $precio;

    public function __toString()
    {
        return $this->id . " - " . $this->articulo . " - " . $this->fecha . " - " . $this->precio;
    }

    public static function Insertar($articulo, $precio, $user)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO compras (articulo, precio, usuario)
                                                        VALUES(:articulo, :precio, :user)");

        $consulta->bindValue(':articulo', $articulo, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $precio, PDO::PARAM_INT);
        $consulta->bindValue(':user', $user, PDO::PARAM_INT);

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

}