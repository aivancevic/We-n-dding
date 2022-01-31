<?php

class KreatorUsluga extends Dbh {

   
   protected function KreirajUslugu($PUId, $tip_usluge, $ime_prostora, $kapacitet, $cijena, $tip_izvodaca, $ime_glazbenog_sastava, $vrsta_glazbe,  $nacin_posluzivanja, $ime_menija, $vrsta_dekoracije, $ime_dekoracije, $vrsta_medie, $ime_medie, $vrsta_ostalog, $ime_ostale_usluge) {
        

      //Umetanje usluga
      if($tip_usluge=="prostor"){
         //Umecemo baznu uslugu
         $stmt1 = $this->connect()->prepare('INSERT INTO PROSTOR(ime_prostora, kapacitet)  VALUES(?, ?)');
         
         if(!$stmt1->execute(array($ime_prostora,$kapacitet))){
            $stmt1=null;
            header("location: ../../index.php?error=stmtfailed");
            exit();
         }
         $stmt1 = null;


         //Vadimo ID bazne usluge
         $sqldbProstorId = $this->connect()->prepare('SELECT prostor_ID FROM PROSTOR WHERE ime_prostora = ? AND kapacitet = ?;');
         if(!$sqldbProstorId->execute(array($ime_prostora,$kapacitet)))
         {
               $sqldbProstorId=null;
               header("location: ../../index.php?error=sqldbProstorIdfailed");
               exit();
         }

         $resultId= $sqldbProstorId->fetchAll(PDO::FETCH_ASSOC);
         $sqldbProstorId=null;
         


         //Umetanje u veliku tablicu Usluge
         $stmt2 = $this->connect()->prepare('INSERT INTO USLUGA(pruzatelj_usluge_ID, vrsta_usluge_ID, redni_broj_usluge, cijena_usluge )  VALUES(?, ?, ?, ?)');

         //Idemo testirat $PUId  jebote sta ako je PUIDd negdi definiran sa puID ili nesto
         //$PUId=5;
         //Dio ispod valja, znaci puid se prije sjebe
         //cijena u puid
         if(!$stmt2->execute(array($PUId, 1, $resultId[0]["prostor_ID"], $cijena)))
         {
            $stmt2=null;
            header("location: ../../index.php?error=stmtfailed");
            exit();
         }
         $stmt2 = null;


      }
      elseif($tip_usluge=="glazba"){
         //Umecemo baznu uslugu
         $stmt1 = $this->connect()->prepare('INSERT INTO GLAZBA(ime_glazbenog_sastava, tip_izvodaca, vrsta_glazbe)  VALUES(?, ?, ?)');
         
         if(!$stmt1->execute(array($ime_glazbenog_sastava,$tip_izvodaca, $vrsta_glazbe)))
         {
            $stmt1=null;
            header("location: ../../index.php?error=stmtfailed");
            exit();
         }
         $stmt1 = null;


         //Vadimo ID bazne usluge
         $sqldbGlazbaId = $this->connect()->prepare('SELECT glazba_ID FROM GLAZBA WHERE ime_glazbenog_sastava = ? AND tip_izvodaca = ?;');
         if(!$sqldbGlazbaId->execute(array($ime_glazbenog_sastava,$tip_izvodaca)))
         {
               $sqldbGlazbaId=null;
               header("location: ../../index.php?error=sqldbGlazbaIdfailed");
               exit();
         }

         $resultId= $sqldbGlazbaId->fetchAll(PDO::FETCH_ASSOC);
         $sqldbGlazbaId=null;
         
         var_dump($PUId);

         //Umetanje u veliku tablicu Usluge
         $stmt2 = $this->connect()->prepare('INSERT INTO USLUGA(pruzatelj_usluge_ID, vrsta_usluge_ID, redni_broj_usluge, cijena_usluge )  VALUES(?, ?, ?, ?)');

         
         
         if(!$stmt2->execute(array($PUId, 2, $resultId[0]["glazba_ID"], $cijena)))
            {
               $stmt2=null;
               header("location: ../../index.php?error=insertUslugaFromProstorstmtfailed");
               exit();
            }
         $stmt2 = null;


      }
      elseif($tip_usluge=="hrana"){
         //Umecemo baznu uslugu
         $stmt1 = $this->connect()->prepare('INSERT INTO HRANA(nacin_posluzivanja, ime_menija)  VALUES(?,?)');
         
         if(!$stmt1->execute(array($nacin_posluzivanja, $ime_menija)))
         {
            $stmt1=null;
            header("location: ../../../index.php?error=stmtfailed");
            exit();
         }
         $stmt1 = null;


         //Vadimo ID bazne usluge
         $sqldbHranaId = $this->connect()->prepare('SELECT hrana_ID FROM HRANA WHERE nacin_posluzivanja = ? AND ime_menija = ?;');
         if(!$sqldbHranaId->execute(array($nacin_posluzivanja,$ime_menija)))
         {
               $sqldbHranaId=null;
               header("location: ../../../index.php?error=sqldbHranaIdfailed");
               exit();
         }

         $resultId= $sqldbHranaId->fetchAll(PDO::FETCH_ASSOC);
         $sqldbHranaId=null;
         


         //Umetanje u veliku tablicu Usluge
         $stmt2 = $this->connect()->prepare('INSERT INTO USLUGA(pruzatelj_usluge_ID, vrsta_usluge_ID, redni_broj_usluge, cijena_usluge )  VALUES(?, ?, ?, ?)');

         
         if(!$stmt2->execute(array($PUId, 3, $resultId[0]["hrana_ID"], $cijena)))
            {
               $stmt2=null;
               header("location: ../../../index.php?error=stmtfailed");
               exit();
            }
         $stmt2 = null;


      }
      elseif($tip_usluge=="dekoracija"){
         //Umecemo baznu uslugu
         $stmt1 = $this->connect()->prepare('INSERT INTO DEKORACIJA(vrsta_dekoracije, ime_dekoracije)  VALUES(?, ?)');
         
         if(!$stmt1->execute(array($vrsta_dekoracije, $ime_dekoracije)))
         {
            $stmt1=null;
            header("location: ../../../index.php?error=stmtfailed");
            exit();
         }
         $stmt1 = null;


         //Vadimo ID bazne usluge
         $sqldbDekoracijaId = $this->connect()->prepare('SELECT dekoracija_ID FROM DEKORACIJA WHERE vrsta_dekoracije = ? AND ime_dekoracije = ?;');
         if(!$sqldbDekoracijaId->execute(array($vrsta_dekoracije, $ime_dekoracije)))
         {
               $sqldbDekoracijaId=null;
               header("location: ../../../index.php?error=sqldbDekoracijaIdfailed");
               exit();
         }

         $resultId= $sqldbDekoracijaId->fetchAll(PDO::FETCH_ASSOC);
         $sqldbDekoracijaId=null;
         


         //Umetanje u veliku tablicu Usluge
         $stmt2 = $this->connect()->prepare('INSERT INTO USLUGA(pruzatelj_usluge_ID, vrsta_usluge_ID, redni_broj_usluge, cijena_usluge )  VALUES(?, ?, ?, ?)');

         
         if(!$stmt2->execute(array($PUId, 4, $resultId[0]["dekoracija_ID"], $cijena)))
            {
               $stmt2=null;
               header("location: ../../../index.php?error=stmtfailed");
               exit();
            }
         $stmt2 = null;


      }
      elseif($tip_usluge=="media"){
         //Umecemo baznu uslugu
         $stmt1 = $this->connect()->prepare('INSERT INTO MEDIJA(vrsta_medie, ime_medie)  VALUES(?, ?)');
         
         if(!$stmt1->execute(array($vrsta_medie, $ime_medie)))
         {
            $stmt1=null;
            header("location: ../../../index.php?error=stmtfailed");
            exit();
         }
         $stmt1 = null;


         //Vadimo ID bazne usluge
         $sqldbMediaId = $this->connect()->prepare('SELECT medija_ID FROM MEDIJA WHERE vrsta_medie = ? AND ime_medie = ?;');
         if(!$sqldbMediaId->execute(array($vrsta_medie, $ime_medie)))
         {
               $sqldbMediaId=null;
               header("location: ../../../index.php?error=sqldbMediaIdfailed");
               exit();
         }

         $resultId= $sqldbMediaId->fetchAll(PDO::FETCH_ASSOC);
         $sqldbMediaId=null;
         


         //Umetanje u veliku tablicu Usluge
         $stmt2 = $this->connect()->prepare('INSERT INTO USLUGA(pruzatelj_usluge_ID, vrsta_usluge_ID, redni_broj_usluge, cijena_usluge )  VALUES(?, ?, ?, ?)');

         
         if(!$stmt2->execute(array($PUId, 5, $resultId[0]["medija_ID"], $cijena)))
            {
               $stmt2=null;
               header("location: ../../../index.php?error=stmtfailed");
               exit();
            }
         $stmt2 = null;


      }
      elseif($tip_usluge=="ostalo"){
         //Umecemo baznu uslugu
         $stmt1 = $this->connect()->prepare('INSERT INTO OSTALO(vrsta_ostalog, ime_ostale_usluge)  VALUES(?, ?)');
         
         if(!$stmt1->execute(array($vrsta_ostalog, $ime_ostale_usluge)))
         {
            $stmt1=null;
            header("location: ../../../index.php?error=stmtfailed");
            exit();
         }
         $stmt1 = null;


         //Vadimo ID bazne usluge
         $sqldbOstaloId = $this->connect()->prepare('SELECT ostalo_ID FROM OSTALO WHERE vrsta_ostalog = ? AND ime_ostale_usluge = ?;');
         if(!$sqldbOstaloId->execute(array($vrsta_ostalog, $ime_ostale_usluge)))
         {
               $sqldbOstaloId=null;
               header("location: ../../../index.php?error=sqldbOstaloIdfailed");
               exit();
         }

         $resultId= $sqldbOstaloId->fetchAll(PDO::FETCH_ASSOC);
         $sqldbOstaloId=null;
         


         //Umetanje u veliku tablicu Usluge
         $stmt2 = $this->connect()->prepare('INSERT INTO USLUGA(pruzatelj_usluge_ID, vrsta_usluge_ID, redni_broj_usluge, cijena_usluge )  VALUES(?, ?, ?, ?)');

         
         if(!$stmt2->execute(array($PUId, 6, $resultId[0]["ostalo_ID"], $cijena)))
            {
               $stmt2=null;
               header("location: ../../../index.php?error=stmtfailed");
               exit();
            }
         $stmt2 = null;
      }
   }
}