<?php

include_once ("taccesbd.php");

//Classe de MODEL encarregada de la gestió de la taula Temporada de la base de dades
class Temporada {
    private $nomSerie;
    private $numTemporada;
    private $descripcio;
    private $imatge;
    private $valoracioMitjana;

    private $abd;
    
    function __construct() {
        $this->abd = new TAccesbd(); 
    }

    function __destruct() {
        if (isset($this->abd)) {
            unset($this->abd);
        }
    }

    public function existeixTemporadaSerie($nomSerie, $numTemporada) {
        $res = false;
        $this->abd->connectarBD();

        if ($this->abd->consultaSQL("SELECT COUNT(*) FROM temporada WHERE nomSerie = '$nomSerie' AND numTemporada = '$numTemporada'")) {
            $res = $this->abd->existeixElement();
            $this->abd->tancarConsulta();
        }
        
        $this->abd->desconnectarBD();
        return $res; 
    }

    public function llistatTemporades($nomSerie) {
        $res = array();
        $this->abd->connectarBD();

        $consulta = "
            SELECT numTemporada, descripcio, imatge, valoracioMitjana 
            FROM temporada 
            WHERE nomSerie = '$nomSerie'
        ";
        if ($this->abd->consultaSQL($consulta)) {
            $fila = $this->abd->consultaFila();
            $i = 0;
            while ($fila != null) {
                $res[$i]["numTemporada"] = $this->abd->consultaDada("numTemporada");
                $res[$i]["descripcio"] = $this->abd->consultaDada("descripcio");
                $res[$i]["imatge"] = $this->abd->consultaDada("imatge");
                $res[$i]["valoracioMitjana"] = $this->abd->consultaDada("valoracioMitjana");
                
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