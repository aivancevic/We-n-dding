<?php

class PrikazObavijestiContr extends Prikaz {
    private $sesijskipruzateljid;

     public function __construct($sesijskipruzateljid) {
        $this->sesijskipruzateljid = $sesijskipruzateljid;
     }

     public function DohvatiObavijesti(){     
      $this->getDohvatiObavijest($this->sesijskipruzateljid); 
     }


}