<?php

    include "./system/login/classes/dbh.classes.php";
    include "./system/prikazUsluga2/prikazusluga2.classes.php";
    include "./system/prikazUsluga2/prikazusluga2.contr.php";
    
    $prikazU = new PrikazUslugeContr($_SESSION["pruzatelj_usluge_ID"]);
    $prikazU->DohvatiUslugu();
    
