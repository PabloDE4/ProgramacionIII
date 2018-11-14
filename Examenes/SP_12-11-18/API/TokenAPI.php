<?php
include_once("Entidades/Token.php");
include_once("Entidades/Usuario.php");
class TokenApi extends Token
{

    public function AltaUsuario($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $email = $parametros["email"];
        $clave = $parametros["clave"];
        $perfil = $parametros["perfil"];

        Usuario::Alta($email, $clave, $perfil);
        $respuesta = "Insertado Correctamente.";
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function GenerarToken($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $email = $parametros["email"];
        $clave = $parametros["clave"];
        $perfil = Usuario::Login($email, $clave);
        if ($perfil != "") {
            $token = Token::CodificarToken($email, $perfil);
            $respuesta = array("Estado" => "OK", "Mensaje" => "OK", "Token" => $token);
        } else {
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "Usuario o clave invalidos.");
        }
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function ListaUsuarios($request, $response, $args)
    {
        $respuesta = Usuario::ListarUsuarios();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

}

?>