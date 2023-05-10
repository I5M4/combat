<?php

/*
Rôle: afficher les informatios du jeu (informations personnage et hitorique) ansi que la liste des adversaires
parametre : $objet , $id, $piece
*/

class affiche_jeu extends _action {

    protected $classNonAutorise = [];

    function execute ($class){
        
        if(! $_SESSION["id"] == null){
            if(! in_array($class, $this->classNonAutorise)){

                $objet = new $class;
                $id = $_SESSION["id"];
                $salle = $_SESSION["salle"];
                $objet->loadById($id);
                
                $listeAdversaires = $objet->getAll("`salle` = $salle AND `id` != $id");

                $evenement = new evenement;

                $historique = $evenement->getAll("`".$evenement->table()."`.`personnage` = $id OR `adversaire` = $id ORDER BY `id` DESC LIMIT 10");
                
                $historique = array_reverse($historique, true);
                include "";
                return true;

            }else{
                return false;
            }
        }else{
            return false;
        }
    }
 
}