<?php
include_once("Punto.php");
class RectanguloDos
{
    private $_vertice1;
    private $_vertice2;
    private $_vertice3;
    private $_vertice4;
    public $area;
    public $ladoDos;
    public $ladoUno;
    public $perimetro;

    function __construct($v1,$v3){
        $this->_vertice1 = $v1;
        $this->_vertice3 = $v3;
        $this->_vertice2 = new Punto($v1->GetX(),$v3->GetY());
        $this->_vertice4 = new Punto($v3->GetX(),$v1->GetY());
        
        $this->altura = $this->_vertice2->GetY() - $this->_vertice1->GetY();
        $this->base = $this->_vertice4->GetX() - $this->_vertice1->GetX();
        $this->perimetro = 2*($this->base + $this->altura);
        $this->area = $this->base * $this->altura;
    }


    function Dibujar()
    {
        $rectangulo = "";
        for ($i = 0; $i < $this->altura; $i++) {
            for ($j = 0; $j < $this->base; $j++) {
                $rectangulo = $rectangulo . "* ";
            }
            $rectangulo = $rectangulo . "<br/>";
        }
        $retorno = "<br/>V1: $this->_vertice1<br/>
        V1: $this->_vertice1<br/>
        V2: $this->_vertice2<br/>
        V3: $this->_vertice3<br/>
        V4: $this->_vertice4<br/>
        Altura: $this->altura<br/>
        Base: $this->base<br/>
        Perimetro: $this->perimetro<br/>
        Area: $this->area<br/>
        $rectangulo";

        return $retorno;
    }


}
?>