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
        if ($this->existeixUsuari($nomUsuari) == false) {
            return "ERROR: Usuari desconegut";
        }

        if ($this->usuariBloquejat($nomUsuari) == true) {
            return "ERROR: Usuari bloquejat";
        }

        if ($this->comprovarCredencials($nomUsuari, $contrasenya) == false) {
            $this->incrementarErrors($nomUsuari);
            return "ERROR: Credencials incorrectes";
        }

        return "Login correcte";
    }

    public function existeixUsuari($nomUsuari) {
        $this->abd->connectarBD();

        $consulta = "
            SELECT COUNT(*) FROM USUARI WHERE nomUsuari='$nomUsuari'
        ";

        $res = $this->abd->consultaUnica($consulta) == 1;
        $this->abd->desconnectarBD();
        return ($res);
    }

    public function usuariBloquejat($nomUsuari) {
        $this->abd->connectarBD();

        $consulta = "
            SELECT numeroErrorsLogin FROM USUARI WHERE nomUsuari='$nomUsuari'
        ";

        $res = $this->abd->consultaUnica($consulta) >= 3;
        $this->abd->desconnectarBD();
        return ($res);
    }

    public function comprovarCredencials($nomUsuari, $contrasenya) {
        $this->abd->connectarBD();

        $consulta = "
            SELECT COUNT(*) FROM USUARI 
            WHERE nomUsuari='$nomUsuari' AND contrasenya='$contrasenya'
        ";

        $res = $this->abd->consultaUnica($consulta) == 1;
        $this->abd->desconnectarBD();
        return ($res);
    }

    public function incrementarErrors($nomUsuari) {
        $this->abd->connectarBD();

        $consulta = "
            UPDATE USUARI SET numeroErrorsLogin = numeroErrorsLogin + 1 WHERE nomUsuari='$nomUsuari'
        ";

        $res = $this->abd->consultaSQL($consulta);
        $this->abd->desconnectarBD();
        return ($res);
    }
}

?>