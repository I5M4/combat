<?php

/*
Rôle: afficher l'historique des evenement
parametre : $objet , $id, $salle
*/

class affiche_historique extends _action {

    protected $classNonAutorise = [];

    function execute ($class){
        
        if(! $_SESSION["id"] == null){
            if(! in_array($class, $this->classNonAutorise)){


                $evenement = new $class;
                $id = $_SESSION["id"];
                include_once "data/data_personnage.php";
                $historique = $evenement->getAll("`".$evenement->table()."`.`personnage` = $id OR `adversaire` = $id ORDER BY `id` DESC LIMIT 30");
                
                $historique = array_reverse($historique, true);
                include "template/fragment/historique.php";
                return true;

            }else{
                return false;
            }
        }else{
            return false;
        }
    }
 
}