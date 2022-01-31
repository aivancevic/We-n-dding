<?php

if(isset($_POST["submit"]))
{     

    $id_usluge =(int)$_POST["id_usluge"];


    include "../login/classes/dbh.classes.php";
    include "./brisrez.classes.php";
    include "./brisrez.contr.php";


    $novuslu = new KretorUslugeContr($id_usluge);

    $novuslu->KreirajVelikuUslugu();

    //Na front page natrag
    header("location: ../../index.php?page=rezervacije");
    
}