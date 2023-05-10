<?php

class restaureAgil extends _action {

protected $classNonAutorise = ["evenement"];

    function execute ($class){
        
        if(! in_array($class, $this->classNonAutorise)){

            $personnage = new $class;
            $personnage->loadById($_SESSION["id"]);
            
            if(!$_SESSION["id"] == null && !$personnage->get("salle") != 1 or !$personnage->get("salle")!=10){

                if($personnage->get("agilite") < 15){
                    
                    $personnage->set("agilite", ($personnage->get("agilite")+1));
                    $personnage->update();
                    
                }
            }
        }else{
            return false;
        }
    }
}