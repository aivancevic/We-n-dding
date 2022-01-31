<?php

    include "./system/login/classes/dbh.classes.php";
    include "./system/PUO2/puo2.classes.php";
    include "./system/PUO2/puo2.contr.php";

    $prikazU = new PrikazUslugeContr();
    $prikazU->DohvatiUslugu();