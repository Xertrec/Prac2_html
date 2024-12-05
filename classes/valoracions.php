<?php

include_once ("taccesbd.php");

//Classe de MODEL encarregada de la gestió de la taula Temporada de la base de dades
class Valoracio {
    private $nomSerie;
    private $numTemporada;
    private $nomUsuari;
    private $valor;
    private $comentari;

    private $abd;
    
    function __construct() {
        $this->abd = new TAccesbd(); 
    }

    function __destruct() {
        if (isset($this->abd)) {
            unset($this->abd);
        }
    }

    public function llistatValoracions($nomSerie, $numTemporada) {
        $res = array();
        $this->abd->connectarBD();
        if ($this->abd->consultaSQL("SELECT * FROM valora WHERE nomSerie = '$nomSerie' AND numTemporada='$numTemporada'")) {
            $fila = $this->abd->consultaFila();
            $i = 0;
            while ($fila != null) {
                $res[$i]["nomSerie"] = $this->abd->consultaDada("nomSerie");
                $res[$i]["numTemporada"] = $this->abd->consultaDada("numTemporada");
                $res[$i]["nomUsuari"] = $this->abd->consultaDada("nomUsuari");
                $res[$i]["valor"] = $this->abd->consultaDada("valor");
                $res[$i]["comentari"] = $this->abd->consultaDada("comentari");
                
                $i++;
                $fila = $this->abd->consultaFila();
            }
            $this->abd->tancarConsulta();
        }
        $this->abd->desconnectarBD();
        return $res; 
    }
}

?>