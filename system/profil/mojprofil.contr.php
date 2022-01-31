<?php

class ProfilContr extends Profil {
   private $sesijskiloginid;

   public function __construct($sesijskiloginid) {
      $this->sesijskiloginid = $sesijskiloginid;
   }

   public function DohvatiProfil(){    
      $this->getUserData($this->sesijskiloginid);  
   }
}