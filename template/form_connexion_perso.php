<?php
/*
    rôle: met en forme le formulaire de connexion de personnage

*/
?>


    <h1>Connnexion</h1>

    <form class="form_connexion" method="POST" >

        <label for="pseudo"> Pseudo
            <input type="text" name="pseudo" required>
        </label>

        <label for="mdp">Mot de passe
            <input type="text" name="mdp" required>
        </label>

    </form>
    <button id="connecte" onclick="envoieFormPerso('connexion_perso','personnage', 'form_connexion')" >Se connecter</button>
