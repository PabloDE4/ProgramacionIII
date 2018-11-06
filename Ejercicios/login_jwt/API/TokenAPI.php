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
        $tipoUser = Usuario::Login($user, $password);
        if ($tipoUser != "") {
            $token = Token::CodificarToken($user, $tipoUser);
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