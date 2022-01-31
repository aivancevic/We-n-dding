

<?php
//Ovaj file se moze izbrisat isto jer ne readi nista
    include "../classes/dbh.classes.php";
    include "../profil/mojprofilquery.php";

    $profil = new Profil();
    $profil->getUserData();

