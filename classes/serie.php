<?php
include_once ("taccesbd.php");
class Serie {
    private $nomSerie;
    private $anyCreacio;
    private $descripcio;
    private $valoracioMitjana;
    private $abd;

    function __construct()
    {
        $this->abd = new TAccesbd(); 
    }

    function __destruct() {
        if (isset($this->abd))
        {
        unset($this->abd);
        }
    }

    public function llistatSeries() {
        $res = array();
        $this->abd->connectarBD();
    
        if ($this->abd->consultaSQL("SELECT nomSerie, anyCreacio, descripcio, imatge, valoracioMitjana FROM serie"))
        {
            $fila = $this->abd->consultaFila();
            $i = 0;
            while ($fila != null)
            {
                $nomSerie = $this->abd->consultaDada("nomSerie");
                $res[$i]["nomSerie"] = $nomSerie;
                $res[$i]["anyCreacio"] = $this->abd->consultaDada("anyCreacio");
                $res[$i]["descripcio"] = $this->abd->consultaDada("descripcio");
                $res[$i]["imatge"] = $this->abd->consultaDada("imatge");
                $res[$i]["valoracioMitjana"] = $this->abd->consultaDada("valoracioMitjana");
    
                $i++;
                $fila = $this->abd->consultaFila();
            }
        }
    
        foreach ($res as $i => $serie)
        {
            $nomSerie = $serie["nomSerie"];
            $SQL_temporades = "SELECT COUNT(*) AS numTemporada FROM temporada WHERE nomSerie = '$nomSerie'";
            
            if ($this->abd->consultaSQL($SQL_temporades))
            {
                $fila_temporades = $this->abd->consultaFila();
                $quants = $this->abd->consultaDada("numTemporada");
                $res[$i]["numTemporada"] = $quants;
            }
        }
    
        $this->abd->tancarConsulta();
        $this->abd->desconnectarBD();
        return $res;
    }
}
?>
