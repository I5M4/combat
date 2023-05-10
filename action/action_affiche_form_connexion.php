<?php
/*
rôle: affiche le formulaire de connexion de personnage
paramêtre : $objet
retour : true si ok , false sinon
*/

class affiche_form_connexion extends _action {

    protected $classNonAutorise = ["evenement"];

    function execute($class){

        if(! in_array($class, $this->classNonAutorise)){
            
            include "template/form_connexion_perso.php";
            return true;

        }else{
            return false;
        }
    }
}