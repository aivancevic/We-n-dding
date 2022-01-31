<?php

include "./system/login/classes/dbh.classes.php";
include "./system/drzaveGradovi/drzaveGradovi.classes.php";
include "./system/drzaveGradovi/drzaveGradovi.contr.php";

$drzave = new DrzaveContr();
$drzave->DohvatiImeDrzave();
    
