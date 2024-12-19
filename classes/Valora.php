<?php

include_once("Usuari.php");
include_once("temporada.php");
include_once("serie.php");
include_once("taccesbd.php");

//Classe de MODEL encarregada de la gestió de la taula Temporada de la base de dades
class Valoracio {
    private $nomSerie;
    private $numTemporada;
    private $nomUsuari;
    private $valor;
    private $comentari;

    private $abd;
    
    function __construct() {
        $this->abd = new TAccesbd(); 
    }

    function __destruct() {
        if (isset($this->abd)) {
            unset($this->abd);
        }
    }

    public function llistatValoracions($nomSerie, $numTemporada) {
        $res = array();

        $t = new Temporada();
        if ($t->existeixTemporadaSerie($nomSerie, $numTemporada)) {
            $this->abd->connectarBD();

            $consulta = "
                SELECT v.valor, v.comentari, val.nom, val.cognoms, val.imatge
                FROM valora v
                JOIN valorador val ON v.nomUsuari = val.nomUsuari
                WHERE v.nomSerie='$nomSerie' AND v.numTemporada='$numTemporada'
            ";
            if ($this->abd->consultaSQL($consulta)) {
                $fila = $this->abd->consultaFila();
                $i = 0;
                while ($fila != null) {
                    $res[$i]["valor"] = $this->abd->consultaDada("valor");
                    $res[$i]["comentari"] = $this->abd->consultaDada("comentari");
                    $res[$i]["nomValorador"] = $this->abd->consultaDada("nom");
                    $res[$i]["cognomValorador"] = $this->abd->consultaDada("cognoms");
                    $res[$i]["imatgeValorador"] = $this->abd->consultaDada("imatge");

                    $i++;
                    $fila = $this->abd->consultaFila();
                }
                $this->abd->tancarConsulta();
            }

            $this->abd->desconnectarBD();
        } else {
            $res = false;
        }

        return $res; 
    }

    public function valorarTemporada($nomSerie, $numTemporada, $nomUsuari, $contrasenya, $valor, $comentari) {
        $t = new Temporada();
        if ($t->existeixTemporadaSerie($nomSerie, $numTemporada) == false) {
            return "ERROR: La sèrie no te aquesta temporada";
        }

        $u = new Usuari();
        $tipusUsuariRes = $u->tipusUsuari($nomUsuari);
        if (strpos($tipusUsuariRes, "ERROR") !== false) {
            return "ERROR: L'usuari no és valorador";
        }

        $loginRes = $u->login($nomUsuari, $contrasenya);
        if (strpos($loginRes, "ERROR") !== false) {
            // Ha ocurrit un error
            return $loginRes;
        }

        if ($this->comprovarValoracioFeta($nomSerie, $numTemporada, $nomUsuari) == true) {
            return "ERROR: Temporada ja valorada pel valorador";
        }
        
        $this->abd->connectarBD();
        $consulta = "
            INSERT INTO valora
            VALUES ('$nomSerie', '$numTemporada', '$nomUsuari', '$valor', '$comentari')
        ";
        if ($this->abd->consultaSQL($consulta) !== true) {
            // Mostrar error
            return "ERROR: No s'ha pogut valorar la temporada";
        }
        $this->abd->desconnectarBD();

        if ($t->recalcularMitjanaTemporada($nomSerie, $numTemporada) == false) {
            // Mostrar error
            return "ERROR: No s'ha recalcular la nota mitjana de la temporada";
        }

        $s = new Serie();
        if ($s->recalcularMitjanaSerie($nomSerie) == false) {
            // Mostrar error
            return "ERROR: No s'ha recalcular la nota mitjana de la serie";
        }
        
        return "Temporada valorada correctament";
    }

    public function comprovarValoracioFeta($nomSerie, $numTemporada, $nomUsuari) {
        $this->abd->connectarBD();

        $consulta = "
            SELECT COUNT(valor) 
            FROM valora 
            WHERE nomSerie = '$nomSerie' AND numTemporada = '$numTemporada' AND nomUsuari = '$nomUsuari'
        ";

        
        $res = $this->abd->consultaUnica($consulta) == 1;
        $this->abd->desconnectarBD();
        return ($res);
    }
}

?>