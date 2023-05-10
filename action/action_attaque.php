<?php

/*
Rôle: calculer la différence de points entre l'attribut "force" du personnage et la resistance de l'adversaire
parametre : $id, celui du personnage
          :$idAdversaire, l'id du personnage attaquer(adversaire)
           
*/

class attaque extends _action {

    protected $classNonAutorise = [];

    function execute($class){

        if(! in_array($class, $this->classNonAutorise)){
            
            

            $id = $_SESSION["id"];
            $idAdversaire = $_GET["adversaire"];

            $this->attaquer($id, $idAdversaire, $class);

            

        }else{

            return false;
        }
    }

    function attaquer($attaquant , $attaquee, $class){
        /*
        Rôle: calculer la différence de points entre l'attribut "force" du personnage et la resistance de l'adversaire
        parametre : $id, celui du personnage
                :$idAdversaire, l'id du personnage attaquer(adversaire)
        retour: true si action effectuer, false sinon
           
        */
       
            $personnage = new $class;
            $adversaire = new $class;

            include_once "data/data_evenement.php";
            $evenement = new evenement;

            $personnage->loadById($attaquant);
            $adversaire->loadById($attaquee);
           
        if($personnage->get("salle") != 1 or $personnage->get("salle") != 10){

            $force = $personnage->get("force");

            $agiliteAdversaire = $adversaire->get("agilite");
            $forceAdversaire = $adversaire->get("force");
            $resistanceAdversaire = $adversaire->get("resistance");
            
            if( ($agiliteAdversaire-3) >= $force){

                var_dump('esquive');
                $adversaire->set("agilite", $adversaire->get("agilite")-1);
                $adversaire->update();
                $evenement->set("personnage", $attaquant);
                $evenement->set("type_evenement", "esquive");
                $evenement->set("adversaire", $attaquee);
                $evenement->insert();
                return true;

            }else if( $forceAdversaire > $force){

                var_dump('contre');
                
                $evenement->set("personnage", $attaquant);
                $evenement->set("type_evenement", "contre");
                $evenement->set("adversaire", $attaquee);
                $evenement->insert();

                $this->attaquer($attaquee , $attaquant, $class);

                

            }else if( $resistanceAdversaire >= $force){

                var_dump('defense gagnante');
                $difference = ($resistanceAdversaire - $force);

                $adversaire->set("hp",($personnage->get("hp")+1));
                $personnage->set("hp", ($personnage->get("hp")-$difference));

                $evenement->set("personnage", $attaquant);
                $evenement->set("type_evenement", "defense_gagnante");
                $evenement->set("adversaire", $attaquee);
                $evenement->insert();

                 if( !$this->verifHp($personnage, $adversaire) == true ){
                
                    $personnage->update();
                }else{
                    $this->verifHp($personnage, $adversaire);
                }

               

                

            }else if($resistanceAdversaire < $force){

                var_dump('defense perdante');
                
                $personnage->set("hp",($personnage->get("hp")+1));
                $adversaire->set("hp", ($adversaire->get("hp")-1));

                $evenement->set("personnage", $attaquant);
                $evenement->set("type_evenement","defense_perdante");
                $evenement->set("adversaire", $attaquee);
                $evenement->insert();

                if( !$this->verifHp($personnage, $adversaire) == true ){

                    $adversaire->update();

                }else{

                    $this->verifHp($personnage, $adversaire);
                }
                
                
            }
            

        }else{

            return false;
        }

    }


    function verifHp($personnage, $adversaire){
        //rôle : verifier les hp des deux personnage
        //paramêtre:
        //         : $personnage, objet personnage
        //         : $adversaire , objet adversaire
        //retour: néant
        $evenement = new evenement;
        var_dump($personnage->get("hp") == "");
        if($personnage->get("hp") == "" ){

            $evenement->set("personnage", $personnage->id());
            $evenement->set("type_evenement","mort");
            $evenement->set("adversaire", $adversaire->id());
            $personnage->set("etat", "2");
            $personnage->set("hp", "1");
            $personnage->update();
            $evenement->insert();

            return true;
        }
        var_dump($adversaire->get("hp") == "");
        if($adversaire->get("hp") == ""){

            $evenement->set("personnage", $adversaire->id());
            $evenement->set("type_evenement","mort");
            $evenement->set("adversaire", $personnage->id());
            $adversaire->set("etat", "2");
            $adversaire->set("hp", "1");
            $adversaire->update();
           
            $evenement->insert();
            
            return true;
        }

        return false;
    }

    function deleteMort(){
        // role : suprrimer de la bdd les personnage mort (etat = 1=
        //param : néant
        //retour: néant
        var_dump("coucou");
        $personnage = new personnage;
        $listeMort = $personnage->getAll("`etat`= '2'");
        var_dump($listeMort);
        foreach($listeMort as $deadMan){
            $deadMan -> delete();
        }
    }   
 
}