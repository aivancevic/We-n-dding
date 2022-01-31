<?php

class Login extends Dbh {


    protected function getUser($uid,$pwd) {
        $stmt = $this->connect()->prepare('SELECT lozinka FROM REGISTRACIJA WHERE korisnicko_ime = ?;');

        if(!$stmt->execute(array($uid)))
        {
            $stmt=null;
            header("location: ../../../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            header("location: ../../../index.php?page=usernotfound");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $checkPwd = password_verify($pwd, $pwdHashed[0]["lozinka"]);

        if($checkPwd == false)
        {
            $stmt=null;
            header("location: ../../../index.php?error=wrongpassword");
            exit();
        }
        elseif($checkPwd == true)
        {
            $stmt = $this->connect()->prepare('SELECT * FROM REGISTRACIJA WHERE korisnicko_ime = ? OR email = ? AND lozinka = ?;');

            if(!$stmt->execute(array($uid, $uid, $pwd)))
            {
                $stmt=null;
                header("location: ../../../index.php?error=stmtfailed");
                exit();
            }
            if($stmt->rowCount()==0)
            {
                $stmt=null;
                header("location: ../../../index.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            session_start();

            $_SESSION["userid"] = $user[0]["login_ID"];
            $_SESSION["useruid"] = $user[0]["korisnicko_ime"];

            $stmt = null;
        }


        $stmt = $this->connect()->prepare('SELECT KORISNICKI_PROFIL.ime, KORISNICKI_PROFIL.prezime, KORISNICKI_PROFIL.prava_ID FROM KORISNICKI_PROFIL WHERE KORISNICKI_PROFIL.login_ID = ?;');

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
        $_SESSION["imeUser"] = $result[0]["ime"];
        $_SESSION["prezimeUser"] = $result[0]["prezime"];
        $_SESSION["pravaUser"] = $result[0]["prava_ID"];

        $stmt = null;
        
        if($_SESSION["pravaUser"]==2){
            $pruzateljUslugeId = $this->connect()->prepare('SELECT PRUZATELJ_USLUGE.pruzatelj_usluge_ID FROM PRUZATELJ_USLUGE INNER JOIN KORISNICKI_PROFIL ON PRUZATELJ_USLUGE.korisnicki_profil_ID = KORISNICKI_PROFIL.korisnicki_profil_ID WHERE KORISNICKI_PROFIL.login_ID = ?;');
               
            if(!$pruzateljUslugeId->execute(array($_SESSION["userid"])))
                {
                $pruzateljUslugeId=null;
                header("location: ../../../index.php?error=pruzateljUslugeIdfailed");
                exit();
                }

            $izvadeniPruzateljUslugeId= $pruzateljUslugeId->fetchAll(PDO::FETCH_ASSOC);

            $tmp=$izvadeniPruzateljUslugeId[0]["pruzatelj_usluge_ID"];
            $tmpKorisnickiProfil=$izvadeniPruzateljUslugeId[0]["korisnicki_profil_ID"];

            $_SESSION["pruzatelj_usluge_ID"]=(int)$tmp;
            $_SESSION["korisnicki_profil_ID"]=(int)$tmpKorisnickiProfil;
            
                
            $pruzateljUslugeId=null;
        }
    }
}