<?php

class KreatorUsluga extends Dbh {


    protected function KreirajUslugu($id_usluge) {

        
        $kojekuquery='DELETE FROM REZERVACIJE WHERE REZERVACIJE.rezervacije_ID = ?;';

        $stmtku= $this->connect()->prepare($kojekuquery);

    
    
        if(!$stmtku->execute(array($id_usluge)))
        {
            $stmtku=null;
            header("location: ../../index.php?error=stmtbrisanjefailed");
            exit();
        }           

        $kojekurezultat =$stmtku->fetchAll(PDO::FETCH_ASSOC);

        $stmtku = null;
    }
}