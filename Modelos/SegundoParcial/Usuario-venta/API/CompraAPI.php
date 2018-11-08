<?php
include_once("Entidades/Compra.php");

class CompraAPI extends Compra
{
    public function AltaCompra($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $files = $request->getUploadedFiles();
        $articulo = $parametros["articulo"];
        $precio = $parametros["precio"];
        $foto = $files["foto"];
 
        //Consigo la extensión de la foto.  
        $mediaType = $foto->getClientMediaType();
        $retorno = "";
        switch ($mediaType) {
            case "image/jpeg":
                $retorno = ".jpg";
                break;
            case "image/png":
                $retorno = ".jpg";
                break;
            default:
                $retorno = "ERROR";
                break;
        }

        $ext = $retorno;

        if ($ext != "ERROR") {
            //Genero el nombre de la foto.
            $nombreFoto = $articulo . "_Foto" . $ext;  

            //Guardo la foto.
            $rutaFoto = "./IMGCOMPRAS/" . $nombreFoto;
            $foto->moveTo($rutaFoto);

            $payload = $request->getAttribute("payload")["Payload"];
            $user = $payload->user;

            Compra::Insertar($articulo, $precio, $user);
            $respuesta = "Compra registrada con exito";
            $newResponse = $response->withJson($respuesta, 200);
            return $newResponse;
        } else {
            $respuesta = "Ocurrio un error.";
            $newResponse = $response->withJson($respuesta, 200);
            return $newResponse;
        }

    }

    public function TraerComprasUsuario($request, $response, $args)
    {
        $payload = $request->getAttribute("payload")["Payload"];

        $user = $payload->user;

        if ($payload->perfil->perfil == "admin") {
            $todos = Compra::ConsultarTodos();
            $newResponse = $response->withJson($todos, 200);
            return $newResponse;
        } else {
            $todos = Compra::ComprasUsuario($user);
            $newResponse = $response->withJson($todos, 200);
            return $newResponse;
        }
    }

}


?>