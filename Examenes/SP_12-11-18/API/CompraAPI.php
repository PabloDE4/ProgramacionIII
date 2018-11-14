<?php
include_once("Entidades/Compra.php");

class CompraAPI extends Compra
{
    public function AltaCompra($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $files = $request->getUploadedFiles();
        $marca = $parametros["marca"];
        $modelo = $parametros["modelo"];
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

            $payload = $request->getAttribute("payload")["Payload"];
            $email = $payload->email;

            //Genero el nombre de la foto.
            $nombreFoto = $email . "_" . $marca . $modelo . $ext;  

            //Guardo la foto.
            $rutaFoto = "./IMGCompras/" . $nombreFoto;

            $foto->moveTo($rutaFoto);

            Compra::Insertar($marca, $modelo, $precio, $email, $nombreFoto);

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

        $perfil = $payload->perfil->perfil;
        $email = $payload->email;

        //var_dump($payload->perfil);

        if ($perfil == "admin") {
            $todos = Compra::ConsultarTodos();
            $newResponse = $response->withJson($todos, 200);
            return $newResponse;
        } else if ($perfil == "user") {
            $todos = Compra::ComprasUsuario($email);
            $newResponse = $response->withJson($todos, 200);
            return $newResponse;
        }
    }


    public function TraerMarcas($request, $response, $args)
    {
        $marca = $args['marca'];

        var_dump($marca);

        $respuesta = Compra::ConsultarMarca($marca);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;

    }

    public function TraerVentas($request, $response, $args)
    {
        $respuesta = Compra::ConsultarCompras();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;

    }

}


?>