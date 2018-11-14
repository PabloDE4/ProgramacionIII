<?php
include_once("AccesoDatos.php");
class Usuario
{
    public static function Login($email, $clave)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT u.id, u.perfil FROM usuarios u WHERE u.email = :email AND u.clave = :clave");

        $consulta->execute(array(":email" => $email, ":clave" => $clave));

        $resultado = $consulta->fetch();
        return $resultado;
    }

    public static function Alta($email, $clave, $perfil)
    {
        if ($perfil != "") {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (email,clave,perfil)
                                                                VALUES(:email, :clave, :perfil)");

            $consulta->bindValue(':email', $email, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
            $consulta->bindValue(':perfil', $perfil, PDO::PARAM_STR);

            $consulta->execute();
        } else {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (email,clave,perfil)
                                                                VALUES(:email, :clave, 'user')");

            $consulta->bindValue(':email', $email, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);

            $consulta->execute();
        }

    }

    public static function ListarUsuarios()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT u.email, u.perfil FROM usuarios u");

        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
        return $resultado;
    }
}
?>