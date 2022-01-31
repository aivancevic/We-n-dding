<?php
    session_start();

    if(isset($_POST["submit"]))
    {

        $ime = $_POST["ime"];
        $prez = $_POST["prez"];
        $tel = $_POST["tel"];
        // $drzava = $_POST["drzava"];
        // $grad = $_POST["grad"];

        include "../login/classes/dbh.classes.php";
        include "./updateProfil.classes.php";
        include "./updateProfil.contr.php";

        $updateProfil = new UpdateProfilContr($ime, $prez, $tel);

        $updateProfil->IzmjeniProfil();

        header("location: ../../index.php?page=mojProfil");

    }