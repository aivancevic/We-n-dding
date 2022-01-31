<?php

class Profil extends Dbh {

    function getUserData(){
        $mojProfilQuery = 'SELECT KORISNICKI_PROFIL.ime, KORISNICKI_PROFIL.prezime, PRAVA_KORISNIKA.ime_prava, GRADOVI.ime_grada, DRZAVE.ime_drzave, REGISTRACIJA.email, KORISNICKI_PROFIL.broj_telefona FROM KORISNICKI_PROFIL INNER JOIN REGISTRACIJA ON KORISNICKI_PROFIL.login_ID = REGISTRACIJA.login_ID INNER JOIN DRZAVE ON KORISNICKI_PROFIL.drzava_ID = DRZAVE.drzava_ID INNER JOIN GRADOVI ON KORISNICKI_PROFIL.grad_ID = GRADOVI.grad_ID INNER JOIN PRAVA_KORISNIKA ON KORISNICKI_PROFIL.prava_ID = PRAVA_KORISNIKA.prava_ID WHERE KORISNICKI_PROFIL.login_ID = ?;';
        $stmt = $this->connect()->prepare($mojProfilQuery);

        if(!$stmt->execute(array($_SESSION["userid"])))
        {
            $stmt=null;
            header("location: ../../index.php?error=stmtfailed");
            exit();
        }
        if($stmt->rowCount()==0)
        {
            $stmt=null;
            header("location: ../../index.php?error=noData");
            exit();
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $_SESSION["prezimeUser2"] = $result[0]["prezime"];
        $_SESSION["imePravaUser"] = $result[0]["ime_prava"];
        $_SESSION["imeUser2"] = $result[0]["ime"];
        $_SESSION["imeGradaUser"] = $result[0]["ime_grada"];
        $_SESSION["imeDrzaveUser"] = $result[0]["ime_drzave"];
        $_SESSION["emailUser"] = $result[0]["email"];
        $_SESSION["brojTelefonaUser"] = $result[0]["broj_telefona"];

        $stmt = null;
    }     
}

?>