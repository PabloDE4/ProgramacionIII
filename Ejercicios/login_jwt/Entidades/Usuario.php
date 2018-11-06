<?php
include_once("accesoDatos.php");

class usuario
{
	public $usuario;
	public $tipo_usuario;

	public static function Login($user, $password)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT tu.tipo_usuario FROM usuario u 
		INNER JOIN tipo_usuario tu on u.id_tipo_usuario = tu.id_tipo_usuario 
		WHERE u.usuario = :user AND u.password = :password");

		$consulta->execute(array(":user" => $user, ":password" => $password));

		$resultado = $consulta->fetch();
		return $resultado;
	}

	public static function ListarUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT u.usuario, tu.tipo_usuario FROM usuario u 
		INNER JOIN tipo_usuario tu on u.id_tipo_usuario = tu.id_tipo_usuario");

		$consulta->execute();

		$resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
		return $resultado;
	}
}
?>