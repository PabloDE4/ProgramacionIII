<?php
class usuario
{
	public $id;
	public $nombre;
	public $email;
	public $clave;

	public static function traerUsuarioLogin($email, $clave)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from pruebaLogin WHERE email=?");
		$consulta->execute(array($email, $clave));
		$usuarioBuscado = $consulta->fetchObject('usuario');
		return $usuarioBuscado;
	}
}
?>