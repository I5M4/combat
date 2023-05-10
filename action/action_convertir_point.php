<?php

/*
Rôle: enlever un point de l'attribut choisi et ajouter un point a l'autre 
parametre : $objet
        : $attribut, celui dont on veut convertir la valeur

retour: true si ok , false sinon
*/

class convertir_point extends _action {

    protected $classNonAutorise = ["evenement"];
    
    function execute ($class){

        

        if(! in_array($class, $this->classNonAutorise)){
            
            $objet = new $class;
            $attribut = $_GET["attribut"];
            $objet->loadById($_SESSION["id"]);
            if($attribut == "force"){
                
                $objet->set("force", $objet->get("force")-1);
                $objet->set("resistance", $objet->get("resistance")+1);
                

            }else if($attribut == "resistance"){
                var_dump($objet->get("resistance")-1);
                $objet->set("resistance", $objet->get("resistance")-1);
                $objet->set("force", $objet->get("force")+1);
                
            }

            $objet->update();
            return true;
        }else{
        
            return false;
        }
    }
    
}