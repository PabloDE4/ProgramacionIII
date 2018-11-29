<?php
class MDWEmpleado
{
    public static function ValidarToken($request, $response, $next)
    {
        $token = $request->getHeader("token");
        $validacionToken = Token::DecodificarToken($token[0]);
        if ($validacionToken["Estado"] == "OK") {
            $request = $request->withAttribute("payload", $validacionToken);
            return $next($request, $response);
        } else {
            $newResponse = $response->withJson($validacionToken, 200);
            return $newResponse;
        }
    }

    public static function ValidarSocio($request, $response, $next)
    {
        $payload = $request->getAttribute("payload")["Payload"];

        if ($payload->perfil == "socio") {
            return $next($request, $response);
        } else {
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "Solo categoria socio.");
            $newResponse = $response->withJson($respuesta, 200);
            return $newResponse;
        }
    }

    public static function ValidarMozo($request, $response, $next)
    {
        $payload = $request->getAttribute("payload")["Payload"];
        $tipoEmpleado = $payload->perfil;
        if ($tipoEmpleado == "mozo" || $tipoEmpleado == "socio") {
            return $next($request, $response);
        } else {
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "No tienes permiso para realizar esta accion (Solo categoria mozo).");
            $newResponse = $response->withJson($respuesta, 200);
            return $newResponse;
        }
    }


}
?>