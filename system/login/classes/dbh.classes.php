<?php

class Dbh {

    protected function connect(){
        try {
            $username= "wendding_connect";
            $password= "kla2fs4gc";

            $dbh= new PDO('mysql:host=localhost;dbname=wendding_test_db', $username, $password);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!:" . $e->getMessage() . "<br/>";
            die();
        }

    }

}
