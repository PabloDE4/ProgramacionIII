<?php
include_once("AccesoDatos.php");

class Compra
{
    public function __toString()
    {
        return $this->id . " - " . $this->articulo . " - " . $this->precio . " - " . $this->usuario;
    }

    public static function Insertar($marca, $modelo, $precio, $email, $foto)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO comprasusuario (marca,modelo, precio, email, foto) VALUES(:marca,:modelo, :precio, :email, :foto)");

        $consulta->bindValue(':marca', $marca, PDO::PARAM_STR);
        $consulta->bindValue(':modelo', $modelo, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $precio, PDO::PARAM_INT);
        $consulta->bindValue(':email', $email, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $foto, PDO::PARAM_STR);

        $consulta->execute();

    }

    public static function ComprasUsuario($email)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM comprasusuario WHERE email = :email");

        $consulta->bindValue(':email', $email, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, "Compra");
    }

    public static function ConsultarTodos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM comprasusuario");

        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, "Compra");
    }

    public static function ConsultarMarca($marca)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT DISTINCT modelo FROM comprasusuario WHERE marca = :marca");

        $consulta->bindValue(':marca', $marca, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, "Compra");
    }

    public static function ConsultarCompras()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT DISTINCT modelo, marca FROM comprasusuario");

        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, "Compra");
    }

}