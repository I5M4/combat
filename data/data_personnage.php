<?php 

class personnage extends _model {

    protected $champs = ["pseudo", "mdp","force","agilite","resistance","hp","salle","etat"];
    protected $table = "personnage";
    protected $valeur = [];
    protected $typeChamp = ["pseudo"=> "texte", "mdp"=>"texte", "force"=>"nombre", "agilite"=>"nombre", "resistance"=>"nombre", "hp"=>"nombre", "salle"=>"nombre", "etat"=>"nombre"];
    protected $affichageChamp = [];
    protected $nomComplet = [];
    protected $valCategorie=[];
    protected $lien = [];
    protected $objet =[];

    protected $id = 0;
} 