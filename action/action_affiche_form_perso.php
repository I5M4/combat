<?php
/*
rôle: affiche le formulaire de creation de personnage
paramêtre : $objet
retour : true si ok , false sinon
*/
class affiche_form_perso extends _action{

    protected $classNonAutorise = ["evenement"];


    function execute($class){

        if(! in_array($class, $this->classNonAutorise)){
           
            include "template/form_creation_perso.php";

            return true;

        }else{
            return false;
        }
    }
}