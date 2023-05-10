<?php


    function reqSelect($sql, $param=[]){
        //role : preparer et executer une requete sql 
        //parametre:  
        //         :$sql, la requête sql "SELECT"
        //         : $param, les paramêtre de la requete (optionnel)
        //retour : $tab, tableau des données récupérer depuis la bdd
        global $bdd;
        $req = $bdd -> prepare($sql);

        if($req == false){
            
            return  "probleme $sql ";
        }
        //var_dump($sql);
        //var_dump($param);
        if($req -> execute($param) == false){

            return null;
        }
        
        $tab = $req->fetchAll(PDO::FETCH_ASSOC);
    
        return $tab;
    }

    function reqUpdateDelete($sql, $param){
    //role : prepare et execute une requete sql d'update ou delete
    //parametre : 
                //$sql : la requete "UPDATE" ou "DELETE"
                //$param : les parametres de la requête (tableau)
    ///retour : néant

        global $bdd;
        $req = $bdd -> prepare($sql);
       
        if($req == false){

            return  null;
        }
        //var_dump($sql);
        //var_dump($param);
        if($req -> execute($param) == false){

            return false;
        }
        return true;
    }

    function reqInsert($sql, $param){
        //role : prepare et execute une requête insert dans la table de la bdd
        //paramêtre :
                   // : $sql, la requete "INSERT"
                   // : $param, les parametre de la requête (tableau)

        //retour : lastinsertid = id de la ligne qui vient d'être créer
        global $bdd;
        $req = $bdd -> prepare($sql);

        if($req == false){

            return  "probleme $sql ";
        }
        //var_dump($param);
        //var_dump($sql);
        if($req -> execute($param) == false){

            return null;
        }
        $id = $bdd->lastInsertId();
        
        return $id;
        
    }

    function listeHistorique($historique){
    //role: afficher la liste des action 
    //parametre : liste des objets evenement
    //retour: néant

        foreach($historique as $evenement){
           $perso = $evenement->getValLiee("pseudo", "personnage");
           $advers = $evenement->getValLiee("pseudo", "adversaire");

           if( $evenement->get("type_evenement") == "esquive"){ $resume = "<b>".$advers."</b> à <b> esquivé </b> l'attaque de <b>".$perso."</b>"; }
           if( $evenement->get("type_evenement") == "contre"){ $resume = "<b>".$advers."</b> à <b> contré </b> l'attaque de <b>".$perso."</b>"; }
           if( $evenement->get("type_evenement") == "defense_gagnante"){ $resume = "<b>".$perso."</b> à essayé d'attaquer <b>".$advers."</b> mais il s'en est prit plein la tronche !";}
           if( $evenement->get("type_evenement") == "defense_perdante"){ $resume = "<b>".$perso."</b> <b> à éclater </b>  le pauvre <b>".$advers."</b>" ;}
           if( $evenement->get("type_evenement") == "mort"){ $resume = "<b>".$perso."</b> <b style='color:red'> à passé l'arme gauche </b> aprés s'être fait tabassé par <b>".$advers."</b>";}

           include "template/fragment/ligne_historique.php";

        }

    }
