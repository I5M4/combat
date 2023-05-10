<?php
/*
Rôle: met en forme le formulaire de creation de personnage
*/
?>

    <h1>Nouveau personnage</h1>
    <p>il vous reste <span class="pointStat">15</span>  point de stat</p>
    <form class="form_creation"  method="POST">

        <label for="">Pseudo
            <input type="text" name="pseudo" required>
        </label>

        <label for="">Mot de passe
            <input type="text" name="mdp" required>
        </label>

        <label for="">Confirmez mdp
            <input type="text" name="confirm_mdp" required>
        </label>

        <label for="">Force
           <input type="number" name="force"   style="width:30px" min="0" max="10" value="0" onkeypress="eventPreventDefaut()" onchange="verifPointCreationPerson()"> 
        </label>

        <label for="">resistance
        <input type="number" name="resistance" style="width:30px" min="0" max="10" value="0" onchange="verifPointCreationPerson()">
        </label>

        <label for="">agilite
        <input type="number" name="agilite" style="width:30px" min="0" max="10" value="0" onchange="verifPointCreationPerson()">
        </label>
        <input type="hidden" name="hp" value="150">
        <input type="hidden" name="salle" value="1">
        <input type="hidden" name="etat" value="1">

    </form>
    <button id="creer-perso" onclick="envoieFormPerso('creer_perso', 'personnage','form_creation')">créer personnage</button>
   
