<?php
include_once './Entidades/Historial.php';
class HistorialMiddleware
{
    public static function GenerarHistorial($request, $response, $next)
    {
        $respuesta = $next($request, $response);
        $payload = $request->getAttribute("payload")["Payload"];
        if ($payload != null) {
            $email = $payload->email;
        } else {
            $email = null;
        }
        $metodo = $request->getMethod();
        $ruta = $request->getUri();
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $hora = date('H:i');

        Historial::GuardarHistorial($email, $metodo, $ruta, $hora);
        return $respuesta;
    }
}
?>