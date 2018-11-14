<?php
include_once("AccesoDatos.php");

class Historial
{
    public static function GuardarHistorial($email, $metodo, $ruta, $hora)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO historial (email,metodo,ruta,hora) 
                                                            VALUES (:email, :metodo, :ruta, :hora);");

        $consulta->bindValue(':email', $email, PDO::PARAM_STR);
        $consulta->bindValue(':metodo', $metodo, PDO::PARAM_STR);
        $consulta->bindValue(':ruta', $ruta, PDO::PARAM_STR);
        $consulta->bindValue(':hora', $hora, PDO::PARAM_STR);

        $consulta->execute();
    }

}
?>