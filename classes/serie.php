<?php

include_once ("taccesbd.php");

class Serie {
    private $nomSerie;
    private $anyCreacio;
    private $descripcio;
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

    public function llistatSeries() {
        $res = array();
        $this->abd->connectarBD();
    
        $consulta = "
            SELECT serie.nomSerie, anyCreacio, serie.descripcio, serie.imatge, serie.valoracioMitjana, max(temporada.numTemporada) AS max
            FROM serie INNER JOIN temporada ON serie.nomSerie = temporada.nomSerie
            GROUP BY serie.nomSerie
        ";
        if ($this->abd->consultaSQL($consulta)) {
            $fila = $this->abd->consultaFila();
            $i = 0;
            
            while ($fila != null) {
                $res[$i]["nomSerie"] = $this->abd->consultaDada("nomSerie");
                $res[$i]["anyCreacio"] = $this->abd->consultaDada("anyCreacio");
                $res[$i]["descripcio"] = $this->abd->consultaDada("descripcio");
                $res[$i]["imatge"] = $this->abd->consultaDada("imatge");
                $res[$i]["valoracioMitjana"] = $this->abd->consultaDada("valoracioMitjana");
                $res[$i]["numTemporada"] = $this->abd->consultaDada("max");
    
                $i++;
                $fila = $this->abd->consultaFila();
            }
        }
    
        $this->abd->tancarConsulta();
        $this->abd->desconnectarBD();
        return $res;
    }

    public function recalcularMitjanaSerie($nomSerie) {}
}

?>
