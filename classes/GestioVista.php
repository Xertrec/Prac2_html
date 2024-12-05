<?php
header('Content-Type: text/html; charset=UTF-8');

include_once ("temporada.php");
include_once("valoracions.php");
include_once("Vista.php");
?>
<center>
<?php

    if (isset($_POST["nomSerie"])) {
        ?>
        <title>Llistat de temporades</title>
        <?php
        $nomSerie = $_POST["nomSerie"];
        $t = new Temporada();
        $llistaTemporades = $t->llistatTemporades($nomSerie);
        $v = new Vista();
        $v->mostrarLlistatTemporades($llistaTemporades);
        echo '<br><a href="../index.html"> Tornar </a>';
    }

    if (isset($_POST["nomSerie_val"])){
        ?>
            <title>Llistat de valoracions de temporades</title>
        <?php
        $nomSerie_val = $_POST["nomSerie_val"];
        $numTemporada = $_POST["numTemporada"];
        $t = new Valoracio();
        $llistaValoracions = $t->llistatValoracions($nomSerie_val, $numTemporada);
        $v = new Vista();
        $v->mostrarLlistatValoracions($llistaValoracions);
        echo '<br><a href="../index.html"> Tornar </a>';
    }
?>
</center>
