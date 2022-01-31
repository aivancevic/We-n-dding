<?php
 session_start();

if(isset($_POST["submit"]))
{
    $id_usluge =(int)$_POST["id_usluge"];
    $datum =$_POST["datum"];


    $PUId= $_SESSION["userid"];
 
    include "../login/classes/dbh.classes.php";
    include "./strez.classes.php";
    include "./strez.contr.php";

    $novuslu = new KretorUslugeContr($PUId, $id_usluge, $datum);

    $novuslu->KreirajVelikuUslugu();

    header("location: ../../index.php?page=pretraga");

    
}