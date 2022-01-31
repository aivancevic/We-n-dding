<?php

class Prikaz extends Dbh {
            
    function getUserUsluga(){

        if($_SESSION["pravaUser"] == null){
            $_SESSION["pravaUser"] = -1;
        }

        $kojekategorijequery='SELECT USLUGA.vrsta_usluge_ID FROM USLUGA  ORDER BY USLUGA.vrsta_usluge_ID ASC;'; // koje sve usluge ima

        $stmtkategorije= $this->connect()->prepare($kojekategorijequery);

        $GLOBALS["nemaUsluga"] = "";
        if(!$stmtkategorije->execute(array()))
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

        $GLOBALS["prostorsve2"] = "";
        $GLOBALS["glazbasve2"] = "";
        $GLOBALS["hranasve2"] = "";
        $GLOBALS["dekoracijasve2"] = "";
        $GLOBALS["mediasve2"] = "";
        $GLOBALS["ostalosve2"] = "";
        $GLOBALS["datepickerFunctions"] = '<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> 
                                            <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script> 
                                            <script>
                                            $(document).ready(function(){
                                                $(".list").click(function(){
                                                const value = $(this).attr("data-filter");
                                                if(value == "sve"){ 
                                                    $(".itembox").show("1000"); 
                                                } 
                                                else{ 
                                                    $(".itembox").not("."+value).hide("1000"); 
                                                    $(".itembox").filter("."+value).show("1000"); 
                                                } 
                                                }) 
                                            }); 
                                            $(".list").click(function(){ 
                                                $(this).addClass("active").siblings().removeClass(); 
                                            }); 
                                            $(function(){ 
                                                $( "#datum0" ).datepicker(); 
                                            });';


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
            $prostorquery='SELECT USLUGA.usluga_ID, PROSTOR.ime_prostora, PROSTOR.kapacitet, USLUGA.cijena_usluge, PRUZATELJ_USLUGE.ime_poslovnog_subjekta FROM PROSTOR INNER JOIN USLUGA ON PROSTOR.prostor_ID= USLUGA.redni_broj_usluge INNER JOIN PRUZATELJ_USLUGE WHERE USLUGA.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID;';

            $stmt1= $this->connect()->prepare($prostorquery);

            if(!$stmt1->execute(array()))
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

            $buttonRezerviraj = '<input type="submit" class="btn card_btn" value="REZERVIRAJ" />';
            $prostorrezultat = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            $jqueryCounter = 1;

            for($i = 0; $i < $prostorCount; $i++){
                $GLOBALS["prostorsve2"] .= '
                                        <li class="cards_item itembox prostor">
                                        <form action="./system/StvaranjeRezervacije/strez.inc.php" method="post">
                                            <div class="card card-prostor">
                                            <div class="card_image"><img src="./assets/img/sala.jpg" alt="Sala"></div>
                                            <div class="card_content prostor-gradient">
                                                <h2 class="card_title">Prostor</h2>
                                                <input type="hidden" name="id_usluge" value="'.$prostorrezultat[$i]["usluga_ID"].'"/>                                                    
                                                <h3 class="card_text">Naziv prostora: '.$prostorrezultat[$i]["ime_prostora"].'</h3>
                                                <h3 class="card_text">Kapacitet: '.$prostorrezultat[$i]["kapacitet"].'</h3>
                                                <h3 class="card_text">Poslovni subjekt: '.$prostorrezultat[$i]["ime_poslovnog_subjekta"].'</h3>
                                                <h3 class="card_text">Cijena: '.$prostorrezultat[$i]["cijena_usluge"].' kn</h3>'
                                                .($_SESSION["pravaUser"] == 1 ? '<label class="card_text" for="datum">Unesi datum:</label>
                                                <input type="text" id="datum'.$jqueryCounter.'" name="datum" style="margin-bottom: 1rem;">
                                                <button type="submit" class="btn card_btn" name="submit">REZERVIRAJ</button>' : '').'
                                            </div>
                                            </div>
                                            </form>
                                        </li>';
                $GLOBALS["datepickerFunctions"] .= '$(function(){ 
                                                        $( "#datum'.$jqueryCounter.'" ).datepicker(); 
                                                    });';
                $jqueryCounter++;
            }


