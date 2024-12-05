<?php
header("Content-Type: text/html;charset=utf-8");

//Classe CONTROL
include_once ("serie.php");
include_once ("GestioVista.php");

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
}
?>