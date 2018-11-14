<?php
include_once("AccesoDatos.php");

class Historial
{
    public static function GuardarHistorial($usuario, $metodo, $ruta, $hora)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO historial (usuario,metodo,ruta,hora) 
                                                            VALUES (:idUsuario, :metodo, :ruta, :hora);");

        $consulta->bindValue(':idUsuario', $usuario, PDO::PARAM_STR);
        $consulta->bindValue(':metodo', $metodo, PDO::PARAM_STR);
        $consulta->bindValue(':ruta', $ruta, PDO::PARAM_STR);
        $consulta->bindValue(':hora', $hora, PDO::PARAM_STR);

        $consulta->execute();
    }

}
?>