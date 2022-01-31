<?php

class KretorUslugeContr extends KreatorUsluga {

    private $PUId;

    private $tip_usluge; 
    private $ime_prostora;
    private $kapacitet;
    private $cijena;
    private $tip_izvodaca;
    private $ime_glazbenog_sastava;
    private $vrsta_glazbe;
    private $nacin_posluzivanja;
    private $ime_menija;
    private $vrsta_dekoracije;
    private $ime_dekoracije;
    private $vrsta_medie;
    private $ime_medie;
    private $vrsta_ostalog;
    private $ime_ostale_usluge;
      




    public function __construct($PUId, $tip_usluge, $ime_prostora, $kapacitet, $cijena, $tip_izvodaca, $ime_glazbenog_sastava, $vrsta_glazbe, $nacin_posluzivanja, $ime_menija, $vrsta_dekoracije, $ime_dekoracije, $vrsta_medie, $ime_medie, $vrsta_ostalog, $ime_ostale_usluge) {
        
        $this->PUId = $PUId;
       
        $this->tip_usluge = $tip_usluge;
        $this->ime_prostora = $ime_prostora;
        $this->kapacitet = $kapacitet;
        $this->cijena = $cijena;
        $this->tip_izvodaca = $tip_izvodaca;
        $this->ime_glazbenog_sastava = $ime_glazbenog_sastava;
        $this->vrsta_glazbe = $vrsta_glazbe;
        $this->nacin_posluzivanja = $nacin_posluzivanja;
        $this->ime_menija = $ime_menija;
        $this->vrsta_dekoracije = $vrsta_dekoracije;
        $this->ime_dekoracije = $ime_dekoracije;
        $this->vrsta_medie = $vrsta_medie;
        $this->ime_medie = $ime_medie;
        $this->vrsta_ostalog = $vrsta_ostalog;
        $this->ime_ostale_usluge = $ime_ostale_usluge;
      
    }

    public function KreirajVelikuUslugu(){


        $this->KreirajUslugu($this->PUId,
        $this->tip_usluge,
        $this->ime_prostora,
        $this->kapacitet,
        $this->cijena,
        $this->tip_izvodaca,
        $this->ime_glazbenog_sastava,
        $this->vrsta_glazbe,
        $this->nacin_posluzivanja,
        $this->ime_menija,
        $this->vrsta_dekoracije,
        $this->ime_dekoracije,
        $this->vrsta_medie,
        $this->ime_medie,
        $this->vrsta_ostalog,
        $this->ime_ostale_usluge);
    }
}  