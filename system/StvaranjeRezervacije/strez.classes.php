<?php

class KreatorUsluga extends Dbh {

   
    protected function KreirajUslugu($PUId, $id_usluge, $datum) {
        
        $kojekuquery='SELECT KORISNIK_USLUGE.korisnik_usluge_ID FROM KORISNIK_USLUGE INNER JOIN KORISNICKI_PROFIL ON KORISNIK_USLUGE.korisnicki_profil_ID = KORISNICKI_PROFIL.korisnicki_profil_ID WHERE KORISNICKI_PROFIL.login_ID = ?;';

        $stmtku= $this->connect()->prepare($kojekuquery);

        if(!$stmtku->execute(array($PUId)))
        {
            $stmtku=null;
            header("location: ../../index.php?error=stmtkufailed");
            exit();
        }           

        $kojekurezultat =$stmtku->fetchAll(PDO::FETCH_ASSOC);

        $stmtku = null;

        $rezkoruid= $kojekurezultat[0]["korisnik_usluge_ID"];

        $kojepuquery='SELECT USLUGA.pruzatelj_usluge_ID FROM USLUGA WHERE USLUGA.usluga_ID = ?;';

        $stmtpu= $this->connect()->prepare($kojepuquery);

       
        if(!$stmtpu->execute(array($id_usluge)))
        {
            $stmtpu=null;
            header("location: ../../index.php?error=stmtpufailed");
            exit();
        }           

        $kojepurezultat =$stmtpu->fetchAll(PDO::FETCH_ASSOC);

        $stmtpu = null;

        $rezpruusid= $kojepurezultat[0]["pruzatelj_usluge_ID"];

        $stmt1 = $this->connect()->prepare('INSERT INTO REZERVACIJE(pruzatelj_usluge_ID, korisnik_usluge_ID, usluga_ID, datum_rezervacije)  VALUES(?, ?, ?, ?)');
          
        if(!$stmt1->execute(array($rezpruusid,$rezkoruid,$id_usluge, $datum))){
            $stmt1=null;
            header("location: ../../index.php?error=stmt1failed");
            exit();
        }
        $stmt1 = null;

        // Unos obavijesti
        $stmt1 = $this->connect()->prepare('SELECT KORISNICKI_PROFIL.korisnicki_profil_ID FROM KORISNICKI_PROFIL INNER JOIN PRUZATELJ_USLUGE ON KORISNICKI_PROFIL.korisnicki_profil_ID = PRUZATELJ_USLUGE.korisnicki_profil_ID WHERE PRUZATELJ_USLUGE.pruzatelj_usluge_ID = ?');

        if(!$stmt1->execute(array($rezpruusid))){
            $stmt1=null;
            header("location: ../../index.php?error=stmt1failed");
            exit();
        }

        $getKorisnickiProfilID =$stmt1->fetchAll(PDO::FETCH_ASSOC);
        $profilID = $getKorisnickiProfilID[0]["korisnicki_profil_ID"];

        $stmt1 = null;

        $stmt1 = $this->connect()->prepare('INSERT INTO OBAVIJESTI(korisnicki_profil_id, tekst_obavijesti, vrijeme) VALUES(?, ?, ?)');

        $tekstObavijesti = 'Imate novu rezervaciju!';
        $currentDateTime = date('Y-m-d H:i:s');
    
        if(!$stmt1->execute(array($profilID, $tekstObavijesti, $currentDateTime))){
            $stmt1=null;
            header("location: ../../index.php?error=stmtfailed");
            exit();
        }
        $stmt1 = null;
    }
}