            $stmt1 = null;
        }

        if($glazbaCount <> 0){
            $glazbaquery='SELECT USLUGA.usluga_ID, GLAZBA.ime_glazbenog_sastava, GLAZBA.tip_izvodaca, GLAZBA.vrsta_glazbe, USLUGA.cijena_usluge, PRUZATELJ_USLUGE.ime_poslovnog_subjekta FROM GLAZBA INNER JOIN USLUGA ON GLAZBA.glazba_ID = USLUGA.redni_broj_usluge INNER JOIN PRUZATELJ_USLUGE WHERE USLUGA.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID;';

            $stmt1= $this->connect()->prepare($glazbaquery);

            if(!$stmt1->execute(array()))
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
                $GLOBALS["glazbasve2"] .= '
                                        <li class="cards_item itembox glazba">
                                        <form action="./system/StvaranjeRezervacije/strez.inc.php" method="post">
                                            <div class="card card-glazba">
                                            <div class="card_image"><img src="./assets/img/glazba.jpg" alt="Glazba"></div>
                                            <div class="card_content glazba-gradient">
                                                <h2 class="card_title">Glazba</h2>
                                                <input type="hidden" name="id_usluge" value="'.$glazbarezultat[$i]["usluga_ID"].'"/>                                                
                                                <h3 class="card_text">Ime glazbenog sastava: '.$glazbarezultat[$i]["ime_glazbenog_sastava"].'</h3>
                                                <h3 class="card_text">Tip izvođača: '.$glazbarezultat[$i]["tip_izvodaca"].'</h3>
                                                <h3 class="card_text">Vrsta glazbe: '.$glazbarezultat[$i]["vrsta_glazbe"].'</h3>
                                                <h3 class="card_text">Poslovni subjekt: '.$glazbarezultat[$i]["ime_poslovnog_subjekta"].'</h3>
                                                <h3 class="card_text">Cijena: '.$glazbarezultat[$i]["cijena_usluge"].'</h3>'
                                                .($_SESSION["pravaUser"] == 1 ? '<label class="card_text" for="datum">Unesi datum:</label>
                                                <input type="text" id="datum'.$jqueryCounter.'" name="datum" style="margin-bottom: 1rem;">
                                                <button type="submit" class="btn card_btn" name="submit">REZERVIRAJ</button>' : '').'                                         
                                            </div>
                                            </div>
                                            </form>
                                        </li>';
                                        $GLOBALS["datepickerFunctions"] .= '$(function(){ 
                                            $( "#datum'.$jqueryCounter.'" ).datepicker(); 
                                        });';
                $jqueryCounter++;
            }


            $stmt1 = null;
        }

        if($hranaCount <> 0){
            $hranaquery='SELECT USLUGA.usluga_ID, HRANA.nacin_posluzivanja, HRANA.ime_menija, USLUGA.cijena_usluge, PRUZATELJ_USLUGE.ime_poslovnog_subjekta FROM HRANA INNER JOIN USLUGA ON HRANA.hrana_ID = USLUGA.redni_broj_usluge INNER JOIN PRUZATELJ_USLUGE WHERE USLUGA.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID;';

            $stmt1= $this->connect()->prepare($hranaquery);

            if(!$stmt1->execute(array()))
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
                $GLOBALS["hranasve2"] .= '
                                    
                                    <li class="cards_item itembox hrana">
                                    <form action="./system/StvaranjeRezervacije/strez.inc.php" method="post">
                                        <div class="card card-catering">
                                        <div class="card_image"><img src="./assets/img/catering.jpg" alt="Catering"></div>
                                        <div class="card_content catering-gradient">
                                            <h2 class="card_title">Hrana</h2>
                                            <input type="hidden" name="id_usluge" value="'.$hranarezultat[$i]["usluga_ID"].'"/>                                           
                                            <h3 class="card_text">Nacin posluživanja: '.$hranarezultat[$i]["nacin_posluzivanja"].'</h3>
                                            <h3 class="card_text">Vrsta menija: '.$hranarezultat[$i]["ime_menija"].'</h3>
                                            <h3 class="card_text">Poslovni subjekt: '.$hranarezultat[$i]["ime_poslovnog_subjekta"].'</h3>
                                            <h3 class="card_text">Cijena: '.$hranarezultat[$i]["cijena_usluge"].'</h3>'
                                            .($_SESSION["pravaUser"] == 1 ? '<label class="card_text" for="datum">Unesi datum:</label>
                                            <input type="text" id="datum'.$jqueryCounter.'" name="datum" style="margin-bottom: 1rem;">
                                            <button type="submit" class="btn card_btn" name="submit">REZERVIRAJ</button>' : '').'                      
                                        </div>
                                        </div>
                                        </form>
                                    </li>';
                                    $GLOBALS["datepickerFunctions"] .= '$(function(){ 
                                        $( "#datum'.$jqueryCounter.'" ).datepicker(); 
                                    });';
                $jqueryCounter++;
            }


            $stmt1 = null;
        }

        if($dekoracijaCount <> 0){
            $dekoracijaquery='SELECT USLUGA.usluga_ID, DEKORACIJA.vrsta_dekoracije, DEKORACIJA.ime_dekoracije, USLUGA.cijena_usluge, PRUZATELJ_USLUGE.ime_poslovnog_subjekta FROM DEKORACIJA INNER JOIN USLUGA ON DEKORACIJA.dekoracija_ID = USLUGA.redni_broj_usluge INNER JOIN PRUZATELJ_USLUGE WHERE USLUGA.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID;';

            $stmt1= $this->connect()->prepare($dekoracijaquery);

            if(!$stmt1->execute(array()))
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
                $GLOBALS["dekoracijasve2"] .= '
                                            
                                            <li class="cards_item itembox dekoracija">
                                            <form action="./system/StvaranjeRezervacije/strez.inc.php" method="post">
                                                <div class="card card-dekoracija">
                                                <div class="card_image"><img src="./assets/img/dekoracija.jpg" alt="Dekoracija"></div>
                                                <div class="card_content dekoracija-gradient">
                                                    <h2 class="card_title">Dekoracija</h2>
                                                    <input type="hidden" name="id_usluge" value="'.$dekoracijarezultat[$i]["usluga_ID"].'"/>                                                   
                                                    <h3 class="card_text">Vrsta dekoracije: '.$dekoracijarezultat[$i]["vrsta_dekoracije"].'</h3>
                                                    <h3 class="card_text">Ime dekoracije: '.$dekoracijarezultat[$i]["ime_dekoracije"].'</h3>
                                                    <h3 class="card_text">Poslovni subjekt: '.$dekoracijarezultat[$i]["ime_poslovnog_subjekta"].'</h3>                                                    
                                                    <h3 class="card_text">Cijena: '.$dekoracijarezultat[$i]["cijena_usluge"].'</h3>'
                                                    .($_SESSION["pravaUser"] == 1 ? '<label class="card_text" for="datum">Unesi datum:</label>
                                                    <input type="text" id="datum'.$jqueryCounter.'" name="datum" style="margin-bottom: 1rem;">
                                                    <button type="submit" class="btn card_btn" name="submit">REZERVIRAJ</button>' : '').'  
                                                </div>
                                                </div>
                                                </form>
                                            </li>';
                                            $GLOBALS["datepickerFunctions"] .= '$(function(){ 
                                                $( "#datum'.$jqueryCounter.'" ).datepicker(); 
                                            });';
                $jqueryCounter++;
            }


            $stmt1 = null;
        }

        if($mediaCount <> 0){
            $mediaquery='SELECT USLUGA.usluga_ID, MEDIJA.vrsta_medie, MEDIJA.ime_medie, USLUGA.cijena_usluge, PRUZATELJ_USLUGE.ime_poslovnog_subjekta FROM MEDIJA INNER JOIN USLUGA ON MEDIJA.medija_ID = USLUGA.redni_broj_usluge INNER JOIN PRUZATELJ_USLUGE WHERE USLUGA.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID;';

            $stmt1= $this->connect()->prepare($mediaquery);

            if(!$stmt1->execute(array()))
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
                $GLOBALS["mediasve2"] .= '
                                    <li class="cards_item itembox medija">
                                    <form action="./system/StvaranjeRezervacije/strez.inc.php" method="post">
                                        <div class="card card-media">
                                        <div class="card_image"><img src="./assets/img/media.jpg" alt="Media"></div>
                                        <div class="card_content media-gradient">
                                            <h2 class="card_title">Media</h2>
                                            <input type="hidden" name="id_usluge" value="'.$mediarezultat[$i]["usluga_ID"].'"/>                                           
                                            <h3 class="card_text">Vrsta medie: '.$mediarezultat[$i]["vrsta_medie"].'</h3>
                                            <h3 class="card_text">Ime medie: '.$mediarezultat[$i]["ime_medie"].'</h3>
                                            <h3 class="card_text">Poslovni subjekt: '.$mediarezultat[$i]["ime_poslovnog_subjekta"].'</h3>
                                            <h3 class="card_text">Cijena: '.$mediarezultat[$i]["cijena_usluge"].'</h3>'
                                            .($_SESSION["pravaUser"] == 1 ? '<label class="card_text" for="datum">Unesi datum:</label>
                                            <input type="text" id="datum'.$jqueryCounter.'" name="datum" style="margin-bottom: 1rem;">
                                            <button type="submit" class="btn card_btn" name="submit">REZERVIRAJ</button>' : '').'
                                        </div>
                                        </div>
                                        </form>
                                    </li>';
                                    $GLOBALS["datepickerFunctions"] .= '$(function(){ 
                                        $( "#datum'.$jqueryCounter.'" ).datepicker(); 
                                    });';
                $jqueryCounter++;
            }


            $stmt1 = null;
        }

        if($ostaloCount <> 0){
            $ostaloquery='SELECT USLUGA.usluga_ID, OSTALO.vrsta_ostalog, OSTALO.ime_ostale_usluge, USLUGA.cijena_usluge, PRUZATELJ_USLUGE.ime_poslovnog_subjekta FROM OSTALO INNER JOIN USLUGA ON OSTALO.ostalo_ID = USLUGA.redni_broj_usluge INNER JOIN PRUZATELJ_USLUGE WHERE USLUGA.pruzatelj_usluge_ID = PRUZATELJ_USLUGE.pruzatelj_usluge_ID;';

            $stmt1= $this->connect()->prepare($ostaloquery);

            if(!$stmt1->execute(array()))
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
                $GLOBALS["ostalosve2"] .= '
                                        <li class="cards_item itembox ostalo">
                                        <form action="./system/StvaranjeRezervacije/strez.inc.php" method="post">
                                            <div class="card card-ostalo">
                                            <div class="card_image"><img src="./assets/img/ostalo.jpg" alt="Ostalo"></div>
                                            <div class="card_content ostalo-gradient">
                                                <h2 class="card_title">Ostalo</h2>
                                                <input type="hidden" name="id_usluge" value="'.$ostalorezultat[$i]["usluga_ID"].'"/>                                                
                                                <h3 class="card_text">Vrsta: '.$ostalorezultat[$i]["vrsta_ostalog"].'</h3>
                                                <h3 class="card_text">Ime usluge: '.$ostalorezultat[$i]["ime_ostale_usluge"].'</h3>
                                                <h3 class="card_text">Poslovni subjekt: '.$ostalorezultat[$i]["ime_poslovnog_subjekta"].'</h3>
                                                <h3 class="card_text">Cijena: '.$ostalorezultat[$i]["cijena_usluge"].'</h3>'
                                                .($_SESSION["pravaUser"] == 1 ? '<label class="card_text" for="datum">Unesi datum:</label>
                                                <input type="text" id="datum'.$jqueryCounter.'" name="datum" style="margin-bottom: 1rem;">
                                                <button type="submit" class="btn card_btn" name="submit">REZERVIRAJ</button>' : '').'
                                            </div>
                                            </div>
                                            </form>
                                        </li>';
                                        $GLOBALS["datepickerFunctions"] .= '$(function(){ 
                                            $( "#datum'.$jqueryCounter.'" ).datepicker(); 
                                        });';
                $jqueryCounter++;
            }
            $stmt1 = null;
        }

        $GLOBALS["datepickerFunctions"] .= '</script>';

    }
}

?>