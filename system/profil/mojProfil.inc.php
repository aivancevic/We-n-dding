<?php
    include "./system/login/classes/dbh.classes.php";
    include "./system/profil/mojprofil.classes.php";
    include "./system/profil/mojprofil.contr.php";

    $profil = new ProfilContr($_SESSION["userid"]);
    $profil->DohvatiProfil();
    
