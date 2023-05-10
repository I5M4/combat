<?php

/*
Rôle: verifier que le pseudo existe (dans la table personnage) et si c'est le cas verifier que le mot de passe correspond au pseudo
parametre : $objet
            : $mdp, le mot de passe entré par l'utilisateur
            : $pseudo, le pseudo entré par l'utilisateur
retour: true si ok , false sinon
*/

class connexion_perso extends _action {

    protected $classNonAutorise = ["evenement"];

    function execute ($class){

        if(! in_array($class, $this->classNonAutorise)){

            $objet = new $class;
            $pseudo = $_POST["pseudo"];
            $mdp = $_POST["mdp"];

            $tabObj = $objet->getAll("`pseudo` LIKE '$pseudo' ");
            $objet = $tabObj[0];
            if($objet->id() == null){

                echo "personnage inexistant";
                return false;
            }
            
            
            if( ! $objet->get("mdp") == $mdp){
             
                echo "mot de passe invalide";
                return false;

            }else{

                $_SESSION["id"] = $objet->id();
                $_SESSION["salle"] = $objet->get("salle");
                return true;
            }
        }
    }
}