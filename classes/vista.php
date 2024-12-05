<?php 

include_once ("taccesbd.php");

class Vista {
    private $abd;

    function __construct() {
        $this->abd = new TAccesbd(); 
    }

    function __destruct() {
        if (isset($this->abd)) {
            unset($this->abd);
        }
    }

    public function mostrarCapsalera($titol) {
        echo ('<!DOCTYPE HTML><html>
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title>' . $titol . '</title>
                    </head>
                    <body>
                        <center>
                        <br> <h1>' . $titol . '</h1><br><br>');
    }

    public function mostrarPeu() {
        echo ('<br><a href="../index.html"> Tornar </a></center></body></html>');
    }
    
    public function mostrarError ($missatge) {
        echo "<table bgcolor=grey align=center border = 1 cellpadding = 10>";
        echo "<tr><td><br><h2> $missatge </h2><br><br></td></tr>";
        echo "</table>";		
    }

    public function mostrarLlistatSeries($llistaSeries) {
        $this->abd->connectarBD();

        $res="<table border=1><tr bgcolor='lightgray'>
                            <th>Nom Serie</th>
                            <th>Any Creacio</th>
                            <th>Descripcio</th>
                            <th>Numero Temporades</th>
                            <th>Imatge</th>
                            <th>Valoracio Mitjana</th>";
        $res = $res . "</tr> ";
                        
        foreach ($llistaSeries as $serie) {
            $res = $res . "<tr>";
            $nomSerie = $serie["nomSerie"];
            $anyCreacio = $serie["anyCreacio"];
            $descripcio = $serie["descripcio"];
            $numTemporada = $serie["numTemporada"];
            $imatge = $serie["imatge"];
            $valoracioMitjana = $serie["valoracioMitjana"];
            
            $res = $res . "<td>$nomSerie</td>";
            $res = $res . "<td>$anyCreacio</td>";
            $res = $res . "<td>$descripcio</td>";
            $res = $res . "<td>$numTemporada</td>";
            $res = $res . "<td><img src=$imatge></td>";
            $res = $res . "<td>$valoracioMitjana</td>";
        }
        $res = $res . "</table>";
        echo ($res);
    
        $this->abd->tancarConsulta();
        $this->abd->desconnectarBD();
        return $res;
    }

    public function mostrarSelectorSeries ($llistaSeries) {
        $res = "<label for='serieDropdown'>Selecciona una sèrie:&nbsp;</label>";
        $res = $res . "<select id='serieDropdown' name='nomSerie'>";
        $res = $res . "<option selected='true' disabled='disabled'>Selecciona una opción</option>";
        
        foreach ($llistaSeries as $serie) {
            $res = $res . "<option value='" . $serie['nomSerie'] . "'>" . $serie['nomSerie'] . "</option>";
        }

        $res = $res . "</select>";
        echo ($res);
    }

    public function mostrarLlistatTemporades($llistatTemporades) {

        $res="<table border=1><tr bgcolor='lightgray'>
                            <th>Número temporada</th>
                            <th>Descripció</th>
                            <th>Imatge</th>
                            <th>Valoracio Mitjana</th>";
        $res = $res . "</tr> ";
                        
        foreach ($llistatTemporades as $temporada) {
            $res = $res . "<tr>";
            $numTemporada = $temporada["numTemporada"];
            $descripcio = $temporada["descripcio"];
            $imatge = $temporada["imatge"];
            $valoracioMitjana = $temporada["valoracioMitjana"];
            
            $res = $res . "<td>$numTemporada</td>";
            $res = $res . "<td>$descripcio</td>";
            $res = $res . "<td><img src=$imatge></td>";
            $res = $res . "<td>$valoracioMitjana</td>";
        }
        $res = $res . "</table>";
        echo ($res);
    }

    public function mostrarLlistatValoracions ($llistatValoracions){

        $res="<table border=1><tr bgcolor='lightgray'>
                            <th>Nom valorador</th>
                            <th>Cognom valorador</th>
                            <th>Fotografía</th>
                            <th>Valoració donada</th>
                            <th>Comentari</th>";
        $res = $res . "</tr> ";
                        
        foreach ($llistatValoracions as $valoracio) {
            $res = $res . "<tr>";
            $nomValorador = $valoracio["nomValorador"];
            $cognomValorador = $valoracio["cognomValorador"];
            $imatgeValorador = $valoracio["imatgeValorador"];
            $valor = $valoracio["valor"];
            $comentari = $valoracio["comentari"];
            
            $res .= "<td>$nomValorador</td>";
            $res .= "<td>$cognomValorador</td>";
            $res .= "<td>$imatgeValorador</td>";
            $res .= "<td>$valor</td>";
            $res .= "<td>$comentari</td>";
            $res .= "</tr>";
        }
        
        $res = $res . "</table>";
        echo ($res);
    }
}
?>
