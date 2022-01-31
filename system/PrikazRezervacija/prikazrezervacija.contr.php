<?php

class PrikazUslugeContr extends Prikaz {
    private $sesijskiuserid;

     public function __construct($sesijskiuserid) {
        $this->sesijskiuserid = $sesijskiuserid;
     }

     public function DohvatiUslugu(){     
      $this->getUserUsluga($this->sesijskiuserid); 
     }
}