<?php
header("Content-Type: text/html; charset=UTF-8");
if (isset($_POST["opcio"])) {
    $opcio = $_POST["opcio"];
    switch($opcio){
        case "series" :
        {
            include_once("LlistatSeries.html");
            break;
        }
        case "temp" :
        {
            include_once("LlistatTemporades.html");
            break;

        }
        case "vallist" :
        {
            include_once("LlistatValoracions.html");
            break;

        }
        case "valTemp" :
        {
            include_once("ValorarTemporada.html");
            break;

        }
        case "unblock" :
        {
            echo "No implementar 'Desbloquejar a un usuari'";
            break;

        }
        default:
        {
            echo "Error";
            break;
        }       
    }
}
?>