<?php
include_once("AccesoDatos.php");
class Usuario
{
    public static function Login($user, $clave)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT u.id, u.perfil FROM usuarios u WHERE u.nombre = :user AND u.clave = :clave");

        $consulta->execute(array(":user" => $user, ":clave" => $clave));

        $resultado = $consulta->fetch();
        return $resultado;
    }

    public static function Alta($user, $clave, $sexo, $perfil)
    {
        if ($perfil != "") {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (nombre,clave,sexo,perfil)
                                                                VALUES(:nombre, :clave, :sexo, :perfil)");

            $consulta->bindValue(':nombre', $user, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
            $consulta->bindValue(':sexo', $sexo, PDO::PARAM_STR);
            $consulta->bindValue(':perfil', $perfil, PDO::PARAM_STR);

            $consulta->execute();
        } else {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (nombre,clave,sexo,perfil)
                                                                VALUES(:nombre, :clave, :sexo, 'user')");

            $consulta->bindValue(':nombre', $user, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
            $consulta->bindValue(':sexo', $sexo, PDO::PARAM_STR);

            $consulta->execute();
        }

    }

    public static function ListarUsuarios()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT u.nombre, u.sexo, u.perfil FROM usuarios u");

        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
        return $resultado;
    }
}
?>