<?php
header("Content-Type: text/html;charset=utf-8");

//Classe CONTROL
include_once ("serie.php");
include_once("valoracions.php");
include_once ("GestioVista.php");
include_once("Vista.php");

class Control {
	
	function __construct() {
		// Res aquí
	}

	public function llistatSeries() {
		$res = "";

		$s = new Serie();
		$res = $s->llistatSeries();

		return($res);
	}

	public function llistatValoracions($nomSerie, $numTemporada) {
		$res = "";
		
		$val = new Valoracio();
		$res = $val->llistatValoracions($nomSerie, $numTemporada);

		if ($res == false) {
			$res = "ERROR: La sèrie no te aquesta temporada";
		}

		return($res);
	}
}

?>