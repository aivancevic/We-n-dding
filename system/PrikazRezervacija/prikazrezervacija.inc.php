<?php

    include "./system/login/classes/dbh.classes.php";
    include "./system/PrikazRezervacija/prikazrezervacija.classes.php";
    include "./system/PrikazRezervacija/prikazrezervacija.contr.php";
    
    $prikazU = new PrikazUslugeContr($_SESSION["userid"]);
    $prikazU->DohvatiUslugu();
