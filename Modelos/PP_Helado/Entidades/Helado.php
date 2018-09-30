<?php

class Helado
{
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;

    public function __construct($sabor, $precio, $tipo, $cantidad)
    {
        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
    }

    public function ToString()
    {
        return $this->sabor . "-" . $this->precio . "-" . $this->tipo . "-" . $this->cantidad . "\r\n";
    }

    public function HeladoCarga($sabor, $precio, $tipo, $cantidad)
    {
        $retorno = false;
        $nuevoHelado = new Helado($sabor, $precio, $tipo, $cantidad);

        $ar = fopen("Helados.txt", "a");

        $cant = fwrite($ar, $nuevoHelado->ToString());

        if ($cant > 0) {
            $retorno = true;
        }

        fclose($ar);

        return $retorno;
    }

    public function ListadoHelados()
    {
        $ListaDeHelados = array();

        $archivo = fopen("Helados.txt", "r");

        while (!feof($archivo)) {
            $archAux = fgets($archivo);

            $helados = explode("-", $archAux);

            $helados[0] = trim($helados[0]);

            if ($helados[0] != "") {
                $ListaDeHelados[] = new Helado($helados[0], $helados[1], $helados[2], $helados[3]);
            }
        }

        fclose($archivo);

        return $ListaDeHelados;
    }

    public function ConsultarHelado($sabor, $tipo)
    {
        $retorno = "No hay sabor ni tipo";

        $ListaDeHelados = Helado::ListadoHelados();

        for ($i = 0; $i < count($ListaDeHelados); $i++) {

            if ($ListaDeHelados[$i]->sabor == $sabor) {
                $retorno = "Hay del sabor pero no del tipo";

                if ($ListaDeHelados[$i]->tipo == $tipo) {
                    $retorno = "Si hay";
                }
            }
        }
        return $retorno;
    }

    public function DescontarHelado($sabor, $tipo, $cant)
    {
        $ListaDeHelados = Helado::ListadoHelados();

        if (Helado::ConsultarHelado($sabor, $tipo) == "Si hay") {
            for ($i = 0; $i < count($ListaDeHelados); $i++) {
                if ($ListaDeHelados[$i]->sabor == $sabor && $ListaDeHelados[$i]->tipo == $tipo) {
                    $ListaDeHelados[$i]->cantidad = $ListaDeHelados[$i]->cantidad - $cant;
                    break;
                }
            }
        }
        unlink("Helados.txt");
        for ($i = 0; $i < count($ListaDeHelados); $i++) {
            $sabor = $ListaDeHelados[$i]->sabor;
            $precio = $ListaDeHelados[$i]->precio;
            $tipo = $ListaDeHelados[$i]->tipo;
            $cantidad = $ListaDeHelados[$i]->cantidad;
            Helado::HeladoCarga($sabor, $precio, $tipo, $cantidad);
        }
    }

    public function HeladoModificacion($sabor, $precio, $tipo, $cantidad)
    {
        $ListaDeHelados = Helado::ListadoHelados();
        $retorno = false;
        for ($i = 0; $i < count($ListaDeHelados); $i++) {
            if ($ListaDeHelados[$i]->sabor == $sabor && $ListaDeHelados[$i]->tipo == $tipo) {
                $ListaDeHelados[$i]->sabor = $sabor;
                $ListaDeHelados[$i]->tipo = $tipo;
                $ListaDeHelados[$i]->precio = $precio;
                $ListaDeHelados[$i]->cantidad = $cantidad;
                move_uploaded_file($_FILES["imagen"]["tmp_name"], "ImagenesDeLaVenta/" . $ListaDeHelados[$i]->sabor . date("d_m_y") . ".jpg");

                if ($ListaDeHelados != null) {
                    $ar = fopen("Helados.txt", "w");
                    for ($i = 0; $i < count($ListaDeHelados); $i++) {
                        fwrite($ar, $ListaDeHelados[$i]->ToString());
                    }
                    fclose($ar);
                }
                $retorno = true;
            }
        }
        return $retorno;
    }

    public function BorrarHelado($sabor, $tipo)
    {
        $ListaDeHelados = Helado::ListadoHelados();
        $retorno = false;
        for ($i = 0; $i < count($ListaDeHelados); $i++) {
            if ($ListaDeHelados[$i]->sabor == $sabor && $ListaDeHelados[$i]->tipo == $tipo) {
                $ListaDeHelados[$i]->sabor = "";
                $ListaDeHelados[$i]->tipo = "";
                $ListaDeHelados[$i]->precio = "";
                $ListaDeHelados[$i]->cantidad = "";

                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], "backUpFotos/" . date("d_m_y") . ".jpg")) {

                    unlink("ImagenesDeLaVenta/" . $ListaDeHelados[$i]->_sabor . date("d_m_y") . ".jpg");
                    echo "Archivo subido a la carpeta Backup correctamente. ";
                }

                if ($ListaDeHelados != null) {
                    $ar = fopen("Helados.txt", "w");
                    for ($i = 0; $i < count($ListaDeHelados); $i++) {
                        fwrite($ar, $ListaDeHelados[$i]->ToString());
                    }
                    fclose($ar);
                }
                $retorno = true;
            }
        }
        return $retorno;
    }

}

?>