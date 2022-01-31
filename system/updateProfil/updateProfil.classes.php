<?php

class UpdateProfil extends Dbh {

   
    protected function KreirajUslugu($ime, $prez, $tel) {
        
        $updateQuery='UPDATE KORISNICKI_PROFIL SET ime = ?, prezime = ?, broj_telefona = ? WHERE login_ID = ?';

        $stmtku= $this->connect()->prepare($updateQuery);

        if(!$stmtku->execute(array($ime, $prez, $tel, $_SESSION["userid"])))
        {
            $stmtku=null;
            header("location: ../../index.php?error=stmtkufailed");
            exit();
        }           

        $stmtku = null;
    }
}