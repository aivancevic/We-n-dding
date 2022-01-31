<?php

class UpdateProfilContr extends UpdateProfil {

    private $ime;
    private $prez;
    private $tel;
//     private $drzava;
//     private $grad;

    public function __construct($ime, $prez, $tel) {       
        $this->ime = $ime;
        $this->prezime = $prez;
        $this->tel = $tel;  
     //    $this->drzava = $drzava;
     //    $this->grad = $grad;         
    }

    public function IzmjeniProfil(){
        $this->KreirajUslugu($this->ime, $this->prezime, $this->tel);
    }
}  