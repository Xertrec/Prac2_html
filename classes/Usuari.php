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
        // TODO
    }

    public function login($nomUsuari, $contrasenya) {
        // TODO
    }
}

?>