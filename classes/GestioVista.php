<?php
header('Content-Type: text/html; charset=UTF-8');

include_once ("temporada.php");
include_once("valoracions.php");
include_once("Vista.php");

if (isset($_POST["opcio"])) {

    $opcio = $_POST["opcio"];
	$v = new Vista();
    switch ($opcio) {
        case 'Veure temporades': {
            if (isset($_POST["nomSerie"])) {
                $nomSerie = $_POST["nomSerie"];
                $t = new Temporada();
                $llistaTemporades = $t->llistatTemporades($nomSerie);

                $v->mostrarCapsalera("Llistat de temporades");
                $v->mostrarLlistatTemporades($llistaTemporades);
                $v->mostrarPeu();
            }
            break;
        }

        case 'Veure valoracions': {
            if (isset($_POST["nomSerie"]) and isset($_POST["numTemporada"])) {
                $nomSerie = $_POST["nomSerie"];
                $numTemporada = $_POST["numTemporada"];
                $t = new Valoracio();
                $llistaValoracions = $t->llistatValoracions($nomSerie, $numTemporada);

                $v->mostrarCapsalera("Llistat de valoracions de temporades");
                $v->mostrarLlistatValoracions($llistaValoracions);
                $v->mostrarPeu();
            }
            break;
        }
        
        case 'Valorar': {
            break;
        }
    }
}

?>