<?php

include_once ("taccesbd.php");

class Usuari {
    private $nomUsuari;
    private $contrasenya;
    private $tipus;
    private $errorsNum;

    private $abd;
    
    function __construct() {
        $this->abd = new TAccesbd(); 
    }

    function __destruct() {
        if (isset($this->abd)) {
            unset($this->abd);
        }
    }

    public function tipusUsuari($nomUsuari) {
        $this->abd->connectarBD();

        $consulta = "
            SELECT tipus FROM USUARI WHERE nomUsuari='$nomUsuari'
        ";

        $res = $this->abd->consultaUnica($consulta) != "Valorador";
        $this->abd->desconnectarBD();
        return ($res);
    }

    public function login($nomUsuari, $contrasenya) {
        // TODO
    }
}

?>