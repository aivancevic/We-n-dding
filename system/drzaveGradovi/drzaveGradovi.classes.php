<?php

class Drzave extends Dbh {

    function getImeDrzave(){
    
        $imeDrzaveQuery = 'SELECT DRZAVE.ime_drzave, DRZAVE.drzava_id FROM DRZAVE';

        $stmt = $this->connect()->prepare($imeDrzaveQuery);

        if(!$stmt->execute())
        {
            $stmt=null;
            header("location: ../../index.php?error=stmtfailed");
            exit();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        $GLOBALS["drzave"] =  '<select id="drzava" name="drzava"> 
                                    <option value="" class="first-option" disabled="disabled" selected>Odaberite državu</option>' ;
        $i = 0;

        foreach($result as $drzava){
            $GLOBALS["drzave"] .= '<option value="'.$result[$i]["drzava_id"].'" name="grad">'.$result[$i]["ime_drzave"].'</option>';                      
            $i++;
        }

        $GLOBALS["drzave"] .= '</select>';
    }
}

?>