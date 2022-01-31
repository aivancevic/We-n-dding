<?php

class KretorUslugeContr extends KreatorUsluga {

    private $PUId;

    private $id_usluge; 
    private $datum;

    public function __construct($PUId, $id_usluge, $datum) {       
        $this->PUId = $PUId;
       
        $this->id_usluge = $id_usluge;
        $this->datum = $datum;       
    }

    public function KreirajVelikuUslugu(){
        $this->KreirajUslugu($this->PUId,
        $this->id_usluge,
        $this->datum);
    }
}  