<?php

    include "./system/login/classes/dbh.classes.php";
    include "./system/obavijesti/obavijesti.classes.php";
    include "./system/obavijesti/obavijesti.contr.php";
    
    $prikazU = new PrikazObavijestiContr($_SESSION["userid"]);
    $prikazU->DohvatiObavijesti();
    
