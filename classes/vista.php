<?php 

include_once ("taccesbd.php");

class Vista{
    private $abd;

    function __construct() {
        $this->abd = new TAccesbd(); 
    }

    function __destruct() {
        if (isset($this->abd)) {
            unset($this->abd);
        }
    }

    public function mostrarLlistatSeries ($llistaSeries, $triar) {
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

    public function mostrarDropdownSeries ($llistaSeries) {
        $res = "<form action='./classes/GestioVista.php' method='POST'>";

        $res = $res . "<label for='serieDropdown'>Selecciona una sèrie:&nbsp;</label>";
        $res = $res . "<select id='serieDropdown' name='nomSerie'>";
        $res = $res . "<option selected='true' disabled='disabled'>Selecciona una opción</option>";
        
        foreach ($llistaSeries as $serie) {
            $res = $res . "<option value='" . $serie['nomSerie'] . "'>" . $serie['nomSerie'] . "</option>";
        }

        $res = $res . "</select>";

        $res = $res . "<input type='submit' value='Enviar'>";
        $res = $res . "</form>";
        echo ($res);
    }

    public function mostrarLlistatTemporades ($llistatTemporades) {
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<meta charset='utf-8'>";
        echo "<title>Llistat de temporades</title>";
        echo "</head>";
        echo "<body>";
        echo "<h1>Llistat de temporades</h1>";

        $res="<table border=1><tr bgcolor='lightgray'>
                            <th>Nom Serie</th>
                            <th>Número temporada</th>
                            <th>Descripció</th>
                            <th>Imatge</th>
                            <th>Valoracio Mitjana</th>";
        $res = $res . "</tr> ";
                        
        foreach ($llistatTemporades as $temporada) {
            $res = $res . "<tr>";
            $nomSerie = $temporada["nomSerie"];
            $numTemporada = $temporada["numTemporada"];
            $descripcio = $temporada["descripcio"];
            $imatge = $temporada["imatge"];
            $valoracioMitjana = $temporada["valoracioMitjana"];
            
            $res = $res . "<td>$nomSerie</td>";
            $res = $res . "<td>$numTemporada</td>";
            $res = $res . "<td>$descripcio</td>";
            $res = $res . "<td><img src=$imatge></td>";
            $res = $res . "<td>$valoracioMitjana</td>";
        }
        $res = $res . "</table>";
        echo ($res);
    }


    public function mostrarLlistatValoracions ($llistatValoracions){
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<meta charset='utf-8'>";
        echo "<title>Llistat de valoracions de temporades</title>";
        echo "</head>";
        echo "<body>";
        echo "<h1>Llistat de valoracions de temporades</h1>";

        $res="<table border=1><tr bgcolor='lightgray'>
                            <th>Nom Serie</th>
                            <th>Número temporada</th>
                            <th>Usuari</th>
                            <th>Puntuació</th>
                            <th>Comentari</th>";
        $res = $res . "</tr> ";
                        
        foreach ($llistatValoracions as $valoracio) {
            $res = $res . "<tr>";
            $nomSerie = $valoracio["nomSerie"];
            $numTemporada = $valoracio["numTemporada"];
            $nomUsuari = $valoracio["nomUsuari"];
            $valor = $valoracio["valor"];
            $comentari = $valoracio["comentari"];
            
            $res .= "<td>$nomSerie</td>";
            $res .= "<td>$numTemporada</td>";
            $res .= "<td>$nomUsuari</td>";
            $res .= "<td>$valor</td>";
            $res .= "<td>$comentari</td>";
            $res .= "</tr>";
        }
        $res = $res . "</table>";
        echo ($res);
    }

    public function mostrarDropdownValoracions ($llistaSeries) {
        $res = "<form action='./classes/GestioVista.php' method='POST'>";

        $res = $res . "<label for='valoracioDropdown'>Selecciona una sèrie:</label>";
        $res = $res . "<select id='valoracioDropdown' name='nomSerie_val'>";
        $res = $res . "<option selected='true' disabled='disabled'>Selecciona una opción</option>";

        foreach ($llistaSeries as $serie) {
            $res = $res . "<option value='" . $serie['nomSerie'] . "'>" . $serie['nomSerie'] . "</option>";
        }

        $res = $res . "</select>";


        $res = $res .  "<br><br><label for='numTemporada'>Número de temporada:</label>
                        <input type='number' id='numTemporada' name='numTemporada' required />";

        $res = $res . "<input type='submit' value='Enviar'>";
        $res = $res . "</form>";
        echo ($res);
    }

    public function mostrarQuestionariValorar ($llistaSeries) {
        $res = "<form action='./classes/GestioVista.php' method='POST'>";

        $res = $res . "<label for='serieDropdown'>Selecciona una sèrie: &nbsp;</label>";
        $res = $res . "<select id='serieDropdown' name='nomSerie'>";
        $res = $res . "<option selected='true' disabled='disabled'>Selecciona una opción</option>";
        
        foreach ($llistaSeries as $serie) {
            $res = $res . "<option value='" . $serie['nomSerie'] . "'>" . $serie['nomSerie'] . "</option>";
        }

        $res = $res . "</select>";
        $res = $res . "<br><br>";

        $res = $res . "<label for='numTemporada'>Nombre de temporada: &nbsp;</label>";
        $res = $res . "<input type='number' id='numTemporada' name='numTemporada' required />";
        $res = $res . "<br><br>";

        $res = $res . "<label for='nomUsuari'>Nom d'usuari: &nbsp;</label>";
        $res = $res . "<input type='text' id='nomUsuari' name='nomUsuari' required />";
        $res = $res . "<br><br>";

        $res = $res . "<label for='contrasenya'>Contrasenya: &nbsp;</label>";
        $res = $res . "<input type='text' id='contrasenya' name='contrasenya' required />";
        $res = $res . "<br><br>";

        $res = $res . "<label for='valoracio'>Valoració: &nbsp;</label>";
        $res = $res . "<input type='number' id='valoracio' name='valoracio' required />";
        $res = $res . "<br><br>";

        $res = $res . "<label for='comentari'>Comentari: &nbsp;</label>";
        $res = $res . "<input type='text' id='comentari' name='comentari' required />";
        $res = $res . "<br><br>";

        $res = $res . "<input type='submit' value='Enviar'>";
        $res = $res . "</form>";
        echo ($res);
    }
}
?>
