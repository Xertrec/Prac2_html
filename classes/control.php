<?php
header("Content-Type: text/html;charset=utf-8");

//Classe CONTROL
include_once ("Serie.php");
include_once ("Temporada.php");
include_once("Valoracions.php");

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

	public function llistatTemporades($nomSerie) {
		$res = "";

		$t = new Temporada();
		$res = $t->llistatTemporades($nomSerie);

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