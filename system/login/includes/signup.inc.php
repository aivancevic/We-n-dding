<?php

if(isset($_POST["submit"]))
{
    //Uzme podatke nakon submita
    //$ime,$prez,$email,$tel,$uid,$pwd,$pwdrepeat,$nadi,$drzava,$grad,$posl
    $ime = $_POST["ime"];
    $prez = $_POST["prez"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];
    $nadi = $_POST["nadi"];
    $drzava = $_POST["drzava"];
    $grad = $_POST["grad"];
    //$spol = $_POST["spol"];
    $posl = $_POST["posl"];


    //Inicinra SignupContr klasu
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signup = new SignupContr($ime,$prez,$email,$tel,$uid,$pwd,$pwdrepeat,$nadi,$drzava,$grad,$posl);


    //Error handle i signup
    $signup->signupUser();

    //Na front page natrag
    header("location: ../../../index.php?page=login");

}