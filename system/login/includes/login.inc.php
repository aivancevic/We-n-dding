<?php

if(isset($_POST["submit"]))
{
    //Uzme podatke nakon submita
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];


    //Inicinra SignupContr klasu
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $login = new LoginContr($uid, $pwd);


    //Error handle i signup
    $login->loginUser();

    //Na front page natrag
    header("location: ../../../index.php?page=home");

}