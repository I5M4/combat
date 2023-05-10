<?php

class evenement extends _model{

    protected $champs = ["personnage", "type_evenement", "adversaire"];
    protected $table = "evenement";
    protected $valeur = [];
    protected $typeChamp = ["personnage"=>"lien", "type_evenement"=>"texte", "adversaire"=>"lien"];
    protected $affichageChamp = [];
    protected $nomComplet = [];
    protected $valCategorie=[];
    protected $lien = ["personnage"=>"personnage", "adversaire"=>"personnage"];
    protected $objet =[];

    protected $id = 0;
}