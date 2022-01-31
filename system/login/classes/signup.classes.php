<?php

class Signup extends Dbh {

    protected function setUser($ime,$prez,$email,$tel,$uid,$pwd,$pwdrepeat,$nadi,$drzava,$grad,$posl ) {
    
        if($nadi)
        {

            //Umetanje u tablicu: REGISTRACIJA
            $stmt3 = $this->connect()->prepare('INSERT INTO REGISTRACIJA(korisnicko_ime,lozinka,email)  VALUES(?, ?, ?)');

            $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);

            if(!$stmt3->execute(array($uid,$hashedPwd,$email)))
            {
                $stmt3=null;
                header("location: ../../../index.php?error=stmtfailed");
                exit();
            }
            $stmt3 = null;

            $sqldbLoginId = $this->connect()->prepare('SELECT login_ID FROM REGISTRACIJA WHERE korisnicko_ime = ?;');
            if(!$sqldbLoginId->execute(array($uid)))
            {
                $sqldbLoginId=null;
                header("location: ../../../index.php?error=sqldbLoginIdfailed");
                exit();
            }

            $resultId= $sqldbLoginId->fetchAll(PDO::FETCH_ASSOC);
            $sqldbLoginId=null;

            //Umetanje u KORISNICKI_PROFIL
            $stmt = $this->connect()->prepare('INSERT INTO KORISNICKI_PROFIL(prava_ID, login_ID, drzava_ID, grad_ID, ime, prezime, broj_telefona)  VALUES(?, ?, ?, ?, ?, ?, ?)');
 
            if(!$stmt->execute(array(1, $resultId[0]["login_ID"], $drzava, $grad, $ime, $prez, $tel)))
            {
                $stmt=null;
                header("location: ../../../index.php?error=stmtfailed");
                exit();
            }
            $stmt = null;

            $sqldbKorUslugeId = $this->connect()->prepare('SELECT korisnicki_profil_ID FROM KORISNICKI_PROFIL WHERE login_ID = ?;');
            if(!$sqldbKorUslugeId->execute(array( $resultId[0]["login_ID"])))
            {
                $sqldbKorUslugeId=null;
                header("location: ../../../index.php?error=sqldbKorUslugeIdfailed");
                exit();
            }

            $resultKorUslugeId= $sqldbKorUslugeId->fetchAll(PDO::FETCH_ASSOC);
            $sqldbKorUslugeId=null;

            //Umetanje u KORISNIK_USLUGE
            $stmt2 = $this->connect()->prepare('INSERT INTO KORISNIK_USLUGE(korisnicki_profil_ID, nadimak) VALUES(?, ?)');

            if(!$stmt2->execute(array($resultKorUslugeId[0]["korisnicki_profil_ID"], $nadi)))
            {
                $stmt2=null;
                header("location: ../../../index.php?error=stmtfailed");
                exit();
            }
            $stm2 = null;
        }
        else{


            $stmt3 = $this->connect()->prepare('INSERT INTO REGISTRACIJA(korisnicko_ime,lozinka,email)  VALUES(?, ?, ?)');

            $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);

            if(!$stmt3->execute(array($uid,$hashedPwd,$email)))
            {
                $stmt3=null;
                header("location: ../../../index.php?error=stmtfailed");
                exit();
            }
            $stmt3 = null;

            $sqldbLoginId = $this->connect()->prepare('SELECT login_ID FROM REGISTRACIJA WHERE korisnicko_ime = ?;');
            if(!$sqldbLoginId->execute(array($uid)))
            {
                  $sqldbLoginId=null;
                 header("location: ../../../index.php?error=sqldbLoginIdfailed");
                 exit();
            }

            $resultId= $sqldbLoginId->fetchAll(PDO::FETCH_ASSOC);
            $sqldbLoginId=null;


            $stmt = $this->connect()->prepare('INSERT INTO KORISNICKI_PROFIL(prava_ID, login_ID, drzava_ID, grad_ID, ime, prezime, broj_telefona)  VALUES(?, ?, ?, ?, ?, ?, ?)');

            if(!$stmt->execute(array(2, $resultId[0]["login_ID"], $drzava, $grad, $ime, $prez, $tel)))
            {
                $stmt=null;
                header("location: ../../../index.php?error=stmtfailed");
                exit();
            }
            $stmt = null;

            $sqldbKorUslugeId = $this->connect()->prepare('SELECT korisnicki_profil_ID FROM KORISNICKI_PROFIL WHERE login_ID = ?;');
            if(!$sqldbKorUslugeId->execute(array( $resultId[0]["login_ID"])))
            {
                $sqldbKorUslugeId=null;
                header("location: ../../../index.php?error=sqldbKorUslugeIdfailed");
                exit();
            }

            $resultKorUslugeId= $sqldbKorUslugeId->fetchAll(PDO::FETCH_ASSOC);
            $sqldbKorUslugeId=null;
           
            $stmt2 = $this->connect()->prepare('INSERT INTO PRUZATELJ_USLUGE(korisnicki_profil_ID, ime_poslovnog_subjekta) VALUES(?, ?)');

            if(!$stmt2->execute(array($resultKorUslugeId[0]["korisnicki_profil_ID"],$posl)))
            {
                $stmt2=null;
                header("location: ../../../index.php?error=stmtfailed");
                exit();
            }
            $stm2 = null;
        }
    }
        


    protected function checkUser($uid,$email) {
        $stmt = $this->connect()->prepare('SELECT korisnicko_ime FROM REGISTRACIJA WHERE korisnicko_ime = ? OR email = ?;');

        if(!$stmt->execute(array($uid, $email)))
        {
            $stmt=null;
            header("location: ../../../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck=null;
        if($stmt->rowCount()>0) {
            $resultCheck=false;

        }
        else{
            $resultCheck=true;
        }
        return $resultCheck;

    }
}