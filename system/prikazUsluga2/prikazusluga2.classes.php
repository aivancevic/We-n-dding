<?php

class Prikaz extends Dbh {
            
      function getUserUsluga($sesijskipruzateljid){

        $kojekategorijequery='SELECT USLUGA.vrsta_usluge_ID FROM USLUGA  WHERE USLUGA.pruzatelj_usluge_ID = ? ORDER BY USLUGA.vrsta_usluge_ID ASC;'; // koje sve usluge imam

        $stmtkategorije= $this->connect()->prepare($kojekategorijequery);

        $GLOBALS["nemaUsluga"] = "";
        if(!$stmtkategorije->execute(array($sesijskipruzateljid)))
        {
            $stmtkategorije=null;
            header("location: ../../index.php?error=stmtfailed");
            exit();
        }           

       if($stmtkategorije->rowCount()==0)
        {
            $stmtkategorije=null;
            $GLOBALS["nemaUsluga"] = "<h3>Nema dodanih usluga</h3>";
            exit();
        }        

        $kojekategorijerezultat = $stmtkategorije->fetchAll(PDO::FETCH_ASSOC);

        $stmtkategorije = null;

        $prostorCount = 0;
        $glazbaCount = 0;
        $hranaCount = 0;
        $dekoracijaCount = 0;
        $mediaCount = 0;
        $ostaloCount = 0;

        $GLOBALS["prostor"] = "";
        $GLOBALS["glazba"] = "";
        $GLOBALS["hrana"] = "";
        $GLOBALS["dekoracija"] = "";
        $GLOBALS["media"] = "";
        $GLOBALS["ostalo"] = "";


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
            $prostorquery='SELECT PROSTOR.ime_prostora, PROSTOR.kapacitet, USLUGA.cijena_usluge FROM PROSTOR INNER JOIN USLUGA ON PROSTOR.prostor_ID= USLUGA.redni_broj_usluge WHERE USLUGA.pruzatelj_usluge_ID = ?;';

            $stmt1= $this->connect()->prepare($prostorquery);

            if(!$stmt1->execute(array($sesijskipruzateljid)))
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
                $GLOBALS["prostor"] .= '<li class="cards_item">
                                            <div class="card card-prostor">
                                            <div class="card_image"><img src="./assets/img/sala.jpg" alt="Sala"></div>
                                            <div class="card_content prostor">
                                                <h2 class="card_title">Prostor</h2>
                                                <h3 class="card_text">Naziv prostora: '.$prostorrezultat[$i]["ime_prostora"].'</h3>
                                                <h3 class="card_text">Kapacitet: '.$prostorrezultat[$i]["kapacitet"].'</h3>
                                                <h3 class="card_text">Cijena: '.$prostorrezultat[$i]["cijena_usluge"].' kn</h3>
                                                <input class="btn card_btn" value="IZBRIŠI" />
                                            </div>
                                            </div>
                                        </li>';
            }


