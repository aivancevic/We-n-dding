<?php
 session_start();

if(isset($_POST["submit"]))
{

    $tip_usluge = $_POST["tip_usluge"];
    $ime_prostora = $_POST["ime_prostora"];
    $kapacitet = $_POST["kapacitet"];
    $cijena = $_POST["cijena"];
    $tip_izvodaca = $_POST["tip_izvodaca"];
    $ime_glazbenog_sastava = $_POST["ime_glazbenog_sastava"];
    $vrsta_glazbe = $_POST["vrsta_glazbe"];
    $nacin_posluzivanja = $_POST["nacin_posluzivanja"];
    $ime_menija = $_POST["ime_menija"];
    $vrsta_dekoracije = $_POST["vrsta_dekoracije"];
    $ime_dekoracije = $_POST["ime_dekoracije"];
    $vrsta_medie = $_POST["vrsta_medie"];
    $ime_medie = $_POST["ime_medie"];
    $vrsta_ostalog = $_POST["vrsta_ostalog"];
    $ime_ostale_usluge = $_POST["ime_ostale_usluge"];

    $PUId=$_SESSION["pruzatelj_usluge_ID"];

    include "../login/classes/dbh.classes.php";
    include "./kreiranjeusluge.classes.php";
    include "./kreiranjeusluge.contr.php";



    $novuslu = new KretorUslugeContr($PUId, $tip_usluge, $ime_prostora, $kapacitet, $cijena, $tip_izvodaca, $ime_glazbenog_sastava, $vrsta_glazbe, $nacin_posluzivanja, $ime_menija, $vrsta_dekoracije, $ime_dekoracije, $vrsta_medie, $ime_medie, $vrsta_ostalog, $ime_ostale_usluge);

    $novuslu->KreirajVelikuUslugu();

    header("location: ../../index.php?error=none");
}