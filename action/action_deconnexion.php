<?php


class deconnexion extends _action {

    protected $classNonAutorise = ["evenement"];

    function execute ($class){

        if(! in_array($class, $this->classNonAutorise)){

            $_SESSION["id"]= "";
            $_SESSION["salle"]= "";
            header("location:index.php");
        }
    }
}