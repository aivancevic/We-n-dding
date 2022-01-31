<?php

class Prikaz extends Dbh {
            
      function getDohvatiObavijest($sesijskipruzateljid){

        $obavijestQuery='SELECT OBAVIJESTI.tekst_obavijesti, OBAVIJESTI.vrijeme FROM OBAVIJESTI WHERE OBAVIJESTI.korisnicki_profil_id = ?'; // koje sve usluge imam

        $stmtobavijesti= $this->connect()->prepare($obavijestQuery);

        $GLOBALS["nemaObavijesti"] = "";
        if(!$stmtobavijesti->execute(array($sesijskipruzateljid)))
        {
            $stmtobavijesti=null;
            header("location: ../../index.php?error=stmtfailed");
        }           

       if($stmtobavijesti->rowCount()==0)
        {
            $stmtobavijesti=null;
            $GLOBALS["nemaObavijesti"] = "<h3>Nema obavijesti</h3>";
        }        
        $obavijestirezultat = $stmtobavijesti->fetchAll(PDO::FETCH_ASSOC);

        $GLOBALS["sveObavijesti"] = "";
    
        if($GLOBALS["nemaObavijesti"] == ""){
            $i = 0;
            foreach($obavijestirezultat as $obavijest){
                $GLOBALS["sveObavijesti"] .= '<div class="obavijesti-section-container-item">
                                                <h2  class="obavijesti-section-container-item-title">'.$obavijestirezultat[$i]["tekst_obavijesti"].'</h2>
                                                    <div class="obavijesti-section-container-item-details">
                                                        <em>Vrijeme: '.$obavijestirezultat[$i]["vrijeme"].'</em>
                                                    </div>
                                                    </form>
                                            </div>';
                $i++;
            }
        }

        $stmtobavijesti = null;

    }
}

?>