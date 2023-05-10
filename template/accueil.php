<?php

/*
Rôle : met en forme la page pour choisir de creer un personnage ou de se connecter
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div id="arrive">
        <?php empty($_SESSION["id"]) ? include "template/fragment/choix_creer_connecter.php" : ""; ?>   
    </div>
    <?php empty($_SESSION["id"]) ? include "template/fragment/bloc_affichage_form.php" : "" ?>
 
    <?php include "template/jeu.php" ?>
    
    <script src="js/jquery.js"></script>
    <script src="js/fonction.js"></script>

    </body>
</html>