<?php
include_once("Entidades/Token.php");
include_once("Entidades/Pedido.php");
include_once("Entidades/Mesa.php");

class PedidoAPI extends Pedido
{
    public function RegistrarPedido($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $id_mesa = $parametros["id_mesa"];
        $pedido = $parametros["pedido"];
        $cantidad = $parametros["cantidad"];
        $importe = $parametros["importe"];
        $nombre_cliente = $parametros["cliente"];
        $sector = $parametros["sector"];
        $payload = $request->getAttribute("payload")["Payload"];
        $mozo = $payload->nombre;

        $respuesta = Pedido::Registrar($id_mesa, $pedido, $cantidad, $importe, $mozo, $nombre_cliente, $sector);

        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function CancelarPedido($request, $response, $args)
    {
        $codigo = $args["codigo"];
        $respuesta = Pedido::Cancelar($codigo);
        Mesa::EstadoCerrada($codigo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function TomarPedidoPendiente($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $codigo = $parametros["codigo"];
        $minutosEstimados = $parametros["minutosEstimados"];
        $mesa = $parametros["mesa"];
        $payload = $request->getAttribute("payload")["Payload"];
        $encargado = $payload->nombre;
        $respuesta = Pedido::TomarPedido($codigo, $encargado, $minutosEstimados, $mesa);
        Mesa::EstadoEsperandoPedido($mesa);

        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function InformarPedidoListo($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $codigo = $parametros["codigo"];
        $respuesta = Pedido::InformarServir($codigo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }


    public function ServirPedido($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $codigo = $parametros["codigo"];
        $mesa = $parametros["mesa"];
        $respuesta = Pedido::Servir($codigo);
        Mesa::EstadoComiendo($mesa);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function CobrarPedido($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $codigo = $parametros["codigo"];
        $respuesta = Pedido::Cobrar($codigo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function TiempoRestantePedido($request, $response, $args)
    {
        $codigo = $args["codigoPedido"];
        $respuesta = Pedido::TiempoRestante($codigo);
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function ListarTodosPedidos($request, $response, $args)
    {
        $respuesta = Pedido::ListarTodos();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function ListarPedidosCancelados($request, $response, $args)
    {
        $respuesta = Pedido::ListarCancelados();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function ListarPedidoPendientes($request, $response, $args)
    {
        $respuesta = Pedido::ListarPendientes();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function ListarPedidosFueradeTiempo($request, $response, $args)
    {
        $respuesta = Pedido::ListarFueraDelTiempoEstipulado();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function LoMasVendido($request, $response, $args)
    {
        $respuesta = Pedido::MasVendido();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }

    public function LoMenosVendido($request, $response, $args)
    {
        $respuesta = Pedido::MenosVendido();
        $newResponse = $response->withJson($respuesta, 200);
        return $newResponse;
    }





}
?>