<?php

/*
Rôle: afficher les informatios du personnage et la liste des adversaires
parametre : $objet , $id, $piece
*/

class affiche_perso extends _action {

    protected $classNonAutorise = [];

    function execute ($class){
        
       
            if(! in_array($class, $this->classNonAutorise)){

                $objet = new $class;
                $id = $_SESSION["id"];
                
                $objet->loadById($id);
                $salle = $objet->get("salle");

                $listeAdversaires = $objet->getAll("`salle` = $salle AND `id` != $id AND `etat` != 2");
                
                include "template/fragment/personnage.php";
                return true;

            }else{
                return false;
            }
       
    }
 
}