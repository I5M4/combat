<?php

class deplacement extends _action
{

    protected $classNonAutorise = ["evenement"];

    function execute($class)
    {

        if (!in_array($class, $this->classNonAutorise)) {

            $objet = new $class;
            $Nsalle = $_GET["Nsalle"];

            $objet->loadById($_SESSION["id"]);

            $agil = $objet->get("agilite");

            if ($agil >= $Nsalle and $Nsalle >= 1 and $Nsalle <= 10) {

                $objet->set("salle", $Nsalle);
                $objet->set("agilite", ($agil - $Nsalle));
                $objet->set("hp", ($objet->get("hp") + $Nsalle));
                $objet->update();
            };
        }
    }
}
