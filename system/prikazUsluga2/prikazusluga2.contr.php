<?php

class PrikazUslugeContr extends Prikaz {
    private $sesijskipruzateljid;

     public function __construct($sesijskipruzateljid) {
        $this->sesijskipruzateljid = $sesijskipruzateljid;
     }

     public function DohvatiUslugu(){     
      $this->getUserUsluga($this->sesijskipruzateljid); 
     }


}