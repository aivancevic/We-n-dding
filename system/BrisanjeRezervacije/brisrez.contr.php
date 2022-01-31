<?php

class KretorUslugeContr extends KreatorUsluga {

    private $id_usluge; 


    public function __construct($id_usluge) {
        
        $this->id_usluge = $id_usluge;
                
    }   

    public function KreirajVelikuUslugu(){

        $this->KreirajUslugu($this->id_usluge);
    }
}  