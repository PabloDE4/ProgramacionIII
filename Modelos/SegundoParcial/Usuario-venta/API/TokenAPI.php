<?php
include_once("Entidades/Token.php");
include_once("Entidades/Usuario.php");
class TokenApi extends Token
{
    public function GenerarToken($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $user = $parametros["usuario"];
        $password = $parametros["password"];
        $perfil = Usuario::Login($user, $password);
        if ($perfil != "") {
            $token = Token::CodificarToken($user, $perfil);
            $respuesta = array("Estado" => "OK", "Mensaje" => "OK", "Token" => $token);
        } else {
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "Usuario o clave invalidos.");
        }
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function AltaUsuario($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $user = $parametros["nombre"];
        $clave = $parametros["clave"];
        $sexo = $parametros["sexo"];
        $perfil = $parametros["perfil"];

        Usuario::Alta($user, $clave, $sexo, $perfil);
        $respuesta = "Insertado Correctamente.";
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