            $stmt1 = null;
        }

        if($glazbaCount <> 0){
            $glazbaquery='SELECT GLAZBA.ime_glazbenog_sastava, GLAZBA.tip_izvodaca, GLAZBA.vrsta_glazbe, USLUGA.cijena_usluge FROM GLAZBA INNER JOIN USLUGA ON GLAZBA.glazba_ID = USLUGA.redni_broj_usluge WHERE USLUGA.pruzatelj_usluge_ID = ?;';

            $stmt1= $this->connect()->prepare($glazbaquery);

            if(!$stmt1->execute(array($sesijskipruzateljid)))
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
                $GLOBALS["glazba"] .= '<li class="cards_item">
                                            <div class="card card-glazba">
                                            <div class="card_image"><img src="./assets/img/glazba.jpg" alt="Glazba"></div>
                                            <div class="card_content glazba">
                                                <h2 class="card_title">Glazba</h2>
                                                <h3 class="card_text">Ime glazbenog sastava: '.$glazbarezultat[$i]["ime_glazbenog_sastava"].'</h3>
                                                <h3 class="card_text">Tip izvođača: '.$glazbarezultat[$i]["tip_izvodaca"].'</h3>
                                                <h3 class="card_text">Vrsta glazbe: '.$glazbarezultat[$i]["vrsta_glazbe"].'</h3>
                                                <h3 class="card_text">Cijena: '.$glazbarezultat[$i]["cijena_usluge"].'</h3>
                                                <input class="btn card_btn" value="IZBRIŠI" />
                                            </div>
                                            </div>
                                        </li>';
            }


            $stmt1 = null;
        }

        if($hranaCount <> 0){
            $hranaquery='SELECT HRANA.nacin_posluzivanja, HRANA.ime_menija, USLUGA.cijena_usluge FROM HRANA INNER JOIN USLUGA ON HRANA.hrana_ID = USLUGA.redni_broj_usluge WHERE USLUGA.pruzatelj_usluge_ID = ?;';

            $stmt1= $this->connect()->prepare($hranaquery);

            if(!$stmt1->execute(array($sesijskipruzateljid)))
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
                $GLOBALS["hrana"] .= '<li class="cards_item">
                                        <div class="card card-catering">
                                        <div class="card_image"><img src="./assets/img/catering.jpg" alt="Catering"></div>
                                        <div class="card_content catering">
                                            <h2 class="card_title">Hrana</h2>
                                            <h3 class="card_text">Nacin posluživanja: '.$hranarezultat[$i]["nacin_posluzivanja"].'</h3>
                                            <h3 class="card_text">Vrsta menija: '.$hranarezultat[$i]["ime_menija"].'</h3>
                                            <h3 class="card_text">Cijena: '.$hranarezultat[$i]["cijena_usluge"].'</h3>
                                            <input class="btn card_btn" value="IZBRIŠI" />
                                        </div>
                                        </div>
                                    </li>';
            }


            $stmt1 = null;
        }

        if($dekoracijaCount <> 0){
            $dekoracijaquery='SELECT DEKORACIJA.vrsta_dekoracije, DEKORACIJA.ime_dekoracije, USLUGA.cijena_usluge FROM DEKORACIJA INNER JOIN USLUGA ON DEKORACIJA.dekoracija_ID = USLUGA.redni_broj_usluge WHERE USLUGA.pruzatelj_usluge_ID = ?;';

            $stmt1= $this->connect()->prepare($dekoracijaquery);

            if(!$stmt1->execute(array($sesijskipruzateljid)))
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
                $GLOBALS["dekoracija"] .= '<li class="cards_item">
                                                <div class="card card-dekoracija">
                                                <div class="card_image"><img src="./assets/img/dekoracija.jpg" alt="Dekoracija"></div>
                                                <div class="card_content dekoracija">
                                                    <h2 class="card_title">Dekoracija</h2>
                                                    <h3 class="card_text">Vrsta dekoracije: '.$dekoracijarezultat[$i]["vrsta_dekoracije"].'</h3>
                                                    <h3 class="card_text">Ime dekoracije: '.$dekoracijarezultat[$i]["ime_dekoracije"].'</h3>
                                                    <h3 class="card_text">Cijena: '.$dekoracijarezultat[$i]["cijena_usluge"].'</h3>
                                                    <input class="btn card_btn" value="IZBRIŠI" />
                                                </div>
                                                </div>
                                            </li>';
            }


            $stmt1 = null;
        }

        if($mediaCount <> 0){
            $mediaquery='SELECT MEDIJA.vrsta_medie, MEDIJA.ime_medie, USLUGA.cijena_usluge FROM MEDIJA INNER JOIN USLUGA ON MEDIJA.medija_ID = USLUGA.redni_broj_usluge WHERE USLUGA.pruzatelj_usluge_ID = ?;';

            $stmt1= $this->connect()->prepare($mediaquery);

            if(!$stmt1->execute(array($sesijskipruzateljid)))
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
                $GLOBALS["media"] .= '<li class="cards_item">
                                        <div class="card card-media">
                                        <div class="card_image"><img src="./assets/img/media.jpg" alt="Media"></div>
                                        <div class="card_content media">
                                            <h2 class="card_title">Media</h2>
                                            <h3 class="card_text">Vrsta medie: '.$mediarezultat[$i]["vrsta_medie"].'</h3>
                                            <h3 class="card_text">Ime medie: '.$mediarezultat[$i]["ime_medie"].'</h3>
                                            <h3 class="card_text">Cijena: '.$mediarezultat[$i]["cijena_usluge"].'</h3>
                                            <input class="btn card_btn" value="IZBRIŠI" />
                                        </div>
                                        </div>
                                    </li>';
            }


            $stmt1 = null;
        }

        if($ostaloCount <> 0){
            $ostaloquery='SELECT OSTALO.vrsta_ostalog, OSTALO.ime_ostale_usluge, USLUGA.cijena_usluge FROM OSTALO INNER JOIN USLUGA ON OSTALO.ostalo_ID = USLUGA.redni_broj_usluge WHERE USLUGA.pruzatelj_usluge_ID = ?;';

            $stmt1= $this->connect()->prepare($ostaloquery);

            if(!$stmt1->execute(array($sesijskipruzateljid)))
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
                $GLOBALS["ostalo"] .= '<li class="cards_item">
                                            <div class="card card-ostalo">
                                            <div class="card_image"><img src="./assets/img/ostalo.jpg" alt="Ostalo"></div>
                                            <div class="card_content ostalo">
                                                <h2 class="card_title">Ostalo</h2>
                                                <h3 class="card_text">Vrsta: '.$ostalorezultat[$i]["vrsta_ostalog"].'</h3>
                                                <h3 class="card_text">Ime usluge: '.$ostalorezultat[$i]["ime_ostale_usluge"].'</h3>
                                                <h3 class="card_text">Cijena: '.$ostalorezultat[$i]["cijena_usluge"].'</h3>
                                                <input class="btn card_btn" value="IZBRIŠI" />
                                            </div>
                                            </div>
                                        </li>';
            }


            $stmt1 = null;
        }

    }
}

?>