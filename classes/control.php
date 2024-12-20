<?php
header("Content-Type: text/html;charset=utf-8");

//Classe CONTROL
include_once ("Serie.php");
include_once ("Temporada.php");
include_once("Valora.php");
include_once ("Usuari.php");
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

	public function llistatTemporades($nomSerie) {
		$res = "";

		$t = new Temporada();
		$res = $t->llistatTemporades($nomSerie);

		return($res);
	}

	public function llistatValoracions($nomSerie, $numTemporada) {
		$res = "";
		
		$v = new Valoracio();
		$res = $v->llistatValoracions($nomSerie, $numTemporada);

		if ($res == false) {
			$res = "ERROR: La sèrie no te aquesta temporada";
		}

		return($res);
	}

	public function valorarTemporada($nomSerie, $numTemporada, $nomUsuari, $contrasenya, $valor, $comentari) {
		$res = "";

		$v = new Valoracio();
		$res = $v->valorarTemporada($nomSerie, $numTemporada, $nomUsuari, $contrasenya, $valor, $comentari);
		
		return($res);
	}

	//___

	public function desbloquejarUsuari($nomUsuari, $contrasenya){
		$res = "";
		$u = new Usuari();
		$res = $u->desbloquejarUsuari($nomUsuari, $contrasenya);
		return($res);
	}

	public function llistatUsuariBloquejat() {
		$res = "";
		$u = new Usuari();
		$res = $u->llistatUsuariBloquejat();
		return($res);
	}

	public function desbloquejar($nomUsuari){
		$res = "";
		$u = new Usuari();
		$res = $u->desbloquejar($nomUsuari);
		return($res);
	}
}

?>