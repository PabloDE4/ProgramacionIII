<?php
include_once("AccesoDatos.php");

class Pedido
{

    public static function Registrar($id_mesa, $pedido, $cantidad, $importe, $mozo, $nombre_cliente, $sector)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        try {
            $codigo = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);

            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $fecha = date('Y-m-d');
            $hora_pedido = date('H:i');

            $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO pedido (codigo, id_mesa, pedido, cantidad, importe, fecha, hora_pedido, mozo, nombre_cliente, estadoPedido, sector) 
                                                                VALUES (:codigo, :id_mesa, :pedido, :cantidad, :importe, :fecha, :hora_pedido, :mozo, :nombre_cliente , 'Pendiente', :sector);");

            $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
            $consulta->bindValue(':id_mesa', $id_mesa, PDO::PARAM_STR);
            $consulta->bindValue(':pedido', $pedido, PDO::PARAM_STR);
            $consulta->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
            $consulta->bindValue(':importe', $importe, PDO::PARAM_INT);
            $consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);
            $consulta->bindValue(':hora_pedido', $hora_pedido, PDO::PARAM_STR);
            $consulta->bindValue(':mozo', $mozo, PDO::PARAM_STR);
            $consulta->bindValue(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
            $consulta->bindValue(':sector', $sector, PDO::PARAM_STR);
            $consulta->execute();

            $respuesta = array("Estado" => "OK", "Mensaje" => "Pedido registrado correctamente.", "Mesa" => $id_mesa, "Codigo" => $codigo);

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;

        }
    }

    public static function Cancelar($codigo)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedido SET estadoPedido = 'Cancelado' WHERE codigo = :codigo");

            $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);

            $consulta->execute();

            $respuesta = array("Estado" => "OK", "Mensaje" => "Pedido cancelado correctamente.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }


    public static function ListarTodos()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM pedido");

            $consulta->execute();

            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "Pedido");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }

    public static function ListarPendientes()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT codigo, hora_pedido, id_mesa, pedido, cantidad, importe, nombre_cliente, estadoPedido
                                                             FROM pedido WHERE estadoPedido = 'Pendiente'");
            $consulta->execute();

            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "Pedido");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }

    public static function ListarCancelados()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM pedido WHERE estadoPedido = 'Cancelado'");
            $consulta->execute();

            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "Pedido");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }

    public static function ListarPorMesa($codigo)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT estadoPedido, importe, id_mesa FROM pedido WHERE codigo = :codigo AND estadoPedido NOT IN ('Cancelado')");
            $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
            $consulta->execute();

            $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "Pedido");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }


    public static function TomarPedido($codigo, $encargado, $minutosEstimadosDePreparacion, $id_mesa)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $time = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
            $time->add(new DateInterval('PT' . $minutosEstimadosDePreparacion . 'M'));

            $hora_entrega_estimada = $time->format('H:i');

            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedido SET estadoPedido = 'En preparacion', 
                                                            hora_entrega_estimada = :hora_entrega_estimada, encargado_pedido = :encargado WHERE codigo = :codigo AND id_mesa = :id_mesa");

            $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
            $consulta->bindValue(':encargado', $encargado, PDO::PARAM_STR);
            $consulta->bindValue(':hora_entrega_estimada', $hora_entrega_estimada, PDO::PARAM_STR);
            $consulta->bindValue(':id_mesa', $id_mesa, PDO::PARAM_STR);

            $consulta->execute();

            $respuesta = array("Estado" => "OK", "Mensaje" => "Pedido tomado por: " . $encargado);
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }

    public static function InformarServir($codigo)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $time = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
            $hora_entrega = $time->format('H:i');

            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedido SET estadoPedido = 'Listo para servir', hora_entrega = :hora_entrega
                                                            WHERE codigo = :codigo");

            $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
            $consulta->bindValue(':hora_entrega', $hora_entrega, PDO::PARAM_STR);

            $consulta->execute();

            $respuesta = array("Estado" => "OK", "Mensaje" => "Pedido listo para servir.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }

    public static function Servir($codigo)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE pedido SET estadoPedido = 'Servido' 
                                                            WHERE codigo = :codigo");

            $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);

            $consulta->execute();

            $respuesta = array("Estado" => "OK", "Mensaje" => "Pedido servido correctamente.");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }

    public static function Cobrar($codigoMesa)
    {
        $pedidos = Pedido::ListarPorMesa($codigoMesa);

        $importeFinal = 0;
        foreach ($pedidos as $pedido) {
            $importeFinal += $pedido->importe;
            $id_mesa = $pedido->id_mesa;
        }

        Facturacion::Generar($importeFinal, $id_mesa);

        $resultado = array("Estado" => "OK", "Mensaje" => "Se ha cobrado a la mesa con exito.");

        return $resultado;
    }

    public static function TiempoRestante($codigo)
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT hora_entrega_estimada, estadoPedido as estado FROM pedido 
                                                            WHERE codigo = :codigo");

            $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
            $consulta->execute();
            $pedido = $consulta->fetch();

            if ($pedido["estado"] == 'En preparacion') {

                $time = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
                $hora_entrega = new DateTime($pedido["hora_entrega_estimada"], new DateTimeZone('America/Argentina/Buenos_Aires'));

                if ($time > $hora_entrega) {
                    $resultado = "Pedido retrasado.";
                } else {
                    $intervalo = $time->diff($hora_entrega);
                    $estimado = $intervalo->format('%H:%I:%S');
                    $resultado = "Tiempo estimado: " . $estimado;
                }
            } else {
                $resultado = "El pedido se encuentra: " . $pedido["estado"];
            }
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $resultado = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $resultado;
        }
    }

    public static function ListarFueraDelTiempoEstipulado()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT hora_pedido, hora_entrega_estimada, hora_entrega, id_mesa, nombre_cliente, encargado_pedido
                                                             FROM pedido WHERE hora_entrega_estimada < hora_entrega");


            $consulta->execute();

            $respuesta = $consulta->fetchAll(PDO::FETCH_CLASS, "Pedido");
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }

    public static function MasVendido()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT pedido, cantidad FROM pedido ORDER BY cantidad DESC");

            $consulta->execute();

            $respuesta = $consulta->fetchAll();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }

    public static function MenosVendido()
    {
        try {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

            $consulta = $objetoAccesoDato->RetornarConsulta("SELECT pedido, cantidad FROM pedido ORDER BY cantidad ASC");

            $consulta->execute();

            $respuesta = $consulta->fetchAll();
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $respuesta = array("Estado" => "ERROR", "Mensaje" => "$mensaje");
        }
        finally {
            return $respuesta;
        }
    }

}


?>