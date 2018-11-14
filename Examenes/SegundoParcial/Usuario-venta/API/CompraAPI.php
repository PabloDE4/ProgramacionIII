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
            $nombreFoto = $articulo . $ext;  

            //Guardo la foto.
            $rutaFoto = "./IMGCompras/" . $nombreFoto;

            $foto->moveTo($rutaFoto);

            $payload = $request->getAttribute("payload")["Payload"];
            $user = $payload->user;

            Compra::Insertar($articulo, $precio, $user, $nombreFoto);

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

    public function Borrar($request, $response, $args)
    {
        $id = $args["id"];
        $cantEliminados = Compra::Eliminar($id);
        if ($cantEliminados == 0) {
            $respuesta = "ERROR: No se encontraron coincidencias para eliminar.";
        } else {
            $respuesta = "Eliminado correctamente.";
        }
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

}


?>