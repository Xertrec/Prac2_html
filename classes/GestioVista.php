<?php
header('Content-Type: text/html; charset=UTF-8');

include_once ("Control.php");
include_once("Vista.php");

if (isset($_POST["opcio"])) {

    $opcio = $_POST["opcio"];
	$v = new Vista();
    switch ($opcio) {
        case 'Veure temporades': {
            if (isset($_POST["nomSerie"])) {
                $nomSerie = $_POST["nomSerie"];

                $c = new Control();
                $llistaTemporades = $c->llistatTemporades($nomSerie);

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
                
                $k = new Control();
                $llistaValoracions = $k->llistatValoracions($nomSerie, $numTemporada);

                // Si es una string es el missatge d'error passat per Control
                if (is_string($llistaValoracions)) {
                    $v->mostrarError($llistaValoracions);
                } else {
                    $v->mostrarCapsalera("Llistat de valoracions de temporades");
                    $v->mostrarLlistatValoracions($llistaValoracions);
                }
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