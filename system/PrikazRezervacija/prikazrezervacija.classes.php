<?php

class Prikaz extends Dbh {
            
    function getUserUsluga($sesijskiuserid){

        $kojepravoquery='SELECT KORISNICKI_PROFIL.prava_ID FROM KORISNICKI_PROFIL WHERE KORISNICKI_PROFIL.login_ID = ?;';

        $stmtpravo= $this->connect()->prepare($kojepravoquery);       
       
        if(!$stmtpravo->execute(array($sesijskiuserid)))
        {
            $stmtpravo=null;
            header("location: ../../index.php?error=stmtpravofailed");
            exit();
        }     

        $kojepravorezultat =$stmtpravo->fetchAll(PDO::FETCH_ASSOC);

        $stmtpravo = null;

        $rezkojepravo= $kojepravorezultat[0]["prava_ID"];
        
        //1 korisnik
        //2 pruzatelj
        if($rezkojepravo==1){

            $kojekuquery='SELECT KORISNIK_USLUGE.korisnik_usluge_ID FROM KORISNIK_USLUGE INNER JOIN KORISNICKI_PROFIL ON KORISNIK_USLUGE.korisnicki_profil_ID = KORISNICKI_PROFIL.korisnicki_profil_ID WHERE KORISNICKI_PROFIL.login_ID = ?;';

            $stmtku= $this->connect()->prepare($kojekuquery);
    
           
           
            if(!$stmtku->execute(array($sesijskiuserid)))
            {
                $stmtku=null;
                header("location: ../../index.php?error=stmtkufailed");
                exit();
            }  

            $kojekurezultat =$stmtku->fetchAll(PDO::FETCH_ASSOC);
    
            $stmtku = null;
    
            $rezkoruid= $kojekurezultat[0]["korisnik_usluge_ID"];


            $kojekategorijequery='SELECT USLUGA.vrsta_usluge_ID FROM USLUGA INNER JOIN REZERVACIJE On USLUGA.usluga_ID = REZERVACIJE.usluga_ID WHERE REZERVACIJE.korisnik_usluge_ID = ? ORDER BY USLUGA.vrsta_usluge_ID ASC;'; // koje sve rez ima

            $stmtkategorije= $this->connect()->prepare($kojekategorijequery);

            $GLOBALS["nemaUsluga"] = "";
            if(!$stmtkategorije->execute(array($rezkoruid)))
            {
                $stmtkategorije=null;
                header("location: ../../index.php?error=stmtfailed");
                exit();
            }           

            if($stmtkategorije->rowCount()==0)
            {
                $stmtkategorije=null;
                $GLOBALS["nemaUsluga"] = "<h3>Nema dodanih rezervacija</h3>";
                // header("location: ../../index.php?error=noData");
                // exit();
            }
            if($GLOBALS["nemaUsluga"] != "<h3>Nema dodanih rezervacija</h3>"){
                $kojekategorijerezultat = $stmtkategorije->fetchAll(PDO::FETCH_ASSOC);

                $stmtkategorije = null;

                $prostorCount = 0;
                $glazbaCount = 0;
                $hranaCount = 0;
                $dekoracijaCount = 0;
                $mediaCount = 0;
                $ostaloCount = 0;

                $GLOBALS["rezprostor"] = "";
                $GLOBALS["rezglazba"] = "";
                $GLOBALS["rezhrana"] = "";
                $GLOBALS["rezdekoracija"] = "";
                $GLOBALS["rezmedia"] = "";
                $GLOBALS["rezostalo"] = "";


                foreach($kojekategorijerezultat as $kategorija){
                    if($kategorija["vrsta_usluge_ID"] == '1'){
                        $prostorCount++;
                    }
                    else if($kategorija["vrsta_usluge_ID"] == "2"){
                        $glazbaCount++;
                    }
                    else if($kategorija["vrsta_usluge_ID"] == "3"){
                        $hranaCount++;
                    }
                    else if($kategorija["vrsta_usluge_ID"] == "4"){
                        $dekoracijaCount++;
                    }
                    else if($kategorija["vrsta_usluge_ID"] == "5"){
                        $mediaCount++;
                    }
                    else if($kategorija["vrsta_usluge_ID"] == "6"){
                        $ostaloCount++;
                    }
                }

                if($prostorCount <> 0){
                $prostorquery='SELECT REZERVACIJE.rezervacije_ID, PROSTOR.ime_prostora, PROSTOR.kapacitet, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN PROSTOR ON USLUGA.redni_broj_usluge = PROSTOR.prostor_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 1 AND REZERVACIJE.korisnik_usluge_ID = ?;';

                $stmt1= $this->connect()->prepare($prostorquery);

                if(!$stmt1->execute(array($rezkoruid)))
                {
                    $stmt1=null;
                    header("location: ../../index.php?error=stmtfailed");
                    exit();
                }           

                if($stmt1->rowCount()==0)
                {
                    $stmt=null;
                    header("location: ../../index.php?error=noData");
                    exit();
                }        

                $prostorrezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                for($i = 0; $i < $prostorCount; $i++){
                    $GLOBALS["rezprostor"] .= '<div class="rezervacije-section-container-item">
                                                <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                                    <h2  class="rezervacije-section-container-item-title">'.$prostorrezultat[$i]["ime_prostora"].'(Prostor)</h2>
                                                        <div class="rezervacije-section-container-item-details">
                                                            <input type="hidden" name="id_usluge" value="'.$prostorrezultat[$i]["rezervacije_ID"].'"/>
                                                            <em>ID: '.$prostorrezultat[$i]["rezervacije_ID"].'</em>
                                                            <em>Kapacitet: '.$prostorrezultat[$i]["kapacitet"].'</em>
                                                            <em>Poslovni subjekt: '.$prostorrezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                            <em>Datum: '.$prostorrezultat[$i]["datum_rezervacije"].'</em>
                                                            <em>Cijena: '.$prostorrezultat[$i]["cijena_usluge"].'</em>
                                                            <button type="submit" name="submit">
                                                                    Otkaži
                                                            </button>
                                                        </div>
                                                </form>
                                                </div>';
                    }
                    $stmt1 = null;
                }


                if($glazbaCount <> 0){
                    $glazbaquery='SELECT REZERVACIJE.rezervacije_ID,  GLAZBA.ime_glazbenog_sastava, GLAZBA.tip_izvodaca,GLAZBA.vrsta_glazbe, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN GLAZBA ON USLUGA.redni_broj_usluge = GLAZBA.glazba_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 2 AND REZERVACIJE.korisnik_usluge_ID = ?;';

                    $stmt1= $this->connect()->prepare($glazbaquery);

                    if(!$stmt1->execute(array($rezkoruid)))
                    {
                        $stmt1=null;
                        header("location: ../../index.php?error=stmtfailed");
                        exit();
                    }           

                    if($stmt1->rowCount()==0)
                    {
                        $stmt=null;
                        header("location: ../../index.php?error=noData");
                        exit();
                    }        

                    $glazbarezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                    for($i = 0; $i < $glazbaCount; $i++){                                        
                        $GLOBALS["rezglazba"] .= '<div class="rezervacije-section-container-item">
                                                        <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                                        <h2  class="rezervacije-section-container-item-title">'.$glazbarezultat[$i]["ime_glazbenog_sastava"].' (Glazba)</h2>
                                                            <div class="rezervacije-section-container-item-details">
                                                                <input type="hidden" name="id_usluge" value="'.$glazbarezultat[$i]["rezervacije_ID"].'"/>
                                                                <em>ID: '.$glazbarezultat[$i]["rezervacije_ID"].'</em>
                                                                <em>Tip izvođača: '.$glazbarezultat[$i]["tip_izvodaca"].'</em>
                                                                <em>Vrsta glazbe: '.$glazbarezultat[$i]["vrsta_glazbe"].'</em>
                                                                <em>Poslovni subjekt: '.$glazbarezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                                <em>Datum: '.$glazbarezultat[$i]["datum_rezervacije"].'</em>
                                                                <em>Cijena: '.$glazbarezultat[$i]["cijena_usluge"].'</em>
                                                                <button type="submit" name="submit">
                                                                        Otkaži
                                                                </button>
                                                            </div>
                                                            </form>
                                                    </div>';
                    }
                    $stmt1 = null;
                }

                if($hranaCount <> 0){
                    $hranaquery='SELECT REZERVACIJE.rezervacije_ID, HRANA.nacin_posluzivanja, HRANA.ime_menija, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN HRANA ON USLUGA.redni_broj_usluge = HRANA.hrana_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 3 AND REZERVACIJE.korisnik_usluge_ID = ?;';

                    $stmt1= $this->connect()->prepare($hranaquery);

                    if(!$stmt1->execute(array($rezkoruid)))
                    {
                        $stmt1=null;
                        header("location: ../../index.php?error=stmtfailed");
                        exit();
                    }           

                    if($stmt1->rowCount()==0)
                    {
                        $stmt=null;
                        header("location: ../../index.php?error=noData");
                        exit();
                    }        

                    $hranarezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    for($i = 0; $i < $hranaCount; $i++){                                        
                    $GLOBALS["rezglazba"] .= '<div class="rezervacije-section-container-item">
                                            <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                            <h2  class="rezervacije-section-container-item-title"> '.$hranarezultat[$i]["ime_menija"].'(Hrana)</h2>
                                                <div class="rezervacije-section-container-item-details">
                                                    <input type="hidden" name="id_usluge" value="'.$hranarezultat[$i]["rezervacije_ID"].'"/>
                                                    <em>ID: '.$hranarezultat[$i]["rezervacije_ID"].'</em>
                                                    <em>Način posluživanja: '.$hranarezultat[$i]["nacin_posluzivanja"].'</em>
                                                    <em>Poslovni subjekt: '.$hranarezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                    <em>Datum: '.$hranarezultat[$i]["datum_rezervacije"].'</em>
                                                    <em>Cijena: '.$hranarezultat[$i]["cijena_usluge"].'</em>
                                                    <button type="submit" name="submit">
                                                            Otkaži
                                                    </button>
                                                </div>
                                                </form>
                                        </div>';

                    }
                    $stmt1 = null;
                }


                if($dekoracijaCount <> 0){
                    $dekoracijaquery='SELECT REZERVACIJE.rezervacije_ID,DEKORACIJA.vrsta_dekoracije, DEKORACIJA.ime_dekoracije, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN DEKORACIJA ON USLUGA.redni_broj_usluge = DEKORACIJA.dekoracija_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 4 AND REZERVACIJE.korisnik_usluge_ID= ?;';

                    $stmt1= $this->connect()->prepare($dekoracijaquery);

                    if(!$stmt1->execute(array($rezkoruid)))
                    {
                        $stmt1=null;
                        header("location: ../../index.php?error=stmtfailed");
                        exit();
                    }           

                    if($stmt1->rowCount()==0)
                    {
                        $stmt=null;
                        header("location: ../../index.php?error=noData");
                        exit();
                    }        

                    $dekoracijarezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    for($i = 0; $i < $dekoracijaCount; $i++){                                        
                        $GLOBALS["rezglazba"] .= '<div class="rezervacije-section-container-item">
                                                    <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                                    <h2  class="rezervacije-section-container-item-title"> '.$dekoracijarezultat[$i]["ime_dekoracije"].'(Dekoracija)</h2>
                                                        <div class="rezervacije-section-container-item-details">
                                                            <input type="hidden" name="id_usluge" value="'.$dekoracijarezultat[$i]["rezervacije_ID"].'"/>
                                                            <em>ID: '.$dekoracijarezultat[$i]["rezervacije_ID"].'</em>
                                                            <em>Vrsta dekoracije: '.$dekoracijarezultat[$i]["vrsta_dekoracije"].'</em>
                                                            <em>Poslovni subjekt: '.$dekoracijarezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                            <em>Datum: '.$dekoracijarezultat[$i]["datum_rezervacije"].'</em>
                                                            <em>Cijena: '.$dekoracijarezultat[$i]["cijena_usluge"].'</em>
                                                            <button type="submit" name="submit">
                                                                    Otkaži
                                                            </button>
                                                        </div>
                                                        </form>
                                                </div>';
                    }
                    $stmt1 = null;
                }



                if($mediaCount <> 0){
                    $mediaquery='SELECT REZERVACIJE.rezervacije_ID, MEDIJA.vrsta_medie, MEDIJA.ime_medie, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN MEDIJA ON USLUGA.redni_broj_usluge = MEDIJA.medija_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 5 AND REZERVACIJE.korisnik_usluge_ID = ?;';

                    $stmt1= $this->connect()->prepare($mediaquery);

                    if(!$stmt1->execute(array($rezkoruid)))
                    {
                        $stmt1=null;
                        header("location: ../../index.php?error=stmtfailed");
                        exit();
                    }           

                    if($stmt1->rowCount()==0)
                    {
                        $stmt=null;
                        header("location: ../../index.php?error=noData");
                        exit();
                    }        

                    $mediarezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    for($i = 0; $i < $mediaCount; $i++){
                    $GLOBALS["rezglazba"] .= '<div class="rezervacije-section-container-item">
                                            <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                            <h2  class="rezervacije-section-container-item-title"> '.$mediarezultat[$i]["ime_medie"].'(Medija)</h2>
                                                <div class="rezervacije-section-container-item-details">
                                                    <input type="hidden" name="id_usluge" value="'.$mediarezultat[$i]["rezervacije_ID"].'"/>
                                                    <em>ID: '.$mediarezultat[$i]["rezervacije_ID"].'</em>
                                                    <em>Vrsta medie: '.$mediarezultat[$i]["vrsta_medie"].'</em>
                                                    <em>Poslovni subjekt: '.$mediarezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                    <em>Datum: '.$mediarezultat[$i]["datum_rezervacije"].'</em>
                                                    <em>Cijena: '.$mediarezultat[$i]["cijena_usluge"].'</em>
                                                    <button type="submit" name="submit">
                                                            Otkaži
                                                    </button>
                                                </div>
                                                </form>
                                        </div>';
                    }
                    $stmt1 = null;
                }


                if($ostaloCount <> 0){
                    $ostaloquery='SELECT REZERVACIJE.rezervacije_ID, OSTALO.vrsta_ostalog, OSTALO.ime_ostale_usluge, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN OSTALO ON USLUGA.redni_broj_usluge = OSTALO.ostalo_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 6 AND REZERVACIJE.korisnik_usluge_ID = ?;';

                    $stmt1= $this->connect()->prepare($ostaloquery);

                    if(!$stmt1->execute(array($rezkoruid)))
                    {
                        $stmt1=null;
                        header("location: ../../index.php?error=stmtfailed");
                        exit();
                    }           

                    if($stmt1->rowCount()==0)
                    {
                        $stmt=null;
                        header("location: ../../index.php?error=noData");
                        exit();
                    }        

                    $ostalorezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    for($i = 0; $i < $ostaloCount; $i++){           
                    $GLOBALS["rezglazba"] .= '<div class="rezervacije-section-container-item">
                                                <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                                <h2  class="rezervacije-section-container-item-title">'.$ostalorezultat[$i]["ime_ostale_usluge"].'(Ostalo)</h2>
                                                    <div class="rezervacije-section-container-item-details">
                                                        <input type="hidden" name="id_usluge" value="'.$ostalorezultat[$i]["rezervacije_ID"].'"/>
                                                        <em>ID: '.$ostalorezultat[$i]["rezervacije_ID"].'</em>
                                                        <em>Vrsta ostalog: '.$ostalorezultat[$i]["vrsta_ostalog"].'</em>
                                                        <em>Poslovni subjekt: '.$ostalorezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                        <em>Datum: '.$ostalorezultat[$i]["datum_rezervacije"].'</em>
                                                        <em>Cijena: '.$ostalorezultat[$i]["cijena_usluge"].'</em>
                                                        <button type="submit" name="submit">
                                                                Otkaži
                                                        </button>
                                                    </div>
                                                    </form>
                                            </div>';
                    }
                    $stmt1 = null;
                }
            }

        }
        elseif($rezkojepravo==2){

            $kojepuquery='SELECT PRUZATELJ_USLUGE.pruzatelj_usluge_ID FROM PRUZATELJ_USLUGE INNER JOIN KORISNICKI_PROFIL ON PRUZATELJ_USLUGE.korisnicki_profil_ID = KORISNICKI_PROFIL.korisnicki_profil_ID WHERE KORISNICKI_PROFIL.login_ID = ?;';

            $stmtpu= $this->connect()->prepare($kojepuquery);
    
           
            if(!$stmtpu->execute(array($sesijskiuserid)))
            {
                $stmtpu=null;
                header("location: ../../index.php?error=stmtpufailed");
                exit();
            }  

            $kojepurezultat =$stmtpu->fetchAll(PDO::FETCH_ASSOC);
    
            $stmtpu = null;
    
            $rezpruusid= $kojepurezultat[0]["pruzatelj_usluge_ID"];


            $kojekategorijequery='SELECT USLUGA.vrsta_usluge_ID FROM USLUGA INNER JOIN REZERVACIJE On USLUGA.usluga_ID = REZERVACIJE.usluga_ID WHERE REZERVACIJE.pruzatelj_usluge_ID = ? ORDER BY USLUGA.vrsta_usluge_ID ASC;'; // koje sve rez ima

            $stmtkategorije= $this->connect()->prepare($kojekategorijequery);
            
            $GLOBALS["nemaUsluga"] = "";
            if(!$stmtkategorije->execute(array($rezpruusid)))
            {
                $stmtkategorije=null;
                header("location: ../../index.php?error=stmtfailed");
                exit();
            }           
            
            if($stmtkategorije->rowCount()==0)
            {
                
                $stmtkategorije=null;
                $GLOBALS["nemaUsluga"] = "<h3>Nema dodanih rezervacija</h3>";
            }        
            
            if($GLOBALS["nemaUsluga"] == ""){
                $kojekategorijerezultat = $stmtkategorije->fetchAll(PDO::FETCH_ASSOC);

                $stmtkategorije = null;

                $prostorCount = 0;
                $glazbaCount = 0;
                $hranaCount = 0;
                $dekoracijaCount = 0;
                $mediaCount = 0;
                $ostaloCount = 0;

                $GLOBALS["rezprostor"] = "";
                $GLOBALS["rezglazba"] = "";
                $GLOBALS["rezhrana"] = "";
                $GLOBALS["rezdekoracija"] = "";
                $GLOBALS["rezmedia"] = "";
                $GLOBALS["rezostalo"] = "";


                foreach($kojekategorijerezultat as $kategorija){
                    if($kategorija["vrsta_usluge_ID"] == '1'){
                        $prostorCount++;
                    }
                    else if($kategorija["vrsta_usluge_ID"] == "2"){
                        $glazbaCount++;
                    }
                    else if($kategorija["vrsta_usluge_ID"] == "3"){
                        $hranaCount++;
                    }
                    else if($kategorija["vrsta_usluge_ID"] == "4"){
                        $dekoracijaCount++;
                    }
                    else if($kategorija["vrsta_usluge_ID"] == "5"){
                        $mediaCount++;
                    }
                    else if($kategorija["vrsta_usluge_ID"] == "6"){
                        $ostaloCount++;
                    }
                }

                if($prostorCount <> 0){
                    $prostorquery='SELECT REZERVACIJE.rezervacije_ID, PROSTOR.ime_prostora, PROSTOR.kapacitet, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN PROSTOR ON USLUGA.redni_broj_usluge = PROSTOR.prostor_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 1 AND REZERVACIJE.pruzatelj_usluge_ID = ?;';

                    $stmt1= $this->connect()->prepare($prostorquery);

                    if(!$stmt1->execute(array($rezpruusid)))
                    {
                        $stmt1=null;
                        header("location: ../../index.php?error=stmtfailed");
                        exit();
                    }           

                    if($stmt1->rowCount()==0)
                    {
                        $stmt=null;
                        header("location: ../../index.php?error=noData");
                        exit();
                    }        

                    $prostorrezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    for($i = 0; $i < $prostorCount; $i++){
                        $GLOBALS["rezprostor"] .= '<div class="rezervacije-section-container-item">
                                                            <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                                            <h2  class="rezervacije-section-container-item-title">'.$prostorrezultat[$i]["ime_prostora"].'(Prostor)</h2>
                                                            <div class="rezervacije-section-container-item-details">
                                                                <input type="hidden" name="id_usluge" value="'.$prostorrezultat[$i]["rezervacije_ID"].'"/>
                                                                <em>ID: '.$prostorrezultat[$i]["rezervacije_ID"].'</em>
                                                                <em>Kapacitet: '.$prostorrezultat[$i]["kapacitet"].'</em>
                                                                <em>Poslovni subjekt: '.$prostorrezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                                <em>Datum: '.$prostorrezultat[$i]["datum_rezervacije"].'</em>
                                                                <em>Cijena: '.$prostorrezultat[$i]["cijena_usluge"].'</em>
                                                                <button type="submit" name="submit">
                                                                        Otkaži
                                                                </button>
                                                            </div>
                                                            </form>
                                                    </div>';
                    }


                    $stmt1 = null;
                }


                if($glazbaCount <> 0){
                    $glazbaquery='SELECT REZERVACIJE.rezervacije_ID,  GLAZBA.ime_glazbenog_sastava, GLAZBA.tip_izvodaca,GLAZBA.vrsta_glazbe, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN GLAZBA ON USLUGA.redni_broj_usluge = GLAZBA.glazba_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 2 AND REZERVACIJE.pruzatelj_usluge_ID = ?;';

                    $stmt1= $this->connect()->prepare($glazbaquery);

                    if(!$stmt1->execute(array($rezpruusid)))
                    {
                        $stmt1=null;
                        header("location: ../../index.php?error=stmtfailed");
                        exit();
                    }           

                    if($stmt1->rowCount()==0)
                    {
                        $stmt=null;
                        header("location: ../../index.php?error=noData");
                        exit();
                    }        

                    $glazbarezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                    for($i = 0; $i < $glazbaCount; $i++){                                        
                        $GLOBALS["rezglazba"] .= '<div class="rezervacije-section-container-item">
                                                        <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                                        <h2  class="rezervacije-section-container-item-title">'.$glazbarezultat[$i]["ime_glazbenog_sastava"].' (Glazba)</h2>
                                                            <div class="rezervacije-section-container-item-details">
                                                                <input type="hidden" name="id_usluge" value="'.$glazbarezultat[$i]["rezervacije_ID"].'"/>
                                                                <em>ID: '.$glazbarezultat[$i]["rezervacije_ID"].'</em>
                                                                <em>Tip izvođača: '.$glazbarezultat[$i]["tip_izvodaca"].'</em>
                                                                <em>Vrsta glazbe: '.$glazbarezultat[$i]["vrsta_glazbe"].'</em>
                                                                <em>Poslovni subjekt: '.$glazbarezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                                <em>Datum: '.$glazbarezultat[$i]["datum_rezervacije"].'</em>
                                                                <em>Cijena: '.$glazbarezultat[$i]["cijena_usluge"].'</em>
                                                                <button type="submit" name="submit">
                                                                        Otkaži
                                                                </button>
                                                            </div>
                                                            </form>
                                                    </div>';
                    }
                    $stmt1 = null;
                }

                if($hranaCount <> 0){
                    $hranaquery='SELECT REZERVACIJE.rezervacije_ID, HRANA.nacin_posluzivanja, HRANA.ime_menija, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN HRANA ON USLUGA.redni_broj_usluge = HRANA.hrana_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 3 AND REZERVACIJE.pruzatelj_usluge_ID= ?;';

                    $stmt1= $this->connect()->prepare($hranaquery);

                    if(!$stmt1->execute(array($rezpruusid)))
                    {
                        $stmt1=null;
                        header("location: ../../index.php?error=stmtfailed");
                        exit();
                    }           

                    if($stmt1->rowCount()==0)
                    {
                        $stmt=null;
                        header("location: ../../index.php?error=noData");
                        exit();
                    }        

                    $hranarezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    for($i = 0; $i < $hranaCount; $i++){                                        
                    $GLOBALS["rezglazba"] .= '<div class="rezervacije-section-container-item">
                                            <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                            <h2  class="rezervacije-section-container-item-title"> '.$hranarezultat[$i]["ime_menija"].'(Hrana)</h2>
                                                <div class="rezervacije-section-container-item-details">
                                                    <input type="hidden" name="id_usluge" value="'.$hranarezultat[$i]["rezervacije_ID"].'"/>
                                                    <em>ID: '.$hranarezultat[$i]["rezervacije_ID"].'</em>
                                                    <em>Način posluživanja: '.$hranarezultat[$i]["nacin_posluzivanja"].'</em>
                                                    <em>Poslovni subjekt: '.$hranarezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                    <em>Datum: '.$hranarezultat[$i]["datum_rezervacije"].'</em>
                                                    <em>Cijena: '.$hranarezultat[$i]["cijena_usluge"].'</em>
                                                    <button type="submit" name="submit">
                                                            Otkaži
                                                    </button>
                                                </div>
                                                </form>
                                        </div>';

                    }
                    $stmt1 = null;
                }


                if($dekoracijaCount <> 0){
                    $dekoracijaquery='SELECT REZERVACIJE.rezervacije_ID,DEKORACIJA.vrsta_dekoracije, DEKORACIJA.ime_dekoracije, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN DEKORACIJA ON USLUGA.redni_broj_usluge = DEKORACIJA.dekoracija_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 4 AND REZERVACIJE.pruzatelj_usluge_ID= ?;';

                    $stmt1= $this->connect()->prepare($dekoracijaquery);

                    if(!$stmt1->execute(array($rezpruusid)))
                    {
                        $stmt1=null;
                        header("location: ../../index.php?error=stmtfailed");
                        exit();
                    }           

                    if($stmt1->rowCount()==0)
                    {
                        $stmt=null;
                        header("location: ../../index.php?error=noData");
                        exit();
                    }        

                    $dekoracijarezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    for($i = 0; $i < $dekoracijaCount; $i++){                                        
                        $GLOBALS["rezglazba"] .= '<div class="rezervacije-section-container-item">
                                                    <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                                    <h2  class="rezervacije-section-container-item-title"> '.$dekoracijarezultat[$i]["ime_dekoracije"].'(Dekoracija)</h2>
                                                        <div class="rezervacije-section-container-item-details">
                                                            <input type="hidden" name="id_usluge" value="'.$dekoracijarezultat[$i]["rezervacije_ID"].'"/>
                                                            <em>ID: '.$dekoracijarezultat[$i]["rezervacije_ID"].'</em>
                                                            <em>Vrsta dekoracije: '.$dekoracijarezultat[$i]["vrsta_dekoracije"].'</em>
                                                            <em>Poslovni subjekt: '.$dekoracijarezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                            <em>Datum: '.$dekoracijarezultat[$i]["datum_rezervacije"].'</em>
                                                            <em>Cijena: '.$dekoracijarezultat[$i]["cijena_usluge"].'</em>
                                                            <button type="submit" name="submit">
                                                                    Otkaži
                                                            </button>
                                                        </div>
                                                        </form>
                                                </div>';
                    }
                    $stmt1 = null;
                }



                if($mediaCount <> 0){
                    $mediaquery='SELECT REZERVACIJE.rezervacije_ID, MEDIJA.vrsta_medie, MEDIJA.ime_medie, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN MEDIJA ON USLUGA.redni_broj_usluge = MEDIJA.medija_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 5 AND REZERVACIJE.pruzatelj_usluge_ID = ?;';

                    $stmt1= $this->connect()->prepare($mediaquery);

                    if(!$stmt1->execute(array($rezpruusid)))
                    {
                        $stmt1=null;
                        header("location: ../../index.php?error=stmtfailed");
                        exit();
                    }           

                    if($stmt1->rowCount()==0)
                    {
                        $stmt=null;
                        header("location: ../../index.php?error=noData");
                        exit();
                    }        

                    $mediarezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    for($i = 0; $i < $mediaCount; $i++){
                    $GLOBALS["rezglazba"] .= '<div class="rezervacije-section-container-item">
                                            <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                            <h2  class="rezervacije-section-container-item-title"> '.$mediarezultat[$i]["ime_medie"].'(Medija)</h2>
                                                <div class="rezervacije-section-container-item-details">
                                                    <input type="hidden" name="id_usluge" value="'.$mediarezultat[$i]["rezervacije_ID"].'"/>
                                                    <em>ID: '.$mediarezultat[$i]["rezervacije_ID"].'</em>
                                                    <em>Vrsta medie: '.$mediarezultat[$i]["vrsta_medie"].'</em>
                                                    <em>Poslovni subjekt: '.$mediarezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                    <em>Datum: '.$mediarezultat[$i]["datum_rezervacije"].'</em>
                                                    <em>Cijena: '.$mediarezultat[$i]["cijena_usluge"].'</em>
                                                    <button type="submit" name="submit">
                                                            Otkaži
                                                    </button>
                                                </div>
                                                </form>
                                        </div>';
                    }
                    $stmt1 = null;
                }


                if($ostaloCount <> 0){
                    $ostaloquery='SELECT REZERVACIJE.rezervacije_ID, OSTALO.vrsta_ostalog, OSTALO.ime_ostale_usluge, PRUZATELJ_USLUGE.ime_poslovnog_subjekta, REZERVACIJE.datum_rezervacije, USLUGA.cijena_usluge FROM REZERVACIJE INNER JOIN USLUGA ON REZERVACIJE.usluga_ID = USLUGA.usluga_ID INNER JOIN OSTALO ON USLUGA.redni_broj_usluge = OSTALO.ostalo_ID INNER JOIN PRUZATELJ_USLUGE ON REZERVACIJE.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID WHERE USLUGA.vrsta_usluge_ID = 6 AND REZERVACIJE.pruzatelj_usluge_ID = ?;';

                    $stmt1= $this->connect()->prepare($ostaloquery);

                    if(!$stmt1->execute(array($rezpruusid)))
                    {
                        $stmt1=null;
                        header("location: ../../index.php?error=stmtfailed");
                        exit();
                    }           

                    if($stmt1->rowCount()==0)
                    {
                        $stmt=null;
                        header("location: ../../index.php?error=noData");
                        exit();
                    }        

                    $ostalorezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    for($i = 0; $i < $ostaloCount; $i++){           
                    $GLOBALS["rezglazba"] .= '<div class="rezervacije-section-container-item">
                                                <form action="./system/BrisanjeRezervacije/brisrez.inc.php" method="post">
                                                <h2  class="rezervacije-section-container-item-title">'.$ostalorezultat[$i]["ime_ostale_usluge"].'(Ostalo)</h2>
                                                    <div class="rezervacije-section-container-item-details">
                                                        <input type="hidden" name="id_usluge" value="'.$ostalorezultat[$i]["rezervacije_ID"].'"/>
                                                        <em>ID: '.$ostalorezultat[$i]["rezervacije_ID"].'</em>
                                                        <em>Vrsta ostalog: '.$ostalorezultat[$i]["vrsta_ostalog"].'</em>
                                                        <em>Poslovni subjekt: '.$ostalorezultat[$i]["ime_poslovnog_subjekta"].'</em>
                                                        <em>Datum: '.$ostalorezultat[$i]["datum_rezervacije"].'</em>
                                                        <em>Cijena: '.$ostalorezultat[$i]["cijena_usluge"].'</em>
                                                        <button type="submit" name="submit">
                                                                Otkaži
                                                        </button>
                                                    </div>
                                                    </form>
                                            </div>';
                    }
                    $stmt1 = null;
                }  
            }
        }         
    }
}