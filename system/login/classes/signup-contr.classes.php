<?php

class SignupContr extends Signup {

    private $ime;
    private $prez;
    private $email;
    private $tel;
    private $uid;
    private $pwd;
    private $pwdrepeat;
    private $nadi;
    private $drzava;
    private $grad;    
    private $posl;

    public function __construct($ime,$prez,$email,$tel,$uid,$pwd,$pwdrepeat,$nadi,$drzava,$grad,$posl) {
        $this->ime = $ime;
        $this->prez = $prez;
        $this->email = $email;
        $this->tel = $tel;
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdrepeat;
        $this->nadi = $nadi;
        $this->drzava = $drzava;
        $this->grad = $grad;
        $this->posl = $posl;
    }

    public function signupUser(){

        if($this->emptyImput()==false)
        {
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        if($this->invalidUid()==false)
        {
            header("location: ../index.php?error=username");
            exit();
        }
        if($this->invalidEmail()==false)
        {
            header("location: ../index.php?error=email");
            exit();
        }
        if($this->pwdMatch()==false)
        {
            header("location: ../index.php?error=passwordmatch");
            exit();
        }
        if($this->uidTakenCheck()==false)
        {
            header("location: ../index.php?error=usernameoremailtaken");
            exit();
        }

        $this->setUser($this->ime,
        $this->prez,
        $this->email,
        $this->tel,
        $this->uid,
        $this->pwd,
        $this->pwdRepeat,
        $this->nadi,
        $this->drzava,
        $this->grad,
        $this->posl);
    }

    private function emptyImput(){
        $result=null;
        if((empty($this->uid))||(empty($this->pwd))||(empty($this->pwdRepeat))||(empty($this->email))){
            $result=false;

        }
        else{
            $result=true;
        }

        return $result;
    }

    private function invalidUid() {
        $result=null;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->uid))
        {
            $result = false;
        }
            else
            {
                $result=true;
            }
            return $result;
    }

    private function invalidEmail(){
        $result=null;
         if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $result=false;
        }
        else{
            $result = true;
        }
        return $result;

    }

    private function pwdMatch() {
        $result=null;
        if($this->pwd !== $this->pwdRepeat)
        {
            $result= false;
        }
        else{
            $result=true;
        }
        return $result;
    }

    private function uidTakenCheck() {
        $result=null;
        if(!$this->checkUser($this->uid,$this->email))
        {
            $result= false;
        }
        else{
            $result=true;
        }
        return $result;
    }

}