<?php
/*
rôle : inserer une ligne personnage dans la table personnage de la bdd
paramêtre : $objet
retour: true si ok , false sinon
*/
class creer_perso extends _action{

    protected $classNonAutorise = ["evenement"];

    function execute($class){
        
        if(! in_array($class, $this->classNonAutorise )){

            $objet = new $class;
            $pseudo = $_POST["pseudo"];
            $tabPerso = $objet->getAll("`pseudo` LIKE '$pseudo'");

            if( ! empty($tabPerso)){
                echo "pseudo deja utilisé";
                return false;
            }
            if(! $_POST["mdp"] == $_POST["confirm_mdp"]){
                echo "les mots de passe ne sont pas identique";
                return false;
            }
            $pointStat = $_POST["force"] + $_POST["resistance"] + $_POST["agilite"];
            if($pointStat > 15){
                return false ;
            } 
            
            $objet->loadByArray($_POST);
            $id = $objet->insert();
            $_SESSION["id"] = $id;
            header("location:index.php");
            return true ;
            
            
        }else{
            return false;
        }
    }

}