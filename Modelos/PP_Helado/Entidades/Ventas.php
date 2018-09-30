<?php

class Ventas
{
    public $mail;
    public $sabor;
    public $tipo;
    public $cantidad;

    public function __construct($mail, $sabor, $tipo, $cantidad)
    {
        $this->mail = $mail;
        $this->sabor = $sabor;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;

    }

    public function toString()
    {
        return $this->mail . "-" . $this->sabor . "-" . $this->tipo . "-" . $this->cantidad . "\r\n";
    }

    public function AltaVenta($mail, $sabor, $tipo, $cantidad)
    {
        if (Helado::ConsultarHelado($sabor, $tipo) == "Si hay") {
            $nuevaVenta = new Ventas($mail, $sabor, $tipo, $cantidad);

            $retorno = false;

            $ar = fopen("Venta.txt", "a");

            $cant = fwrite($ar, $nuevaVenta->toString());

            if ($cant > 0) {
                $retorno = true;
            }
            Helado::DescontarHelado($sabor, $tipo, $cantidad);
            return $retorno;
            fclose($ar);

        } else {
            echo "No hay de ese tipo o sabor. ";

        }
    }

    public function AltaVentaConImagen($mail, $sabor, $tipo, $cantidad)
    {
        if (Ventas::AltaVenta($mail, $sabor, $tipo, $cantidad)) {

            $retorno = false;

            $destino = "ImagenesDeLaVenta/";

            if (!file_exists($destino)) {
                mkdir($destino, 0777, true);
            }

            $tipoArchivo = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);

            if (getimagesize($_FILES["imagen"]["tmp_name"])[0] == 0) {
                echo "Error. El archivo debe ser una imagen";
            }
        //VERIFICO LA EXTENSION
            else if ($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "png") {
                echo "Solo extension JPG o PNG. ";
            }
        //VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR
            else if ($_FILES["imagen"]["size"] > 10485760) {

                echo "El archivo es demasiado grande. ";
            } else if (move_uploaded_file($_FILES["imagen"]["tmp_name"], "ImagenesDeLaVenta/" . $sabor . "" . date("d-m-y") . ".jpg")) {
                echo "Archivo subido correctamente. ";
                $retorno = true;
            }
        }
        return $retorno;

    }

    public function ListadoVentas()
    {
        $ListaDeVentas = array();

        $archivo = fopen("Venta.txt", "r");

        while (!feof($archivo)) {
            $archAux = fgets($archivo);

            $ventas = explode("-", $archAux);

            $ventas[0] = trim($ventas[0]);

            if ($ventas[0] != "") {
                $ListaDeVentas[] = new Ventas($ventas[0], $ventas[1], $ventas[2], $ventas[3]);
            }
        }

        fclose($archivo);
        return $ListaDeVentas;
    }

    public function TablaVentas($mail, $sabor)
    {
        $ListaDeVentas = Ventas::ListadoVentas();
        $retorno = "";
        if ($mail != null || $sabor != null) {
            for ($i = 0; $i < count($ListaDeVentas); $i++) {
                if ($ListaDeVentas[$i]->mail == $mail || $ListaDeVentas[$i]->sabor == $sabor) {
                    $retorno = "<table> <tr>";
                    $retorno = $retorno . '<td> <img src="' . "ImagenesDeLaVenta/" . $ListaDeVentas[$i]->sabor . date("d_m_y") . '.jpg"></td>';
                    $retorno = $retorno . "<td>" . $ListaDeVentas[$i]->mail . "</td>";
                    $retorno = $retorno . "<td>" . $ListaDeVentas[$i]->sabor . "</td>";
                    $retorno = $retorno . "<td>" . $ListaDeVentas[$i]->cantidad . "</td>";
                    $retorno = $retorno . "</tr></table> ";
                }
            }
        } else {

            $retorno = "<table> <tr>";

            for ($i = 0; $i < count($ListaDeVentas); $i++) {

                $retorno = $retorno . '<td> <img src="' . "ImagenesDeLaVenta/" . $ListaDeVentas[$i]->sabor . date("d_m_y") . '.jpg"></td>';
                $retorno = $retorno . "<td>" . $ListaDeVentas[$i]->mail . "</td>";
                $retorno = $retorno . "<td>" . $ListaDeVentas[$i]->sabor . "</td>";
                $retorno = $retorno . "<td>" . $ListaDeVentas[$i]->cantidad . "</td>";

            }
            $retorno = $retorno . "</tr></table> ";
        }
        return $retorno;
    }

}

?>